<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
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
                'id'     => $this->id,
                'name'   => $this->name,
                'date'   => explode(" ", $this->pivot->date)[0]
                // 'companies' => companyResource::collection($this->companies)
            ];
    }
}
