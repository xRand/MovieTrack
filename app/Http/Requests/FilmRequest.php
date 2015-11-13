<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilmRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //for all users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'date' => 'required|date',
            'genre' => 'required',
            'director' => 'required',
            'poster' => 'required',
            'description' => 'required'
        ];
    }
}
