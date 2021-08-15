<?php

namespace App\Http\Requests\Api\Rover;

use App\Rules\DirectionRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'plateau_id' => ['required', 'int'],
            'direction' => ['required', new DirectionRule],
            'x' => ['nullable', 'int', 'min:0'],
            'y' => ['nullable', 'int', 'min:0'],
        ];
    }
}
