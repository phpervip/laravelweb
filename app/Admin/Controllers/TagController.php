<?php

namespace App\Admin\Controllers;

use \App\Models\Tag;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TagController extends Controller
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
            ->header('标签列表')
            ->description('description')
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
            ->header('标签详情')
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
            ->header('编辑标签')
            ->description('description')
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
            ->header('新建标签')
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
        $grid = new Grid(new Tag);

        $grid->id('Id');
        $grid->name('标签名称')->editable();

       /* $grid->options()->checkbox([
            1 => '选项A',
            2 => '选项B',
            3 => '选项C',
            4 => '选项D',
        ]);*/

//        $states = [
//            'on' => ['text' => 'YES'],
//            'off' => ['text' => 'NO'],
//        ];
//
//        $grid->column('switch_group','选择属性')->switchGroup([
//            'recommend' => '推荐', 'hot' => '热门', 'new' => '最新'
//        ], $states);

        $grid->filter(function ($filter) {
            $filter->between('updated_at')->datetime();
        });

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
        $form = new Form(new Tag);
        $form->display('id', 'ID');
        $form->text('name','标签名称')->rules('required');
  /*      $form->checkbox('options')->options([
            1 => '选项A',
            2 => '选项B',
            3 => '选项C',
            4 => '选项D',
        ])->stacked();*/
//        $form->switch('recommend','是否推荐');
//        $form->switch('hot','是否热门');
//        $form->switch('new','是否最新');
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '更新时间');
        $form->tools(function (Form\Tools $tools){
            $tools->disableView();
        });
        $form->footer(function ($footer){
            $footer->disableViewCheck();
        });

        return $form;
    }
}
