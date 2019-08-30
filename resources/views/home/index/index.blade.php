@extends('layouts.app')
@section('title', '首页')

@section('content')
   <!-- Features Section -->
    <div class="row">
      <div class="col-lg-8 md-4">
        <!-- 左边轮播图 -->
         @include('home.index._focus')
      </div>
      <div class="col-lg-4">
        <!-- 右边资讯标题 -->
         @include('home.index._sidebar')

      </div>

    </div>
    <!-- /.row -->

     <!-- Portfolio Section 点播课程-->
    <h5 class="mt-4 text-secondary">点播课程</h5>

    <div class="row">
      @foreach($courses as $course)
      <div class="col-lg-3 col-sm-6 portfolio-item d-none d-md-block">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="{{ $course->cover_url }}" alt=""></a>
          <div class="card-body">
            <h6 class="card-title">
              <a href="{{ route('course',array('id'=>$course->id)) }}"> {{ $course->title }}</a>
            </h6>
            <p class="card-text">{{ $course->updated_at }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>

      <!-- 使用 Bootstrap 4 顯示/隱藏 HTML 元素 -->
      <!-- https://poychang.github.io/visible-and-hidden-in-bootstrap-4/ -->
      @foreach($courses as $course)
      <div class="row mt-2 d-md-none">
         <div class="col-4">
            <a href="#">
            <img src="{{ $course->cover_url }}" class="img-thumbnail" alt="">
            </a>
        </div>
        <div class="col-8">
              <a href="{{ route('course',array('id'=>$course->id)) }}">0000 {{ $course->title }}</a>
              </h6>
              <p class="card-text">{{ $course->updated_at }}</p>
        </div>
      </div>
      @endforeach

     <!-- Portfolio Section 直播课程-->
    <h5 class="mt-4 text-secondary">直播课程</h5>
    <div class="row">
      @foreach($lives as $live)
      <div class="col-lg-3 col-sm-6 portfolio-item d-none d-md-block">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="{{ $live->cover_url }}" alt=""></a>
          <div class="card-body">
            <h6 class="card-title">
              <a href="{{ route('live.play',array('id'=>$live->id)) }}"> {{ $live->title }}</a>
            </h6>
            <p class="card-text">{{ $live->updated_at }}</p>
          </div>
        </div>
      </div>
      @endforeach
     </div>
    <!-- /.row -->

    @foreach($lives as $live)
        <div class="row mt-2 d-md-none">
           <div class="col-4">
              <a href="#">
              <img src="{{ $course->cover_url }}" class="img-thumbnail" alt="">
              </a>
          </div>
          <div class="col-8">
                <a href="{{ route('course',array('id'=>$course->id)) }}">{{ $live->title }}</a>
                </h6>
                <p class="card-text">{{ $live->updated_at }}</p>
          </div>
        </div>
    @endforeach

  <!-- Marketing Icons Section -->
    <h5 class="mt-4 text-secondary">会员心声</h5>
    <div class="row">
      @foreach($users as $user)
      <div class="col-lg-3 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <div class="col-3 user-item">
                <div class="media ">
                  <div class="media-left media-middle mr-2">
                    <img src="{{ $user->member_avatar_url }}" width="24px" height="24px" class="media-object">
                  </div>
                  <div class="media-body">
                    <small class="media-heading text-secondary"></small>
                    <a href="##"> <h5>{{ $user->nickname}}</h5> </a>
                  </div>
                </div>
            </div>
            <p class="card-text mt-2 introduction" >{{ $user->introduction}}</p>
          </div>
        </div>
      </div>
     @endforeach
 </div>
    <!-- /.row -->
</div>

@stop
