<?php

namespace App\Http\Requests\ProfileController;

use Illuminate\Foundation\Http\FormRequest;

class EmailPreferencesRequest extends FormRequest
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
            'game_summary' => '',
            'game_summary_freq' => 'in:1,7,30,90,365|required_if:game_summary,on',
            'outstanding_payments' => '',
            'outstanding_freq' => 'in:1,3,7,30,90,365|required_if:outstanding_payments,on',
            'mileage_summary' => '',
            'mileage_summary_freq' => 'in:1,7,30,90,365|required_if:mileage_summary,on',
        ];
    }

    public function messages()
    {
        return [
            'game_summary.required_with' => 'Switch Game Summary to on if you wish to enable Game Summary emails.',
            'game_summary_freq.required_if' => 'Select a frequency if you wish to enable Game Summary emails.',
            'game_summary_freq.in' => 'You selected an invalid frequency.',
            'outstanding_payments.required_with' => 'Switch Outstanding Payments to on if you wish to enable Outstanding Payments emails.',
            'outstanding_freq.required_if' => 'Select a frequency if you wish to enable Outstanding Payments emails.',
            'outstanding_freq.in' => 'You selected an invalid frequency.',
            'mileage_summary.required_with' => 'Switch Mileage Summary to on if you wish to enable Mileage Summary emails.',
            'mileage_summary_freq.required_if' => 'Select a frequency if you wish to enable Mileage Summary emails.',
            'mileage_summary_freq.in' => 'You selected an invalid frequency.',
        ];
    }
}
