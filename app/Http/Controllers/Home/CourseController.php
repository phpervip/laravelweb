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
