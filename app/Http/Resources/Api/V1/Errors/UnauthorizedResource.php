<?php

namespace App\Http\Resources\Api\V1\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class UnauthorizedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        return [
            'error' => 'ورود نامعتبر'
        ];
    }
}
