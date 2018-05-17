<?php

namespace App\Handlers;
use Image;


class ImageUploadHandler
{


    /**
     * [$allowed_ext description]
     * @var [type]
     */
    public $allowed_ext = ['png','jpg','gif','jpeg'];




    public function save ($file , $folder , $file_prefix , $maxWidth = false)
    {

        $folder_name = "upload/images/$folder/". date("Ym/d",time());

        $upload_path = public_path() . '/' . $folder_name;

        $ext = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $ext;


        if(!in_array($ext,$this->allowed_ext)){
            return false;
        }

        $file->move($upload_path,$filename);


        if($maxWidth && $ext != 'git'){
            $this->reduceImage($maxWidth , $upload_path . "/" . $filename);
        }


        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];

    }



    public function reduceImage ($maxWidth , $filePath)
    {

        $img = Image::make($filePath);

        $img->resize($maxWidth,null, function ($constraint) {


            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();

        })

        $img->save();


    }

}