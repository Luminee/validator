<?php

namespace Luminee\Validator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

/**
 * @method string array(...$keys)
 * @method string bail()
 * @method string between($min, $max)
 * @method string boolean()
 * @method string date()
 * @method string date_format($format)
 * @method string digits_between($min, $max)
 * @method string email()
 * @method string filled()
 * @method string gt($field)
 * @method string gte($field)
 * @method string in(...$items)
 * @method string integer()
 * @method string json()
 * @method string lt($field)
 * @method string lte($field)
 * @method string max($value)
 * @method string min($value)
 * @method string not_in(...$items)
 * @method string not_regex($pattern)
 * @method string regex($pattern)
 * @method string required()
 * @method string size($value)
 * @method string string()
 */
class BaseRequest extends FormRequest
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

    protected function failedValidation(Validator $validator) {}

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'E-mail',
            'phone' => '手机号',
            'username' => '用户号',
            'nickname' => '昵称',
            'password' => '密码',
            'account_name' => '会员名',
            'mark_name' => '备注名'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'min' => ':attribute长度必须大于:min',
            'max' => ':attribute长度必须小于:max',
            'json' => ":attribute数据格式错误",
            'email' => ':attribute格式不正确',
            'regex' => ':attribute格式不正确',
            'exists' => ':attribute不存在',
            'unique' => ':attribute已存在',
            'captcha' => ':attribute输入不正确',
            'required' => ':attribute不能为空',
            'confirmed' => ':attribute输入不一致',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected static function parseRule($method, $parameters): string
    {
        $rule = $method;
        if (!empty($parameters)) {
            $rule .= ':' . implode(',', $parameters);
        }

        return $rule;
    }

    public function __call($method, $parameters)
    {
        return self::parseRule($method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return self::parseRule($method, $parameters);
    }
}
