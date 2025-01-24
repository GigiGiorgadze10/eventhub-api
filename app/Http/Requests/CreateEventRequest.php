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
            'name' => 'required|string|max:255|unique:events,name',

            'date' => 'required|date|after_or_equal:today',

            'location' => 'required|string|max:255',

            'description' => 'nullable|string|max:1000',

            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255', 

            'speakers' => 'nullable|array',
            'speakers.*.name' => 'required|string|max:255', 
            'speakers.*.bio' => 'nullable|string|max:500',  

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
        if ($this->has('ticket_price')) {
            $this->merge([
                'ticket_price' => (float) $this->ticket_price,
            ]);
        }
    }
}
