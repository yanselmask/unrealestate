<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'about' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['nullable', 'string', 'min:9', 'max:12', 'regex:/[0-9]{9}/'],
            'socialKey.*' => 'sometimes|required|string|max:255',
            'socialValue.*' => 'sometimes|required|string|url|max:255',
            'social.*' => 'nullable|string|url|max:255',
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
        ];
    }
}
