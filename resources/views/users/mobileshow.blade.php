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
            <i class="glyphicon glyphicon-edit"></i> 绑定手机
          </h4>
        </div>
        <div class="card-body">
          <form action="{{ route('users.bindmobileupdate', $user->id) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('shared._error')
            <div class="alert alert-danger" id="ajaxerror"></div>
            <div class="alert alert-success" id="ajaxsuccess"></div>
            <div class="form-group">
              <label for="mobile-field">输入手机号</label>
              <div class="row col-md-12">
                  <input class="form-control col-md-8" type="text" name="mobile" id="mobile-field" value="18959165336" />
                  <button id="sendCode" type="button" class="btn btn-xs btn-default col-md-3 offset-md-1 text-primary">发送验证码
                  </button>
              </div>
            </div>
            <div class="form-group">
              <label for="code-field">输入验证码</label>
              <div class="row col-md-12">
                  <input class="form-control col-md-8" type="text" name="code" id="code-field" value="" />
              </div>
            </div>
            <div class="form-group row" style="display:block;">
               <label for="password-confirm" class="col-md-6 col-form-label text-md-right">key值</label>
                    <div class="col-md-6">
                        @if(isset($key))
                        <input type="text" name="verification_key" required value="{{ $key }}">
                        @else
                        <input type="text" name="verification_key" required value="{{ old('verification_key') }}">
                        @endif
                    </div>
            </div>
            <div class="well well-sm text-center">
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@stop

@section('scripts')
<script>
    messagehide();
    $("#sendCode").click(function(){
        // 如果此按钮class 中有disabled 则返回。
        if ($("#sendCode").hasClass("disabled")){
            console.log('btn sendCode disabled');
            return false;
        }else{
            console.log('btn sendCode enabled');
        }
        messagehide();
        var mobile = $('input[name="mobile"]').val();
        console.log(mobile);
        var url = '/mobile/ajaxsend?mobile='+ mobile;
        $.ajax({
          type:'GET',
          url:url,
          data:{},
          dataType:'json',
          success:function(res){
            console.log(res);
            $('input[name="verification_key"]').val(res.key);
            $("#ajaxsuccess").show();
            $('#ajaxsuccess').html(res.message);
            // 发送后倒计时
            $("#sendCode").html('重新发送(60s)');
            $("#sendCode").addClass('disabled');
            setTimeout(sendCodeEnable,60000);
            setTimeout(closeMessage,5000);
            // 倒计时：https://blog.csdn.net/I_am_listen/article/details/53056354
          },
          error:function(res){
            var jsonResponse = JSON.parse(res.responseText);
            console.log(jsonResponse);
            $("#ajaxerror").show();
            $('#ajaxerror').html(jsonResponse.errors.mobile[0]);
          },
        });
    });
    function messagehide(){
      $("#ajaxerror").hide();
      $("#ajaxsuccess").hide();
    }

    function sendCodeEnable(){
      $("#sendCode").removeClass('disabled');
      $("#sendCode").html('发送验证码');
    }

    function closeMessage(){
      $("#ajaxsuccess").hide();
    }


</script>
@endsection
