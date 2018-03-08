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
            'game_id' => 'required|array',
            'date_travel' => 'date|before_or_equal:' . date('Y-m-d', time()),
            'origin' => 'string|required',
            'odometer_out' => 'required_with:odometer_in',
            'odometer_in' => 'required_with:odometer_out',
            'distance' => 'required_without_all:odometer_out,odometer_in',
        ];
    }
}
