@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="container">
  <div class="row">

    @include('users._userinfo')
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

      {{-- 要绑定的内容 --}}
      <div class="card">
        <div class="card-header">
            <h4>
              <i class="glyphicon glyphicon-edit"></i> 帐号绑定
            </h4>
        </div>
        <div class="card-body">
          <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('shared._error')
            <table class="table">
                <tbody>
                  <tr>
                    <td>手机号码</td>
                    <td>{{$user->mobile}}</td>
                    @if($user->mobile)
                      <td><i class="icon checkmark green"></i> 已验证</td>
                      <td><a target="_blank" href="" class="tdu"></a></td>
                      @else
                      <td>未绑定</td>
                      <td><a target="_blank" href="{{route('users.bindmobileshow',$user->id)}}" class="tdu">前往绑定</a></td>
                    @endif
                  </tr>
                  <tr>
                    <td>邮箱</td>
                    <td>{{$user->email}}</td>
                     @if($user->email)
                      <td><i class="icon checkmark green"></i> 已验证</td>
                      <td><a target="_blank" href="" class="tdu"></a></td>
                      @else
                      <td>未填写</td>
                      <td><a target="_blank" href="{{ route('users.edit',$user->id) }}" class="tdu">前往补充</a></td>
                    @endif
                  </tr>
                </tbody>
            </table>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@stop
