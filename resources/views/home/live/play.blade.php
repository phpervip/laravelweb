@extends('layouts.app')
@section('title','视频播放')
@section('content')
  <div class="container text-muted">
    <!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">首页</a>
      </li>
      <li class="breadcrumb-item active">正在直播</li>
    </ol>
    <h2 class="mt-4 mb-3">
      <small>{{ $live->title }}
        <a href="#"></a>
      </small>
    </h2>

    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-8">
        <h3></h3>
        <div>
            <div id="playercontainer" class="text-right"></div>
        </div>
        <!-- Preview Image -->
        <hr>
        <!-- Date/Time -->
        <p> </p>
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
@section('scripts')
<script src="{{ asset('js/cyberplayer.js') }}"></script>
<script type="text/javascript">
    // var filepath = "http://gcqq450f71eywn6bv7u.exp.bcevod.com/mda-hbqagik5sfq1jsai/mda-hbqagik5sfq1jsai.mp4";    // 百度mp4示例
    // var fileimage = "http://gcqq450f71eywn6bv7u.exp.bcevod.com/mda-hbqagik5sfq1jsai/mda-hbqagik5sfq1jsai.jpg";   // 百度mp4示例预览图
    var filepath = "{{$live->stream->stream_name}}";
    var fileimage = "{{$live->cover_url}}";
   // 百度mp4示例预览图
    //var filepath = "{{$live->stream->stream_name}}";
    //var fileimage = "{{$live->cover_url}}";

    var baidu_accessKey = "{{$baidu_as}}";
    var player = cyberplayer("playercontainer").setup({
        width: 680, // 宽度，也可以支持百分比(不过父元素宽度要有)
        height: 448, // 高度，也可以支持百分比
        title: "直播中", // 标题
        file: filepath,
        image: fileimage,
        autostart: false, // 是否自动播放
        stretching: "uniform", // 拉伸设置
        repeat: false, // 是否重复播放
        volume: 100, // 音量
        controls: true, // controlbar是否显示
        starttime: 0, // 视频开始播放时间点(单位s)，如果不设置，则可以从上次播放时间点续播
        logo: {   // logo设置
            linktarget: "_blank",
            margin: 8,
            hide: false,
            position: "top-right", // 位置
            file: "" // 图片地址
        },
        ak: baidu_accessKey  // 公有智能云平台注册即可获得accessKey 77ae   依** 的帐号

    });
</script>
@stop
