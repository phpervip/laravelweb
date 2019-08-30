<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Live;
use App\Models\Profession;
use App\Models\Tag;
use Input;

class LiveController extends Controller
{
    // 直播播放
    public function play(){
        $live_id = Input::get('id');
        $live = Live::with('stream')->find($live_id);
        $tags = Tag::limit(6)->get();
        return view('home.live.play',compact('live','live_id','tags'));
    }
}
