@extends('layouts.app')
@section('title', '课程详情')

@section('content')
    <!-- Page Content -->
  <div class="container text-muted">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">
      <small></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">首页</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('course',['id'=>$course->id])}}">{{ $course->title }}</a>
      </li>
    </ol>

    @foreach($lessons as $k=>$lesson)
    <!-- Project One -->
    <div class="row">
      <div class="col-md-1">
        <h3>{{ $k+1 }}</h3>
      </div>
      <div class="col-md-8">
        <h5>{{ $lesson->title }}</h5>
        <p class="introduction"> {{ $lesson->content->content }} </p>
      </div>
      <div class="col-md-3">
        <a class="btn btn-primary" href="{{ route('course.play',['id'=>$lesson->id]) }}">观看
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <a class="btn btn-primary" href="#">收听
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <a class="btn btn-primary" href="#">阅读
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>
    <!-- /.row -->
    <hr>
    @endforeach

     <!-- Pagination -->
     <div class="pagination justify-content-center">{{ $lessons->appends($condition)->render() }}</div>
     <!-- 只需要添加这一行 -->
    <!--  分页扩展学习： https://phpartisan.cn/news/81.html -->

</div>

@stop
