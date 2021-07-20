<?php

namespace App\Http\Requests\Api\V1\VerifyCode;

use App\Rules\IranPhoneNumberRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GenerateCodeRequest extends FormRequest
{
    public function validated()
    {
        return array_merge(parent::validated(),[
            'expire_at' => Carbon::now()->addMinutes(2),
            'code' => $this->code()
        ]);
    }
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
            'phone' => ['required',new IranPhoneNumberRule]
        ];
    }

    public function code(): int
    {
        return rand(1000,9999);
    }
}
