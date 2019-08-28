<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Course;
use App\Models\Live;
use App\Models\User;

class IndexController extends Controller
{
    public function index(){

        // 轮播图
        $banners = News::where('is_focus','1')->orderBy('updated_at','desc')->limit(3)->get();

        // 最新资讯
        $news = News::orderBy('updated_at','desc')->limit(9)->get();

        // 点播课程
        $courses = Course::limit(8)->get();

        // 学员故事
        $users = User::limit(4)->where('introduction','<>','')->orderBy('created_at','desc')->get();

        return view('home.index',compact('banners','news','courses','lives','users'));
    }
}
