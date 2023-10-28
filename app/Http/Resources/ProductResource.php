<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClassificationResource;
use App\Http\Resources\UserResource;

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
            'id'                => $this->id,
            'name'              => $this->name,
            'description'       => $this->description,
            'price_per_unit'    => $this->price_per_unit,
            'expiration_at'     => $this->expiration_at,
            'storage'           => $this->storage,
            'active'            => $this->active,
            'updated_by'        => $this->updated_by,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'classification'    => ClassificationResource::make($this->classification),
            'creator'           => UserResource::make($this->creator),
        ];
    }
}
