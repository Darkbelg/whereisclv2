<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'date' => 'required|date',
            'location' => 'max:255',
            'latitude' => 'required|between:-85,85',
            'longitude' => 'required|between:-180,180'
        ];
    }

    public function messages()
    {
        return [
            'latitude.between' => 'Latitude has to be between -85 and 85.',
            'longitude.between' => 'longitude has to be between -180 and 180.'
        ];
    }

}
