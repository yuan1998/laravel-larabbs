<?php
use App\Models\User;



return [
    'title' =>  '用户',
    'heading' =>  '用户管理',
    'single' => '用户',
    'model' => User::class,
    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'avatar' => [
            'title' => "头像",
            "output" => function ($avatar , $model ) {
                return empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" width="40">';
            },
            // 是否允许排序
            'sortable' => false,
        ],
        'name' => [
            'title' => '用户名',
            // 是否允许排序
            'sortable' => false,
            'output' => function ($name , $model) {
                return '<a href="/users/' . $model->id .'" target=_blank>' .$name . '</a>';
            }
        ],
        'email' => [
            'title' => 'Email',
        ],
        'created_at',
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => 'Email',
        ],
        'password' => [
            'title' => "密码",
            'type' => 'password',
        ],
        'avatar' => [
            'title' => "头像",
            'type' => 'image',
            'location' => public_path() . '/upload/images/avatars/',
        ],
        "roles" => [
            'title' => '角色',
            'type' => 'relationship',
            'name_field' => 'name',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => 'Email',
        ],
    ],
];