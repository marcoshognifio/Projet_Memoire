<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *@property Projet::with('administrateur')
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'nom' => $this->resource->nom,
            'administrateur' => new UserResource($this->administrateur),
            'description' => $this->resource->description,
            'projet_parent_id' => $this->resource->projet_parent_id,
            'image' => $this->resource->imageUrl()
        ];
        
    }
}
