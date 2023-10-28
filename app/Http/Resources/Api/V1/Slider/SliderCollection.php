<?php

namespace App\Http\Resources\Api\V1\Slider;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($slider) {
            return [
                'id' => $slider->id,
                'title' => $slider->title,
                'lang' => $slider->lang,
                'description' => $slider->description,
                'image' => $slider->image,
                'published' => $slider->published,
                'link' => $slider->link,
                'ordering' => $slider->ordering,
                'group' => $slider->group,
                'created_at' => $slider->created_at,
                'created_at_jalali' => jdate($slider->created_at)->format('Y-m-d'),
            ];
        });
    }
}
