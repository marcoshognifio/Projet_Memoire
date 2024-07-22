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
            'budget_prevu' => $this->resource->budget_prevu,
            'recette_actuelle' => $this->resource->recette_actuelle,
            'depense_actuelle' => $this->resource->depense_actuelle,
            'transactions' => $this->resource->transactions,
            'fond_restant' => $this->resource->fond_restant(),
            'projet_parent_id' => $this->resource->projet_parent_id,
            'image' => $this->resource->imageUrl()
        ];
        
    }
}
