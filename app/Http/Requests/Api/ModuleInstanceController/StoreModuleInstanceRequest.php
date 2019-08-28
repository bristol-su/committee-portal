<?php

namespace App\Http\Requests\Settings\ModuleInstanceController;

use App\Rules\CompletionEvent;
use App\Rules\ModuleAlias;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreModuleInstanceRequest extends FormRequest
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
            'alias' => [app(ModuleAlias::class), 'required'],
            'activity_id' => ['exists:activities,id'],
            'name' => 'required|string',
            'description' => 'required|string',
            'active' => 'required|exists:logics,id',
            'visible' => 'required|exists:logics,id',
            'mandatory' => 'required|exists:logics,id',
            'complete' => ['sometimes', 'nullable', 'string', new CompletionEvent($this->input('alias'))]
        ];
    }
}
