@extends('layouts.app')
@section('title', '课程详情')

@section('content')
   <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $course->cover_url }}" alt="">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-5">
        <h4 class="font-weight-light">{{ $course->title }}</h1>
        <p>主讲：学习时长：小时</p>
        <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
        <a class="btn btn-success" href="#">立即报名</a>
        <a class="btn btn-primary" href="{{ route('course.study',['id'=>$course->id ])}}">开始学习</a>
      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <!-- Blog Post -->
        <div class="card mb-4">
          <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link active" href="#course-details" data-toggle="tab">课程详情</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#course-outline" data-toggle="tab" >课程大纲</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#course-teacher" data-toggle="tab">授课老师</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">常见问题</a>
                </li>
            </ul>

            <div class="tab-pane in active table-details">
               <p class="card-text">建国君民，教学为先。</p>
            </div>

            <div id="" class="tab-content">
                <div class="tab-pane in active table-details" id="course-details">
                    <p>{{ $course->desc }}</p>
                </div>
                <div class="tab-pane fade table-outline " id="course-outline">
                    <p>课程大纲  课程大纲 课程大纲 课程大纲 课程大纲</p>
                </div>
                <div class="tab-pane fade table-teacher " id="course-teacher">
                    <p>授课老师 授课老师 授课老师 授课老师 授课老师</p>
                </div>
                <div class="tab-pane fade table-problem" id="course-problem">
                    <p>课程问题 课程问题 课程问题 课程问题 课程问题</p>
                </div>
                <div class="tab-pane fade table-evaluate" id="course-evaluate">
                    <p>课程评价  课程评价 课程评价 课程评价 课程评价</p>
                </div>
          </div>

          </div>
        </div>

      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Search Widget -->
        <div class="card mb-4">
          <h5 class="card-header">{{Cache()->get('configs')['web_name']}}</h5>
          <div class="card-body">
            <div class="input-group">
              <p> {{Cache()->get('configs')['web_about_us']}} </p>
              <span class="input-group-btn">
                <!-- <button class="btn btn-secondary" type="button">Go!</button> -->
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">标签查询</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  @foreach($tags as $k=>$tag)
                    @if($k<3)
                    <li>
                      <a href="#">{{ $tag->name}}</a>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  @foreach($tags as $k=>$tag)
                    @if($k>2)
                    <li>
                      <a href="#">{{ $tag->name}}</a>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">更多推荐</h5>
          <div class="card-body">
              <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- 指示符 -->
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                </ul>
                <!-- 轮播图片 -->
                <div class="carousel-inner" id="slide" class="slide">
                    <div class="carousel-item recommend-slide active">
                      <img src="{{ $others[0]->cover_url }}">
                        <div class="carousel-caption">
                          <p>{{ $others[0]->title }}</p>
                        </div>
                    </div>
                    <div class="carousel-item recommend-slide">
                      <img src="{{ $others[1]->cover_url }}">
                        <div class="carousel-caption">
                          <p>{{ $others[1]->title }}</p>
                        </div>
                    </div>
                </div>
                <!-- 左右切换按钮 -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

</div>

@stop
