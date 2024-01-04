<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "cost" => $this->cost,
            "quantity" => $this->quantity,
            "address_stock" => $this->address_stock,
            "image" => url($this->image),
            "barcode" => $this->barcode,
            "discount" => $this->discounts,
            "category" => [
                "id" => $this->categorys->id,
                "name" => $this->categorys->name
            ]
        ];
    }
}
