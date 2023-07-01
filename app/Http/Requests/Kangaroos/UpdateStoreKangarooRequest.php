<?php

namespace App\Http\Requests\Kangaroos;

use App\Http\Requests\BaseRequest;

class UpdateStoreKangarooRequest extends BaseRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo' => 'nullable|image|mimes:jpg|max:2048', // Only allow JPG files up to 2MB
            'name' => 'required|unique:kangaroos,name,' . $this->kangaroo,
            'nickname' => 'nullable',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'gender' => 'required|in:Male,Female',
            'color' => 'nullable',
            'friendliness' => 'nullable|in:not friendly,friendly',
            'birthday' => 'required|date',
        ];
    }
}
