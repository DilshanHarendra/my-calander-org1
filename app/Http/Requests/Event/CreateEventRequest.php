<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
        ];
    }
}
