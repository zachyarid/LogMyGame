<?php

namespace App\Http\Requests\GameTypeController;

use Illuminate\Foundation\Http\FormRequest;

class GameTypeCreateAjaxRequest extends FormRequest
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
            'name' => 'required|string',
            'location' => 'required|string',
            'assignor' => 'required|string',
            'hotel' => 'present|in:true,false',
            'travel' => 'present|in:true,false',
            'grade_premium' => 'present|in:true,false',
        ];
    }
}
