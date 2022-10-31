<?php

namespace App\Http\Resources\Api\Admin\Market;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketResource extends ResourceCollection
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
            'data' => $this->collection->map(function($market){
                return [
                    'id' => $market->id,
                    'name' => $market->name,
                    'address' => $market->address,
                    'market_phone' => $market->market_phone,
                    'email' => $market->email,
                    'user' => $market->user->first_name
                ];
            })
        ];
    }
}
