<?php

namespace App\Http\Requests\Api\V1\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'description' => ['required', 'string'],
            'timezone' => ['required', 'string','max:255'],
            'start_at' => ['required', 'date_format:Y-m-d H:i','after:today'],
            'end_at' => ['required', 'date_format:Y-m-d H:i','after:start_at'],
            'all_day' => ['in:0,1'],
        ];

    }
}
