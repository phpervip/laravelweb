<?php
namespace App\Admin\Extensions;
use Encore\Admin\Form\Field;
class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';
    protected static $css = [
        '/vendor/laravel-admin-ext/wang-editor/wangEditor-3.0.10/release/wangEditor.min.css'
    ];
    protected static $js = [
        '/vendor/laravel-admin-ext/wang-editor/wangEditor-3.0.10/release/wangEditor.min.js',
    ];
    public function render()
    {
        $name = $this->formatName($this->column);
        $this->script = <<<EOT
var E = window.wangEditor
var editor = new E('#{$this->id}');
 // 通过 url 参数配置 debug 模式。url 中带有 wangeditor_debug_mode=1 才会开启 debug 模式
//  editor.customConfig.debug = location.href.indexOf('wangeditor_debug_mode=1') > 0
   editor.customConfig.debug = true
// editor.customConfig.uploadFileName = 'mypic';
 editor.customConfig.uploadFileName = 'wangpic[]';
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('input[name="_token"]').val()
}

editor.customConfig.zIndex = 0;

// editor.customConfig.uploadImgServer = '/admin/uploadimg'; //这里是图片上传请求接口 路由中已经配好 否则找不到
editor.customConfig.uploadImgServer = '/admin/upimage'

editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024

editor.customConfig.onchange = function (html) {
    // $('input[name=$name]').val(html);
    $('input[name=\'$name\']').val(html);

}


editor.customConfig.uploadImgHooks = {
    customInsert: function (insertImg, result, editor) {

        if (typeof(result.length) != "undefined") {
            for (var i = 0; i <= result.length - 1; i++) {
                var j = i;
                var url = result[i].newFileName;
                insertImg(url);
            }
            toastr.success(result[j]['info']);
        }
        switch (result['ResultData']) {
            case 7:
                toastr.error("图片过大");
                break;
            case 6:
                toastr.error("最多可以上传1张图片");
                break;
            case 5:
                toastr.error("请选择一个文件");
                break;
            case 4:
                toastr.error("上传失败");
                break;
            case 3:
                toastr.error(result['info']);
                break;
            case 2:
                toastr.error("文件类型不合法");
                break;
            case 1:
                toastr.error(result['info']);
                break;
        }
    }
}
       editor.create();
EOT;
        return parent::render();
    }
}
