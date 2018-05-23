<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:2',
                    'body'        => 'required|min:3',
                    'category_id' => 'required|numeric'
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.required'       => '标题不能为空',
            'title.min'            => '标题不能小于2个字符',
            'body.min'             => '内容不能少于3个字符',
            'body.required'        => '内容不能为空',
            'category_id.required' => '分类不能为空',
            'category_id.numeric'  => '请输入正确的分类',
        ];
    }
}
