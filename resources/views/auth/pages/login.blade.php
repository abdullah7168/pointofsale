@extends('auth.layout.master')

@section('css-login')
    <style type="text/css">
    .login-page{
        background:url('images/auth/bg-auth.jpg');
        background-size:cover;
        background-position:center center;
        height:100vh;
    }
    .login-logo > a{
        color:white;
    }  
  </style>
@endsection

@section('login-form')
<p class="login-box-msg">Log In</p>
    <form  method="POST" action="{{ route('login') }}">
      <!-- csrf token field -->
       {{csrf_field()}}
      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" {{ old('username') }} required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        <!-- Error -->
         @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif

      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        <!-- Error -->
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log in</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
@endsection