<?php

namespace App\Http\Resources\Api\Admin\Market;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => $this->collection->map(function($category){
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'image' => $category->image,
                    'image' => $category->description,
                    'slug' => $category->slug
                ];
            })
        ];
    }
}
