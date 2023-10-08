<?php

namespace App\Http\Resources\Api\V1\Banners;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends JsonResource
{


    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->image,
            "published" => $this->published,
            "link" => $this->link,
            "ordering" => $this->ordering,
            "lang" => $this->lang,
            "group" => $this->group,
            "title" => $this->title,
            "description" => $this->description
        ];
    }
}
