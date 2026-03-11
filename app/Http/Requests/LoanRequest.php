<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'borrower_name' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'book_title' => 'required|string|max:255',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after:borrowed_at',
            'returned' => 'required|boolean',
            'status' => 'required|in:active,returned,overdue',
        ];
    }
}
