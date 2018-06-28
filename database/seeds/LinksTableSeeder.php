<?php

use Illuminate\Database\Seeder;

use App\Models\Link;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	// 获取假数据
        $links = factory(Link::class)->times(6)->make();


        // 将假数据->toArray 存入数据库
        Link::insert($links->toArray());
    }
}
