<?php

namespace App\Http\Requests\MileageController;

use Illuminate\Foundation\Http\FormRequest;

class MileagePreRequest extends FormRequest
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
            'origin' => 'string|required',
            'odometer_out' => 'numeric|required',
        ];
    }
}
