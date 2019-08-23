<?php
namespace App\Admin\Controllers;

use App\Models\Course;
use \App\Models\CourseLesson;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class CourseLessonController extends Controller
{
    use HasResourceActions;
    protected $status_array = [1=>'草稿',2=>'已审核',3=>'已发布'];
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('课时列表')
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
            ->header('课时详情')
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
            ->header('课时编辑')
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
            ->header('新建课时')
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
        $grid = new Grid(new CourseLesson);
        if(request()->has('course_id')){
            $course_id = request()->input('course_id');
            $grid->model()->where('course_id', '=', $course_id);
        }
        $grid->model()->orderBy('id', 'desc');

        $grid->id('Id');
        $grid->title('课时标题');
        $grid->course()->title('所属课程');
        $grid->video_time('视频时长');


        /*$grid->video_url('视频地址')->display(function($video_url){
            $video_url = Storage::disk('admin')->url(rtrim(ltrim($video_url,'["'),'"]'));
            return $video_url;
        })->video(['videoWidth' => 720, 'videoHeight' => 480]);*/

        $grid->Video1()->video_num('视频编码');

        // 这里最好只读取一次
        $grid->Video2()->video_num('课时截图')->display(function ($video_num) {
            $video_jpg_key  = get_video_key($video_num,'jpg');
            $video_jpg_url  = get_video_url(CZ_QINIU.'/uploads/image/video/',$video_jpg_key);
            return ($video_jpg_url);
        })->image('',80,80);

        $grid->video('视频播放')->video_num('播放')->display(
            function($video_num){
                $video_url  = get_video_url(VIDEO_QINIU.'/mp4',get_video_key($video_num,'mp4'));
                return $video_url;
            }
        )->video(['videoWidth' => 720, 'videoHeight' => 480]);

        $grid->sort('排序')->editable();
        $grid->status('状态')->display(function($status){
            $status_arr = [1=>'草稿',2=>'已审核',3=>'已发布'];
            return $status_arr[$status];
        });
        $grid->actions(function ($actions){
            return $actions->disableView();
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
        $show = new Show(CourseLesson::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->course_id('Course id');
        $show->video_time('Video time');
        $show->video_url('Video url');
        $show->sort('Sort');
        $show->desc('Desc');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->status('Status');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CourseLesson);
        $form->tab('基本',function (Form $form){
            $form->text('title', '标题');

            // 如果有参数：course_id
            $course_id = request()->input('course_id');
            if($course_id){
                $course_info = Course::where('id','=',$course_id)->firstOrFail();
                $form->display('course.title', '课程名称')->value($course_info->title);
                $form->text('course_id', '课程ID')->value($course_id)->readonly();;
            }else{
                $form->display('course.title', '课程名称');
            }
//          $form->chunk_file('video_url', '视频地址');
            $form->textarea('desc', '课时简介');
            $form->radio('status','状态')->options($this->status_array)->inline();
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');
        })->tab('内容',function (Form $form){
                // $form->textarea('content.content','内容');
                //$form->summernote('content.content','内容');
                // $form->editor('content.content','内容');
                $form->editor('content.content', '内容');

        })->tab('视频',function (Form $form){
            $form->text('video.video_quality','视频质量');
            $form->text('video.video_num','视频编号');
            $form->text('video.file_type','视频类型');
            $form->text('video.m3u8_quality','m3u8质量');
        })->tab('音频',function (Form $form){
            $form->text('radio.radio_num','音频编号');
            $form->text('radio.duration','音频时长');
            $form->image('radio.mobile_pic','手机图片');
        });

        $form->tools(function (Form\tools $tools){
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();
        });

        return $form;
    }
}
