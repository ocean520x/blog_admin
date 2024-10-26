<?php

namespace Database\Seeders;

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
        $user2->save();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
