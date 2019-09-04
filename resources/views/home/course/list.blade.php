@extends('layouts.app')
@section('title','课程列表')
@section('content')


 <!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">首页</a>
      </li>
      <li class="breadcrumb-item active">点播列表</li>
    </ol>


<!-- https://www.runoob.com/bootstrap4/bootstrap4-navbar.html -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand @if( $category_id == '') active @endif " href="{{route('course.list')}}">全部分类</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @foreach($categorys as $cate)
        @if($cate['childs'] == 1)
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              {{ $cate['title'] }}
            </a>
              <div class="dropdown-menu">
              @foreach($cate['childs_arr'] as $v)
                  <a class="dropdown-item" href="{{route('course.list',array('category_id'=>$v['id']))}}">{{ $v['title'] }}</a>
              @endforeach()
            </div>
          </li>
        @else
          <li class="nav-item @if( $category_id == $cate['id']) active @endif">
            <a class="nav-link" href="{{route('course.list',array('category_id'=>$cate['id']))}}">{{ $cate['id'] }} </a>
          </li>
        @endif
      @endforeach
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="搜索" aria-label="Search" value="{{ $condition['search'] ?? ''}} ">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form>
  </div>
</nav>

@include('home.course._foreach')

 <!-- Pagination -->
<div class="pagination justify-content-center">{{ $courses->appends($condition)->render() }}</div>

@endsection('content')
