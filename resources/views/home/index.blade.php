@extends('layouts.app')
@section('title', '首页')

@section('content')
  <div class="row">
      <!-- 左边轮播图 -->
      <div class="col-lg-8 col-sm-8 mt-4 focus-slide ">
           @include('home._focus')
      </div>

      <!-- 右边资讯标题 -->
      <div class="col-lg-4 col-sm-4 news-card">
          @include('home._sidebar')
      </div>
  </div>

  <div class="row">
      <div class="col-lg-12 mt-4 courses-card">
        <div class="card">
          <div class="card-header">
            <span>推荐课程</span>
          </div>
          <div class="card-body">
              <div class="row courses-list">
                @foreach($courses as $course)
                  <div class="col-3 course-item">
                    <div class="course-content">
                      <div class="top">
                        <div class="img"><img src="{{ $course->cover_url }}" alt=""></div>
                        <div class="title">
                          <a href="{{ route('index') }}">
                          {{ $course->title }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
             </div>
         </div>
       </div>
     </div>
  </div>

    <div class="row">
      <div class="col-lg-12 mt-4 users-story">
        <div class="card">
          <div class="card-header">
            <span>会员心声</span>
          </div>
          <div class="card-body">
              <div class="row users-list">
                @foreach($users as $user)
                  <div class="col-3 user-item">
                      <div class="media mt-2">
                        <div class="media-left media-middle mr-2 ml-1">
                          <img src="{{ $user->member_avatar_url }}" width="24px" height="24px" class="media-object">
                        </div>
                        <div class="media-body">
                          <small class="media-heading text-secondary"></small>
                          <a href=""> <h5>{{ $user->nickname}}</h5> </a>
                          <p>
                            {{ $user->introduction,'' }}
                          </p>
                        </div>
                      </div>


                  </div>
                @endforeach
             </div>
         </div>
       </div>
     </div>
  </div>



</div>

@stop
