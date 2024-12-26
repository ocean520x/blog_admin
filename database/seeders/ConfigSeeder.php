<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::create([
            'data' => [
                'site_name' => '欧顺论坛',
                'ICP' => 'ICPXXXXXXXXXX',
                'tel' => '13800000001',
                'copyright' => '版权所有 2024-2025',
                'aliyun_pay' => 'xxxxxxxx',
                'wechat_pay' => 'aaaaaaaa'
            ]
        ]);
    }
}
