<?php

namespace App\Http\Requests\api\auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json(
            [
                'message'=>'validation Errors',
                'errors'=>$errors->messages()
            ],422);
        throw new HttpResponseException($response);
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'phone'=>'required|integer',
            'address'=>'required'
        ];
    }
}
