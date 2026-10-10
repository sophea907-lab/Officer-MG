<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfficerRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'officer_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'dob' => ['required', 'date', 'before:today'],
            'email' => ['required', 'email', 'max:255', 'unique:officers,email'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'hire_date' => ['required', 'date'],
            'salary' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'in:Active,Inactive,Resigned'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'officer_name' => 'officer name',
            'dob' => 'date of birth',
            'hire_date' => 'hire date',
            'department_id' => 'department',
            'position_id' => 'position',
        ];
    }
}
