<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Input;

class NewsController extends Controller
{
    public function list()
    {
        $builder = News::query();
        $categorys = Category::where('parent_id',1)->get()->toArray();  // 初始值
        $condition = [];

        if($search = request('search')){
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
        $news = $builder->paginate(8);
        return view('home.news.list', compact('news','categorys','category_id','condition'));
    }

    public function detail()
    {
        $news = News::find(Input::get('id'));
        return view('home.news.detail', compact('news'));
    }
}
