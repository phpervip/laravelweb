<?php
// use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */


// 覆盖`admin`命名空间下的视图
app('view')->prependNamespace('admin', resource_path('views/admin'));

// 一个简单的文件浏览扩展
Form::extend('media', \Encore\FileBrowser\FileBrowserField::class);

// Form::extend('wangeditor', WangEditor::class);





