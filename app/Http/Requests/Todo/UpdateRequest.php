<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Check if user is allowed to update todo
        $todo = $this->route("todo");

        return $this->user()->can('update', $todo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"       => "nullable|string",
            "description" => "nullable|string",
            "complete"    => "nullable|boolean",
        ];
    }
}
