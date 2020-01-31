<?php

namespace App\Admin\Controllers;

use \App\Models\Stream;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Config;

class StreamController extends Controller
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
            ->header('流列表')
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
            ->header('详情')
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
            ->header('编辑')
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
            ->header('新建')
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

        $grid = new Grid(new Stream);
        $grid->id('Id');
        $grid->stream_title('直播流名称')->editable();
        $grid->stream_name('直播流地址')->editable();
        $grid->status('状态')->display(function($status){
            $status_arr = Config::get('constants.stream_status');
            return $status_arr[$status];
        });

        $grid->permited_at('启用时间')->display(function($permited_at){
            return date('Y-m-d H:i:s',$permited_at);
        });
        $grid->sort('排序')->editable();

        $grid->actions(function($actions){
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Stream::findOrFail($id));
        $show->id('Id');
        $show->stream_title('流名称');
        $show->stream_name('流地址');
        $show->status('状态',function($status){
            $status_arr = Config::get('constants.stream_status');
            return $status_arr[$status];
        });
        $show->display('permited_at','启用时间');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $status_arr = Config::get('constants.stream_status');
        $form = new Form(new Stream);
        $form->text('stream_title', '直播流名称');
        $form->text('stream_name', '直播流地址');
        $form->radio('status','状态')->options($status_arr)->inline();
        $form->datetime('permited_at', '启用时间')->format('YYYY-MM-DD HH:mm:ss');
        // 在表单提交前调用
        $form->saving(function (Form $form) {
            $form->permited_at = strtotime($form->permited_at);
        });

        $form->tools(function (Form\Tools $tools) {
            // 去掉`查看`按钮
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();
        });
        return $form;
    }
}
