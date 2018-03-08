<?php

namespace App\Http\Requests\MileageController;

use Illuminate\Foundation\Http\FormRequest;

class MileageCompleteRequest extends FormRequest
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
            'game_id' => 'required|array',
            'odometer_in' => 'required_without:distance',
            'distance' => 'required_without:odometer_in',
        ];
    }
}
