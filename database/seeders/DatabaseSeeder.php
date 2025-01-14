<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $user1 = User::findOrFail(1);
        $user1->name = '超级管理员';
        $user1->phone = '18688226300';
        $user1->password = Hash::make('123456');
        $user1->save();
        $user2 = User::findOrFail(2);
        $user2->name = '欧顺';
        $user2->phone = '13000000002';
        $user2->password = Hash::make('123456');
        $user2->save();
        $user3 = User::findOrFail(3);
        $user3->name = '顺爷';
        $user3->phone = '13000000003';
        $user3->password = Hash::make('123456');
        $user3->save();
        $this->call([
            CategorySeeder::class,
            TopicSeeder::class,
            ConfigSeeder::class,
            CommentSeeder::class
        ]);

        $cat_arr = ['聚焦热点', '财经信息', '娱乐八卦', '体育天地', '母婴空间', '文化历史', '图书走廊', '地产天地', '汽车世界', '热门电影', '网红明星', '饮食男女'];
        foreach ($cat_arr as $k => $v) {
            $cat = Category::findOrFail($k + 1);
            $cat->title = $v;
            $cat->save();
        }
    }
}
