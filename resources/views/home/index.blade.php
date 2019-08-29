@extends('layouts.app')
@section('title', '首页')

@section('content')
   <!-- Features Section -->
    <div class="row">
      <div class="col-lg-8">
        <!-- 左边轮播图 -->
         @include('home._focus')
      </div>
      <div class="col-lg-4">
        <!-- 右边资讯标题 -->
         @include('home._sidebar')

      </div>

    </div>
    <!-- /.row -->

     <!-- Portfolio Section -->
    <h5 class="mt-4 text-secondary">推荐课程</h5>
    <div class="row">
      @foreach($courses as $course)
      <div class="col-lg-3 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="{{ $course->cover_url }}" alt=""></a>
          <div class="card-body">
            <h6 class="card-title">
              <a href="#"> {{ $course->title }}</a>
            </h6>
            <p class="card-text">{{ $course->updated_at }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <!-- /.row -->

  <!-- Marketing Icons Section -->
    <h5 class="text-secondary">会员心声</h5>
    <div class="row">
      @foreach($users as $user)
      <div class="col-lg-3 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <div class="col-3 user-item">
                <div class="media ">
                  <div class="media-left media-middle mr-2">
                    <img src="{{ $user->member_avatar_url }}" width="24px" height="24px" class="media-object">
                  </div>
                  <div class="media-body">
                    <small class="media-heading text-secondary"></small>
                    <a href=""> <h5>{{ $user->nickname}}</h5> </a>
                  </div>
                </div>
            </div>
            <p class="card-text mt-2 user-introduction" >{{ $user->introduction}}</p>
          </div>
        </div>
      </div>
     @endforeach
    </div>
    <!-- /.row -->
</div>

@stop
