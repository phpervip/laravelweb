<?php

namespace App\Admin\Controllers;


use \App\Models\Live;
use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\Stream;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class LiveController extends Controller
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
            ->header('直播列表')
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
            ->header('直播详情')
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
            ->header('直播编辑')
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
            ->header('新建直播')
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
        $grid = new Grid(new Live);

        $grid->id('Id');
        $grid->title('标题')->editable();
        $grid->profession_id('所属专业')->display(function ($profession_id){
            if($profession_id>0){
                return Profession::find($profession_id)->pro_name;
            }else{
                return '';
            }
        });

        $grid->stream_id('直播流')->display(function($stream_id){
            $stream = Stream::where('id','=',$stream_id)->firstOrFail();
            return $stream->stream_name;
        })->video(['videoWidth' => 720, 'videoHeight' => 480]);;

        $grid->cover('封面图')->display(function($cover){
            $cover_url = Storage::disk('admin')->url($cover);
            return $cover_url;
        })->image('',60,'');

        $grid->sort('排序')->editable();
        $grid->begin_at('开始时间');
        $grid->end_at('结束时间');
        $grid->status('状态')->display(function($status){
            $status_arr = Config::get('constants.status');
            return $status_arr[$status];
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
        $status_arr = Config::get('constants.status');
        $form = new Form(new Live);
        $form->text('title', '直播标题');
        $form->select('profession_id','所属专业')->options(Profession::all()->pluck('pro_name','id'));
        $form->select('stream_id','直播流')->options(Stream::all()->pluck('stream_name','id'));
        $form->image('cover', '课程封面');
        $form->text('desc', '课程简介');
        $form->datetime('begin_at', '开始时间');
        $form->datetime('end_at', '结束时间');
        $form->text('video_url', '视频地址');
        $form->radio('status', '状态')->options($status_arr);
        $form->tools(function(Form\Tools $tools){
            $tools->disableView();
        });
        $form->footer(function($footer){
            $footer->disableViewCheck();
        });

        $form->tools(function (Form\Tools $tools) {
            // 去掉`查看`按钮
            $tools->disableView();
        });
        return $form;
    }
}
