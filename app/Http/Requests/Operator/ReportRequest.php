<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'patient_id' => 'required',
            'status'     => 'required',
            'test.*'     => 'required',
            'result.*'   => 'required',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            unset($rules['patient_id']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'test.*' => 'The test field is required.',
            'result.*' => 'The result field is required.',
        ];
    }
}
