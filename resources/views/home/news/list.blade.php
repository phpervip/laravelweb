@extends('layouts.app')
@section('title','文章列表')
@section('content')
   <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">首页</a>
      </li>
      <li class="breadcrumb-item active">文章列表</li>
    </ol>

    <div class="row">
         <!-- Sidebar Column -->
          <div class="col-lg-3 mb-4">

             <!-- Search Widget -->
            <div class="mb-4">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control mr-2" name="search" placeholder="搜索" value="{{ $condition['search'] ?? ''}}">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                  </span>
                </div>
              </form>
            </div>

            <div class="list-group">
              <a href="{{ route('news.list') }}" class="list-group-item @if( $category_id == '') active @endif">全部分类</a>
              @foreach($categorys as $cate)
              <a href="{{ route('news.list', array('category_id'=>$cate['id'])) }}" class="list-group-item @if( $category_id == $cate['id']) active @endif">{{ $cate['title'] }}</a>
              @endforeach
            </div>
          </div>

          <!-- Content Column -->
          <div class="col-lg-9 mb-4">
              @foreach($news as $item)
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <a href="#">
                        <img class="img-fluid rounded" src="{{ $item->cover_url}}" alt="">
                      </a>
                    </div>
                    <div class="col-lg-8">
                      <h2 class="card-title">{{ $item->title }}</h2>
                      <p class="card-text">{{ $item->desc }}</p>
                      <a href="{{ route('news.detail',array('id'=>$item->id)) }}" class="btn btn-primary">阅读全文 &rarr;</a>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-muted">
                  更新于 {{ $item->created_at }} 作者
                  <a href="#">{{ $item->author }}</a>
                </div>
              </div>
              @endforeach

              <!-- Pagination -->
              <div class="pagination justify-content-center">{{ $news->render() }}</div>
          </div>

          <!-- /! Content -->
      </div>
  </div>

@endsection

