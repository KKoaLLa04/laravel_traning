<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Nhóm người dùng không được để trống');
                }
            }],
            'status' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên bắt buộc phải nhập!',
            'name.min' => 'Tên người dùng không được nhỏ hơn :min ký tự',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'group_id.required' => 'Nhóm người dùng không được để trống',
            'group_id.integer' => 'Nhóm người dùng không hợp lệ',
            'status.required' => 'Tình trạng không được để trống',
            'status.integer' => 'Tình trạng không hợp lệ',
        ];
    }
}
