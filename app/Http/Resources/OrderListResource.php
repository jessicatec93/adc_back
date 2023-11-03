<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'folio'         => $this->folio,
            'active'        => $this->active,
            'deadline_at'   => $this->deadline_at,
            'delivery_at'   => $this->delivery_at,
            'status_id'     => $this->status_id,
            'created_at'    => $this->created_at,
            'total_price'   => $this->total_price,
        ];
    }
}
