@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
   @include('users._userinfo')
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="card">
      <div class="card-header">
        <h4>
          <i class="glyphicon glyphicon-edit"></i> 重设密码
        </h4>
      </div>

      <div class="card-body">
        <form action="{{ route('users.passwordreset', $user->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @include('shared._error')
          <div class="form-group row">
            <label for="oldpassword-field" class="col-md-4 col-form-label text-md-right">原{{ __('Password') }}</label>
              <div class="col-md-6">
                <input class="form-control" type="password" name="oldpassword" id="oldpassword-field" value="" required />
              </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">新{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @enderror
                </div>
          </div>
          <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" >
              </div>
          </div>
          <div class="well well-sm  text-center">
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>

@endsection
