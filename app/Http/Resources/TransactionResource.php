<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'montant' => $this->resource->montant,
            'projet_emetteur' => $this->projet_emetteur->nom,
            'projet_destinataire' => $this->projet_destinataire->nom,
            'objet' => $this->resource->objet,
            'created_at'=>$this->resource->created_at->format('d-m-y'),
        ];
    }
}
