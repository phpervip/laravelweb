  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
      @if($user->member_avatar)
          <img class="card-img-top" src="{{ $user->member_avatar }}" alt="{{ $user->username }}">
      @endif
      <div class="card-body">
            <h5><strong>个人简介</strong></h5>
            <p>{{ $user->introduction }}</p>
            <hr>
            <h5><strong>注册于</strong></h5>
            <p>{{ $user->created_at->diffForHumans() }}</p>
      </div>
    </div>
    <div class="card" style="margin-top:20px;">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.setbindsns',$user->id) }}">帐号绑定</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.edit',$user->id) }}">编辑资料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.passwordreset',$user->id) }}">密码重设</a>
        </li>
      </ul>
   </div>
  </div>
