<?php

namespace App\Http\Requests\PaymentController;

use Illuminate\Foundation\Http\FormRequest;

class PaymentCreateRequest extends FormRequest
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
            'game_id' => 'required|numeric|exists:games,id',
            'user_id' => 'required|numeric|exists:users,id',
            'payer' => 'required|string',
            'check_number' => 'required|numeric',
            'date_received' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
        ];
    }
}
