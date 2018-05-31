<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {


        $users = User::all()->pluck('id')->toArray();

        $topics = Topic::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);


        $replys = factory(Reply::class)->times(950)->make()->each(function ($reply, $index) use ($users , $topics , $faker) {

            // 从用户 ID 数组中随机取出一个并赋值
            $reply->user_id = $faker->randomElement($users);

            // 话题 ID，同上
            $reply->topic_id = $faker->randomElement($topics);

        });

        Reply::insert($replys->toArray());
    }

}

