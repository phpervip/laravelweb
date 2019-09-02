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
              <img src="{{ $live->cover_url }}" class="img-thumbnail" alt="">
              </a>
          </div>
          <div class="col-8">
                <a href="{{ route('live.play',array('id'=>$live->id)) }}">{{ $live->title }}</a>
                </h6>
                <p class="card-text">{{ $live->updated_at }}</p>
          </div>
        </div>
    @endforeach
