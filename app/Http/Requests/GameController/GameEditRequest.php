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
            'game_date' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
            'game_time' => 'required',
            'location' => 'required|exists:game_locations,id|numeric',
            'age' => 'required|exists:ages,id|numeric',
            'home_team' => 'required',
            'home_score' => 'required|min:0|numeric',
            'away_team' => 'required',
            'away_score' => 'required|min:0|numeric',
            'center_name' => 'required|max:255',
            'ar1_name' => 'max:255|nullable',
            'ar2_name' => 'max:255|nullable',
            'th_name' => 'max:255|nullable',
            'comments' => 'string|nullable',
            'game_fee' => 'required|numeric',
            'miles_run' => 'min:0|max:50|numeric|nullable',
            'game_type' => 'required|numeric',
            'platform' => 'required',
        ];
    }
}
