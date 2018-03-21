<?php

namespace App\Http\Requests\ImportController;

use Illuminate\Foundation\Http\FormRequest;

class GameImportRequest extends FormRequest
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
            'source' => 'required|in:go,csv', // TODO: I want to get CSV working before next release
            'import' => 'required|file'
        ];
    }
}
