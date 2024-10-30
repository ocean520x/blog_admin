<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{

    public function image(Request $request)
    {
        $request->validate(
            [
                'file' => ['required', 'image', 'max:2048']
            ],
            [
                'file.required' => '上传文件不得为空',
                'file.image' => '上传文件必须是图片格式',
                'file.max' => '上传文件大小不得超过2M'
            ]
        );
        $url = app(UploadService::class)->image(request('file'));
        return $this->success('图片上传成功', ['url' => $url]);
    }
}
