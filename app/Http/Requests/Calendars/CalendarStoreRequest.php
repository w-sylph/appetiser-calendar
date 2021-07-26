<?php

namespace App\Http\Requests\Calendars;

use Illuminate\Foundation\Http\FormRequest;

class CalendarStoreRequest extends FormRequest
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
            'name' => 'required',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:date_from',
            'day_of_weeks' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'event'
        ];
    }
}
