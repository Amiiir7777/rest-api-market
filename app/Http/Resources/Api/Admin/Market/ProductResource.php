<?php

namespace App\Http\Resources\Api\Admin\Market;

use Illuminate\Http\Resources\Json\ResourceCollection;

class productResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => $this->collection->map(function($product){
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'category' => $product->category->name,
                    'tag' => $product->tags,
                    'brand' => $product->brand->persian_name
                ];
            })
        ];
    }
}
