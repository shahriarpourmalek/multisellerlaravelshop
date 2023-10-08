<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Post\StorePostRequest;
use App\Http\Requests\Back\Post\UpdatePostRequest;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $posts = Post::detectLang()->latest()->paginate(10);

        return view('back.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::detectLang()->where('type', 'postcat')->orderBy('ordering')->get();

        return view('back.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($data['publish_date']) {
            $data['publish_date'] = Jalalian::fromFormat('Y-m-d H:i:s', $request->publish_date)->toCarbon();
        }

        $data['slug']      = $data['slug'] ?: $data['title'];
        $data['published'] = $request->has('published');
        $data['user_id']   = auth()->user()->id;
        $data['lang']      = app()->getLocale();

        if ($request->hasFile('image')) {
            $file          = $request->image;
            $name          = uniqid() . '.' . $file->getClientOriginalExtension();
            $image         = $request->image->storeAs('posts', $name);
            $data['image'] = '/uploads/' . $image;
        }

        Post::create($data);

        toastr()->success('نوشته با موفقیت ایجاد شد.');

        return response("success");
    }

    public function edit(Post $post)
    {
        $categories = Category::detectLang()->where('type', 'postcat')->orderBy('ordering')->get();

        return view('back.posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($data['publish_date']) {
            $data['publish_date'] = Jalalian::fromFormat('Y-m-d H:i:s', $request->publish_date)->toCarbon();
        }

        $data['slug']      = $data['slug'] ?: $data['title'];
        $data['published'] = $request->has('published');

        if ($request->hasFile('image')) {
            $file          = $request->image;
            $name          = uniqid() . '.' . $file->getClientOriginalExtension();
            $image         = $request->image->storeAs('posts', $name);
            $data['image'] = '/uploads/' . $image;

            Storage::disk('public')->delete($post->image);
        } else {
            $data['image'] = $post->image;
        }

        $post->update($data);

        toastr()->success('نوشته با موفقیت ویرایش شد.');

        return response("success");
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);

        $post->delete();
    }

    public function generate_slug(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    //------------- Category methods

    public function categories()
    {
        $this->authorize('posts.category');

        $categories = Category::detectLang()->where('type', 'postcat')->whereNull('category_id')
            ->with('childrenCategories')
            ->orderBy('ordering')
            ->get();

        return view('back.posts.categories', compact('categories'));
    }
}
