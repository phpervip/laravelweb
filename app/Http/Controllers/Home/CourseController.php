<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseLesson;
use App\Models\Tag;
use Input;


class CourseController extends Controller
{

    // 课程列表
    public function list(Request $request)
    {
        $builder = Course::query();

        $categorys = Category::where('parent_id',1)->get()->toArray();  // 初始值

        foreach($categorys as $k=>$v){
              $cates = Category::where('parent_id',$v)->get()->toArray();
              $categorys[$k]['id']      = $v['id'];
              $categorys[$k]['level']   = 1;
              $categorys[$k]['childs']  = (!empty($cates))?1:0;
              $categorys[$k]['childs_arr']  = $cates;
        }

        $condition = [];

        if($search = $request->input('search','')){
            $like = '%'. $search .'%';
            $builder->where(function($query) use ($like){
                $query->where('title','like',$like);
            });
            $condition['search'] = $search;
        }

        if($category_id = request('category_id')){
            // 查两级
           $cate_ids = Category::where('parent_id',$category_id)->get(['id'])->toArray();
           $cate_ids = array_column($cate_ids, 'id');
           array_unshift($cate_ids, intval($category_id));
           $builder->whereIn('category_id', $cate_ids);

           $condition['category_id'] = $category_id;

        }
        $courses = $builder->paginate(12);

        return view('home.course.list',compact('courses','categorys','category_id','condition'));
    }

    // 课程详情
    public function detail()
    {
        $id = Input::get('id');
        $course = Course::find($id);
        $lessons = CourseLesson::where('course_id','=',Input::get('id'))->get();
        // 推荐课程,其他4个课程。
        $map['profession_id']=$course->profession_id;
        $others = Course::where($map)->where('id','<>',$id)->limit(4)->orderBy('id','asc')->get();
        if(count($others)==0){
            $others = Course::limit(4)->get();
        }
        $tags = Tag::limit(6)->get();
        return view('home.course.detail',compact('course','tags','others'));
    }

    // 课程报名/课程下单
    public function order()
    {

    }

    // 课时列表
    public function lessons(Request $request){
        $condition=$request->all();
        $id = Input::get('id');
        $course = Course::find($id);
        $lessons = CourseLesson::where('course_id','=',$id)->paginate(3);
        return view('home.course.lessons',compact('course','lessons','condition'));
    }

    // 课时播放
    public function play(){
        $course_id = Input::get('id');
        $lesson = CourseLesson::find($course_id);
        $tags = Tag::limit(6)->get();
        return view('home.course.play',compact('lesson','course_id','tags'));
    }



}
