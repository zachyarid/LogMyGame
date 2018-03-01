<?php

namespace App\Http\Requests\GameController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class GameEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return DB::table('games')->where(['id' => $this->id, 'user_id' => \Auth::id()])->get();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
