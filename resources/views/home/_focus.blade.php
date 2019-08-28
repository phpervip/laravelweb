<div id="demo" class="carousel slide" data-ride="carousel">
            <!-- 指示符 -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <!-- 轮播图片 -->
            <div class="carousel-inner" id="slide" class="slide">
                <div class="carousel-item active">
                  <img src="{{ $banners[0]->cover_url }}">
                    <div class="carousel-caption">
                      <p>{{ $banners[0]->title }}</p>
                    </div>
                </div>
                <div class="carousel-item">
                  <img src="{{ $banners[1]->cover_url }}">
                    <div class="carousel-caption">
                      <p>{{ $banners[1]->title }}</p>
                    </div>
                </div>
                <div class="carousel-item">
                  <img src="{{ $banners[2]->cover_url }}">
                    <div class="carousel-caption">
                      <p>{{ $banners[2]->title }}</p>
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
