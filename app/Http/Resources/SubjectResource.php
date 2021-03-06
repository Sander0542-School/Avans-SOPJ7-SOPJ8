<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'order' => $this->order,
            'domain' => new DomainResource($this->domain),
            'layers' => LayerResource::collection($this->whenLoaded('layers'))
        ];
    }
}
