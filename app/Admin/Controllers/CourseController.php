<?php

namespace App\Admin\Controllers;

use App\Extensions\CheckRow;
use App\Models\Category;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profession;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
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
            ->header('课程列表')
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
            ->header('Detail')
            ->description('课时列表')
            ->body(Admin::show(Course::findOrFail($id), function (Show $show) {
                $show->title('课程标题');
                $show->courseLesson('课时列表', function ($lesson) {
                    $lesson->resource('/admin/course-lesson');
                    $lesson->id();
                    $lesson->title();
                    $lesson->created_at();
                    $lesson->updated_at();
                    $lesson->actions(function($actions){
                        $actions->disableView();
                    });
                });
            }));
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
            ->header('编辑课程')
            ->description('点右边查看，显示课时列表')
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
        $grid = new Grid(new Course);
        $grid->model()->orderBy('id','desc');
        $grid->id('Id');
        $grid->title('课程标题');
        $grid->profession_id('所属专业')->display(function($profession_id){
                if($profession_id>0){
                    return Profession::find($profession_id)->pro_name;
                }else{
                    return '';
                }
        });
        // $grid->profession_id('所属专业')->editable('select',Profession::all()->pluck('pro_name','id'));

        $grid->category_id('所属分类')->display(function($category_id){
            if(!$category_id) return '';
            return Category::find($category_id)->title;

        });
        $grid->cover('课程封面')->display(function ($cover){
            $cover_url = Storage::disk('public')->url($cover);
            return $cover_url;
        })->image('',60,'');
        $grid->tags('标签')->pluck('name')->label();
        $grid->teacher_id('授课老师')->display(function($teacher_id){
                if(!$teacher_id) return '';
                return User::find($teacher_id)->username;
        });
        $grid->sort('排序')->editable();
        $grid->status('状态')->display(function($status){
            $status_arr = Config::get('constants.status');
            return $status_arr[$status];
        });
       /* $grid->actions(function ($actions) {
            // 添加操作
            $actions->prepend(new CheckRow($actions->getKey()));
        });*/

       $grid->filter(function(Grid\filter $filter){
           $filter->column(1/2, function ($filter) {
               $filter->where(function ($query) {
                   $input = $this->input;
                   $query->whereHas('tags', function ($query) use ($input) {
                       $query->where('name', $input);
                   });

               }, '标签', 'tag');
           });
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
        $show = new Show(Course::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->desc('Desc');
        $show->profession_id('Profession id');
        $show->classroom_id('Classroom id');
        $show->teacher_id('Teacher id');
        $show->cover('Cover');
        $show->sort('Sort');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->status('Status');
        $show->create_time('Create time');
        $show->update_time('Update time');
        $show->create_uid('Create uid');
        $show->update_uid('Update uid');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $status_arr = Config::get('constants.status');
        $form = new Form(new Course);
        $form->text('title', '标题')->required();
        $form->select('profession_id','所属专业')->options(Profession::all()->pluck('pro_name','id'))->required();
        $form->select('category_id','所属分类')->options(Category::selectOptions())->required();
        $form->textarea('desc', '简介');
        $form->select('teacher_id','授课老师')->options(User::where('type','=',2)->get()->pluck('username', 'id'));
        // 原文件名
        // $form->image('cover', '封面图')->move('/image_course/'.date('Ym').'/');

        $form->image('cover', '封面图')->move('/course/'.date('Ym').'/');

        $form->radio('status','状态')->options($status_arr)->inline();
        $form->multipleSelect('tags','标签')->options(Tag::all()->pluck('name', 'id'));
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');
        return $form;
    }
}
