<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepenseResource extends JsonResource
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
            'objet' => $this->resource->objet,
            'montant' => $this->resource->montant,
            'articles' => ArticleResource::Collection($this->articles),
            'image' =>$this->resource->imageUrl(),
            'created_at'=>$this->resource->created_at->format('d-m-y')
        ];
    }
}
