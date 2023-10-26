<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\Banners\BannerResource;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;

class BannerController extends Controller
{


    public function index()
    {
        $banners = Banner::detectLang()->orderBy('ordering')->get();
        return BannerResource::collection($banners);
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'image'       => 'image|required|max:2048',
            'group'       => 'required',
            'title'       => 'nullable',
            'description' => 'nullable',
        ]);

        $file = $request->image;
        $name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $request->image->storeAs('banners', $name);

        Banner::create([
            'link'        => $request->link,
            'lang'        => app()->getLocale(),
            'group'       => $request->group,
            'published'   => $request->published ? true : false,
            'image'       => '/uploads/banners/' . $name,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        toastr()->success('بنر با موفقیت ایجاد شد.');

        return response("success");
    }



    public function update(Banner $banner, Request $request)
    {
        $this->validate($request, [
            'image' => 'image|max:2048',
            'group' => 'required'
        ]);

        if ($request->hasFile('image')) {

            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $file = $request->image;
            $name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $request->image->storeAs('banners', $name);

            $banner->image = '/uploads/banners/' . $name;
            $banner->save();
        }

        $banner->update([
            'link'        => $request->link,
            'group'       => $request->group,
            'published'   => $request->published ? true : false,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        toastr()->success('بنر با موفقیت ویرایش شد.');

        return response("success");
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return response('success');
    }

    public function sort(Request $request)
    {
        $this->authorize('banners.update');

        $this->validate($request, [
            'banners' => 'required|array'
        ]);

        $i = 1;

        foreach ($request->banners as $banner) {
            Banner::findOrFail($banner)->update([
                'ordering' => $i++,
            ]);
        };

        return response('success');
    }
}
