<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can add authorization logic here, return true for now
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
            // Event name: required, unique in the events table
            'name' => 'required|string|max:255|unique:events,name',

            // Event date: required, must be a valid date, and cannot be in the past
            'date' => 'required|date|after_or_equal:today',

            // Event location: required string
            'location' => 'required|string|max:255',

            // Event description: optional, but if provided, it should be a string
            'description' => 'nullable|string|max:1000',

            // Tags (array validation)
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255', // Each tag in the array should be a string

            // Nested array validation for speakers
            'speakers' => 'nullable|array',
            'speakers.*.name' => 'required|string|max:255',  // Speaker name
            'speakers.*.bio' => 'nullable|string|max:500',   // Speaker bio

            // Event ticket price: optional, must be numeric if provided
            'ticket_price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'გთხოვთ, შეავსოთ ღონისძიების სახელი.',
            'name.unique' => 'ასეთი სახელი უკვე არსებობს.',
            'date.required' => 'გთხოვთ, შეავსოთ ღონისძიების თარიღი.',
            'date.after_or_equal' => 'თარიღი უნდა იყოს დღევანდელი ან მომავალში.',
            'location.required' => 'გთხოვთ, შეავსოთ ღონისძიების ადგილმდებარეობა.',
            'description.string' => 'აღწერა უნდა იყოს ტექსტი.',
            'tags.array' => 'თაგები უნდა იყოს რიგი.',
            'tags.*.string' => 'თაგები უნდა შეიცავდეს მხოლოდ ტექსტს.',
            'speakers.array' => 'მოსაუბრეები უნდა იყოს რიგი.',
            'speakers.*.name.required' => 'მოსაუბრის სახელი აუცილებელია.',
            'speakers.*.name.string' => 'მოსაუბრის სახელი უნდა იყოს ტექსტი.',
            'speakers.*.bio.string' => 'მოსაუბრის ბიოგრაფია უნდა იყოს ტექსტი.',
            'ticket_price.numeric' => 'ღირებულება უნდა იყოს რიცხვი.',
            'ticket_price.min' => 'ღირებულება არ შეიძლება იყოს ნულის ქვემოთ.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // You can manipulate or sanitize input before validation
        // Example: Convert ticket price to float
        if ($this->has('ticket_price')) {
            $this->merge([
                'ticket_price' => (float) $this->ticket_price,
            ]);
        }
    }
}
