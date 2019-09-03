<?php

namespace App\Admin\Controllers;

use \App\Models\Profession;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProfessionController extends Controller
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
            ->header('专业列表')
            ->description('')
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
            ->header('专业详情')
            ->description('')
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
            ->header('编辑专业')
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
            ->header('新建专业')
            ->description('')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Profession);
        $grid->id('ID');
        $grid->pro_name('专业名称');
        $grid->duration('课时数');
        $grid->view_count('点击率');
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');
        $grid->actions(function($actions){
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
        $form = new Form(new Profession);
        $form->text('pro_name', '专业名称');
        $form->text('description', '简介');
        $form->image('cover_img', '封面图');
        $form->number('view_count', '点击率')->default(500);
        $form->number('duration', '课时');
        $form->tools(function (Form\Tools $tools){
            $tools->disableView();
        });
        $form->footer(function ($footer){
            $footer->disableViewCheck();
        });

        return $form;
    }
}
