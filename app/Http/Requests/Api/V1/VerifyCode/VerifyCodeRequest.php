<?php

namespace App\Http\Requests\Api\V1\VerifyCode;

use App\Rules\IranPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'phone' => ['required',new IranPhoneNumberRule],
            'code' => ['required','numeric','digits:4']
        ];
    }
}
