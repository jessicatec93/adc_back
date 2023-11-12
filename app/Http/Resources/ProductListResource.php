<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'folio'             => $this->folio,
            'name'              => $this->name,
            'expiration_at'     => $this->expiration_at,
            'storage'           => $this->storage,
            'active'            => $this->active,
            'created_at'        => $this->created_at,
            'min_amount'        => $this->min_amount,
        ];
    }
}
