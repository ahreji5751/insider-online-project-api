<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'week'        => $this->week,
            'host_goals'  => $this->host_goals,
            'guest_goals' => $this->guest_goals,
            'host_team'   => TeamResource::make($this->whenLoaded('host')),
            'guest_team'  => TeamResource::make($this->whenLoaded('guest')),
        ];
    }
}
