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

    // 下单购买

}
