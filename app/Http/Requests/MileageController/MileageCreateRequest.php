<?php

namespace App\Http\Requests\MileageController;

use Illuminate\Foundation\Http\FormRequest;

class MileageCreateRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'game_id' => 'required|numeric',
            'odometer_out' => 'required|numeric',
            'odometer_in' => 'required|numeric',
        ];
    }
}
