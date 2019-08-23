<?php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;



class UploadsController extends Controller
{

  public function uploadimg(Request $request)
    {
        $mypic = $_FILES['mypic'];
        if (!empty($mypic)) {
            $ext = strtolower(substr($mypic['type'], strrpos($mypic['type'], '/') + 1));
            $exts = ['jpg', 'png', 'gif', 'jpeg'];
            if (!in_array($ext, $exts)) {
                $response[] = ['ResultData' => 2, 'info' => '文件类型不允许,请上传常规的图片(gif、jpg、jpeg与png)文件'];
                return $response;
            }

            $content = file_get_contents($mypic['tmp_name']);
            $filename = date('His') . uniqid() . "." . $ext;
            $env = config('app.env', 'local');
            $savePath = 'uploads/official/img/' . date("Y/m/d");

            $file = "/storage/{$savePath}/{$filename}";
            if ($env !== 'production') {
                $file = "/storage/$env/{$savePath}/{$filename}";
            }
            MechanicManager::upload($file, $content);
            $filenames = '你的网址' . $file;
            $response[] = ['ResultData' => 0, 'info' => '上传成功', 'newFileName' => $filenames];
            return $response;
        }else{
            $response[] = ['ResultData' => 5, 'info' => '请选择一个文件'];
            return $response;
        }

    }
}
