<?php

namespace App\Http\Requests\Api\V1\Event;

use Illuminate\Foundation\Http\FormRequest;

class RegisterToEventRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'name' => ['required','string','max:255'],
            'rsvp' => ['required','string','max:255','in:confirmed,unconfirmed'],
        ];
    }
}
