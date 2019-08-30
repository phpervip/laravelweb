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
