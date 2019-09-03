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

    protected $video_quality_array = [
                 '360P' => '360P',
                 '720P' => '720P',
                 '1080P' => '1080P',
                 '2160P'=>'2160P',
            ];

    protected $file_type_array = [
                '1' => 'Mp3',
                '2' => '128K',
                '3' => 'Wmv',
                '4'=>'Hiwmv',
                '5'=>'字幕',
                '6'=>'字幕文稿',
                '7'=>'DVD',
                '8'=>'MP4',
                '9'=>'4K',
    ];


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

        $grid->video1()->video_num('视频编码');
        $grid->video2()->video_num('课时截图')->display(function ($video_num) {
            // $video_jpg_key  = get_video_key($video_num,'jpg');
            // 参考：CZ_QINIU/uploads/image/video/DT/DT-000/DT-000-0024.jpg
            // 这里：/storage/images/video/DT/DT-000/DT-000-0024.jpg
            $video_jpg_url  = get_video_url(MY_QINIU.'/storage/images/video/',get_video_key($video_num,'jpg'));
            return ($video_jpg_url);

        })->image('',80,80);

         $grid->video()->video_url('播放视频')->display(function($video_url, $column){
            if($video_url){
                return $video_url;
            }else{
                 if(isset($this->video->video_num)){
                    $video_num = $this->video->video_num;
                    // VIDEO_QINIU.'/mp4',get_video_key($video_num,'mp4'));
                    $video_num_url  = get_video_url(MY_QINIU.'/storage/mp4',get_video_key($video_num,'mp4'));
                    return $video_num_url;
                 }
                 return '';
                // return $this->video_num;   // 这里不知怎么写了，如果这样写，就为空。
                // return $this->video->video_num;   // 如果这样写，就会报错。
            }
         })->video(['videoWidth' => 720, 'videoHeight' => 480]);
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
            $form->text('video.video_url','视频地址')->help('填写url地址后，无需填写视频编号');
            $form->text('video.video_num','视频编号');
            $form->display('video.video_num','视频截图')->with(function ($value) {
                $video_jpg_url  = get_video_url(MY_QINIU.'/storage/images/video/',get_video_key($value,'jpg'));;
                return $video_jpg_url;
            });
            $form->display('video.video_num','视频地址')->with(function ($value) {
                $video_num_url  = get_video_url(MY_QINIU.'/storage/mp4',get_video_key($value,'mp4'));
                return $video_num_url;
            })->help('根据视频编号自动生成');
            $form->text('video.video_time','视频时长')->help('单位是秒（s）');
            $form->checkbox('video.video_quality','视频清晰度')->options($this->video_quality_array)->canCheckAll();;
            $form->checkbox('video.file_type','视频档案')->options($this->file_type_array)->canCheckAll();
            $form->checkbox('video.m3u8_quality','m3u8清晰度')->options($this->video_quality_array)->canCheckAll();
        })->tab('音频',function (Form $form){
            $form->text('radio.radio_url','音频地址')->help('填写url地址后，无需填写音频编号');
            $form->text('radio.radio_num','音频编号');
            $form->display('radio.radio_num','音频地址')->with(function($value){
                $radio_num_url = get_radio_url(MY_QINIU.'/storage/mp3',get_radio_key($value,'mp3'));
                return $radio_num_url;
            })->help('根据音频编号自动生成');
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
