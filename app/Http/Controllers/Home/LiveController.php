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

        // $baidu_as = Cache()->get('configs')['baidu_accessKey'];
        // 或者写在.env
        $baidu_as = env('BAIDU_ACCESSKEY','');

        return view('home.live.play',compact('live','live_id','tags','baidu_as'));
    }

    // 直播列表
    public function list(Request $request){
          $builder = Live::query();
          $condition = [];
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('desc', 'like', $like);
            });
            $conditon['search'] = $search;
        }
        if ($profession_id = request('profession_id')) {
            $builder->where('profession_id', $profession_id);
        }
        $lives = $builder->paginate(12);
        $professions = Profession::get();   // 初始值
        return view('home.live.list',compact('lives','professions','profession_id','condition'));
    }
}
