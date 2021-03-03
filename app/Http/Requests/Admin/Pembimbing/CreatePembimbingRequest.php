<?php

namespace App\Http\Requests\Admin\Pembimbing;

use Illuminate\Foundation\Http\FormRequest;

class CreatePembimbingRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|unique:pembimbings',
            'name' => 'required|string',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ];
    }
}
