<?php

namespace App\Admin\Controllers;

use App\Models\News;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;

class NewsController extends Controller
{

    use HasResourceActions;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\News';

    public function index(Content $content)
    {
        return $content
            ->header('资讯列表')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new News);

        $grid->column('id', __('Id'));
        $grid->column('title',__('Title'));
        $grid->column('cover_img', __('Cover'));

        $grid->column('order', __('Order'));
        $states = [
            'on'    =>['text'=>'YES'],
            'off'   =>['text'=>'NO']
        ];
        $grid->column('switch_group','选择属性')->switchGroup(
            ['is_focus'=>__('Is focus'), 'recommend'=>__('Recommend')], $states);
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
        $form = new Form(new News);

        $form->text('title', __('Title'))->required();
        $form->textarea('content', __('Content'))->required();
        $form->image('cover', __('Cover'));
        $form->number('order', __('Order'));
        $form->switch('is_focus', __('Is focus'));
        $form->switch('recommend', __('Recommend'));
        $form->switch('hot', __('Hot'));
        $form->switch('new', __('New'));
        $form->url('url', __('Url'));

        return $form;
    }

    public function create(Content $content)
    {
        return $content
        ->header('新建资讯')
        ->body($this->form());
    }

    public function edit($id, Content $content)
    {
        return $content
        ->header('编辑资讯')
        ->body($this->form()->edit($id));
    }

}
