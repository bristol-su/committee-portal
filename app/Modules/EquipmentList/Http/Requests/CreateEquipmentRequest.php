<?php

namespace App\Modules\EquipmentList\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'sometimes|string|nullable',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'bought_at' => 'required|date|before:now',
            'notes' => 'sometimes|string|nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
