@extends('layouts.app')
@section('title', '首页')

@section('content')
  <div class="row">

      <!-- 左边轮播图 -->
      <div class="col-sm-8">
          <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- 指示符 -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- 轮播图片 -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://static.runoob.com/images/mix/img_fjords_wide.jpg">
                  <div class="carousel-caption">
                    <h3>第1张图片描述标题</h3>
                    <p>描述文字!</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="https://static.runoob.com/images/mix/img_nature_wide.jpg">
                <div class="carousel-caption">
                    <h3>第2张图片描述标题</h3>
                    <p>描述文字!</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="https://static.runoob.com/images/mix/img_mountains_wide.jpg">
                <div class="carousel-caption">
                    <h3>第3张图片描述标题</h3>
                    <p>描述文字!</p>
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

      <!-- 右边资讯标题 -->
      <div class="col-sm-4">
        <ul>
          <li>新闻1</li>
          <li>新闻2</li>
          <li>新闻2</li>
          <li>新闻2</li>
          <li>新闻2</li>
          <li>新闻2</li>
        </ul>
      </div>
  </div>

@stop
