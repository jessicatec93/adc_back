<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'folio'              => $this->folio,
            'delivery_at'        => $this->delivery_at,
            'deadline_at'        => $this->deadline_at,
            'active'            => $this->active,
            'description'        => $this->description,
            'price_per_unit'     => $this->price_per_unit,
            'total_price'        => $this->total_price,
            'required_quantity'  => $this->required_quantity,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'status'             => OrderStatusResource::make($this->status),
            'creator'            => UserResource::make($this->creator),
            'updater'            => UserResource::make($this->updater),
            'product'            => ProductResource::make($this->product),
        ];
    }
}
