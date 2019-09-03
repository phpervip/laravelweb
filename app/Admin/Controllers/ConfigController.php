<?php

namespace App\Admin\Controllers;

use \App\Models\Config;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Cache;

class ConfigController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('系统')
            ->description('配置')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {

        return $content
            ->header('配置')
            ->description('')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Config);
        $grid->id('Id');
        $grid->name('name');
        $grid->value('Value')->editable()->style('max-width:250px;word-break:break-all;');
        $grid->title('Title');
        $grid->sort('Sort')->editable()->sortable();
        $grid->remark('Remark');
        $grid->actions(function ($actions){
            $actions->disableView();
        });
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Config);

        $form->display('title', '标题');
        $form->display('name', '变量名');
        $form->text('value', '变量值');
        $form->textarea('description', '描述');
        $form->display('remark', '备注');

        $form->tools(function (Form\tools $tools){
            $tools->disableView();
        });

        // 表单保存后回调
        $form->saved(function (Form $form) {
            //  配置值写入缓存
            $configs = Config::get();
            foreach($configs as $val){
                 $confs[$val['name']] = $val['value'];
            }

            // 每次编辑后都重新缓存
            // if (!Cache::has('configs')) {
                Cache::put('configs',$confs);
            // }else{
            //     Cache::add('configs', $confs);
            // }


        });
        return $form;
    }

}
