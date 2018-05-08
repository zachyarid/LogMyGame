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
            'game_id' => 'required|array|exists:games,id',
            'payer' => 'required|string',
            'check_number' => 'nullable',
            'date_received' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
            'comment' => 'string',
        ];
    }
}
