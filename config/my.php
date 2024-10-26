<?php
return [
    'aliyun' => [
        'key' => env('ALIYUN_KEY'),
        'secret' => env('ALIYUN_SECRET'),
        'signName' => env('ALIYUN_SIGN_NAME'),
    ],
    'code' => [
        'out_time' => env('CODE_OUT_TIME', 180),
    ]
];
