@extends('layouts.app')
@section('title','直播列表')
@section('content')


<!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">首页</a>
      </li>
      <li class="breadcrumb-item active">直播列表</li>
    </ol>

<!-- https://www.runoob.com/bootstrap4/bootstrap4-navbar.html -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand @if( $profession_id == '') active @endif " href="{{route('course.list')}}">全部专业</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @foreach($professions as $pro)
      <li class="nav-item @if( $profession_id == $pro->id) active @endif">
        <a class="nav-link" href="{{route('live.list',array('profession_id'=>$pro->id))}}">{{ $pro->pro_name }} </a>
      </li>
      @endforeach

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="搜索" aria-label="Search" value="{{ $condition['search'] ?? ''}}">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form>
  </div>
</nav>

@include('home.live._foreach')

 <!-- Pagination -->
<div class="pagination justify-content-center">{{ $lives->appends($condition)->render() }}</div>

@endsection('content')
