<?php

namespace App\Admin\Controllers;

use \App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Tree;

class CategoryController extends AdminController
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
            ->header('分类树图')
            ->description('')
            ->body($this->tree());
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
            ->header('分类详情')
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
            ->header('编辑分类')
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
            ->header('创建分类')
            ->description('')
            ->body($this->form());
    }


    /**
     * Make a grid builder.
     *
     * @return Tree
     */
    protected function tree()
    {
        return Category::tree(function (Tree $tree) {

            $tree->branch(function ($branch) {

                $src = config('admin.upload.host') . '/' . $branch['cover'] ;

                $cover = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";

                return "{$branch['id']} - {$branch['title']} ";

            });
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);
        // $form->display('id','ID');
        $form->select('parent_id','父分类')->options(Category::selectOptions());
        $form->text('title', '标题')->rules('required');
        $form->textarea('desc', '简介');
        $form->image('cover','标志图');
        $form->display('created_at','创建时间');
        $form->display('updated_at','修改时间');
        $form->tools(function (Form\Tools $tools){
            $tools->disableView();
        });
        $form->footer(function ($footer){
            $footer->disableViewCheck();
        });
        return $form;
    }
}
