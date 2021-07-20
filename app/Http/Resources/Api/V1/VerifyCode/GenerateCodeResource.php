<?php

namespace App\Http\Resources\Api\V1\VerifyCode;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerateCodeResource extends JsonResource
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
            'status' => 'success',
            'message' => 'رمز عبور یکبار مصرف با موفقیت ارسال شد'
        ];
    }
}
