@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}" οnerrοr="this.src='http://laraveluser.yyii.info/uploads/images/avatars/201908/13/2_1565693480_FEzilyMfBu.png'">
      <div class="card-body">
            <h5><strong>个人简介</strong></h5>
            <p>{{ $user->introduction }}</p>
            <hr>
            <h5><strong>注册于</strong></h5>
            <p>{{ $user->created_at->diffForHumans() }}</p>
      </div>
    </div>
    <div class="card ">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{route('users.setbindsns',Auth::user()->id)}}">帐号绑定</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.edit',$user->id) }}">编辑资料</a>
        </li>

      </ul>
   </div>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="card ">
      <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
      </div>
    </div>
    <hr>

    {{-- 用户发布的内容 --}}
    <div class="card ">
      <div class="card-body">
        暂无数据 ~_~
      </div>
    </div>

  </div>
</div>
@stop
