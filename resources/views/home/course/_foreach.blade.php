 <!-- Portfolio Section 点播课程-->


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
              <a href="{{ route('course',array('id'=>$course->id)) }}"> {{ $course->title }}</a>
              </h6>
              <p class="card-text">{{ $course->updated_at }}</p>
        </div>
      </div>
      @endforeach
