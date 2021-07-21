<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name ?? null,
            'profile' => $this->resource->profile ? url($this->resource->profile) : null ,
            'referral_code' => $this->resource->referral_code,
            'phone' => $this->resource->phone,
            'wallet' => $this->resource->wallet,
            'is_referred' => $this->resource->referred_code ? true : false ,
            'is_registered' => $this->resource->name ? true : false
        ];
    }
}
