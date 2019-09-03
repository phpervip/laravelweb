@extends('layouts.app')
@section('title','视频播放')
@section('content')
  <div class="container text-muted">
    <!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">首页</a>
      </li>
      <li class="breadcrumb-item active"><a href="{{ route('course.lessons',['id'=>$course_id])}}">返回列表</a></li>
    </ol>
    <h2 class="mt-4 mb-3">
      <small>{{ $lesson->title }}
        <a href="#"></a>
      </small>
    </h2>
    <!-- https://mdbootstrap.com/plugins/jquery/video/ -->
    <!-- 16:9 aspect ratio -->
    <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="{{ $lesson->video->video_url_only }}"></iframe>
    </div>

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Preview Image -->
        <hr>
        <!-- Date/Time -->
        <p>{{ $lesson->title }} | 讲演时间： {{ $lesson->created_at }}</p>
        <hr>
        <!-- Post Content -->
        <blockquote class="blockquote" style="height:300px; overflow-y:auto;">
          <small class="mb-0">{!! isset($lesson->content)? $lesson->content->content : '' !!}</small>
        </blockquote>
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">心得分享</h5>
          <div class="card-body">
            <form>
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">提交</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <!-- Comment with nested comments -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Categories Widget 标签查询 -->
        @include('home.shared._tag')
        <!-- Side Widget 关于我们 -->
        @include('home.shared._about_us')

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

@stop
