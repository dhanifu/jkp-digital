<?php

namespace App\Http\Requests\Admin\Pembimbing;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembimbingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ];
    }
}
