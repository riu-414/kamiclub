<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'menu' => ['required', 'max:50'],
            'stylist' => ['required', 'max:50'],
            'message' => ['required', 'max:200'],
            'reserve_date' => ['required', 'date'],
            'start_time' => ['required'],
            // 'end_time' => ['required', 'after:start_time'],
        ];
    }
}
