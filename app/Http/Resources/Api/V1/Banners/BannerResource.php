<?php

namespace App\Http\Resources\Api\V1\Banners;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "image"=> $this->image,
            "published"=>$this->published,
            "link" => $this->link,
            "ordering"=>$this->ordering,
            "lang" => $this->lang,
            "group" => $this->group,
            "title"=>$this->title,
            "description" => $this->description
        ];
    }
}
