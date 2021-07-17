<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'Title' => $this->Title,
            'Product_URL' => $this->Product_URL,
            'State' => $this->State,
            'Stock' => $this->Stock,
            'Price' => $this->Price,
        ];
    }
}