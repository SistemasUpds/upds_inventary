
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

/* 'Open Sans' font from Google Fonts */
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
  background: rgb(0, 74, 148);
  font-family: 'Open Sans', sans-serif;
}

.login {
  width: 400px;
  margin: 16px auto;
  font-size: 16px;
}

/* Reset top and bottom margins from certain elements */
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

/* The triangle form is achieved by a CSS hack */
.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

/* Every row inside .login-container is defined with p tags */
.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="email"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

/* Text fields' focus effect */
.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

/* Buttons' focus effect */
.login input[type="submit"]:focus {
  border-color: #05a;
}
    </style>
</head>
<body>
    <div class="login">
        <div class="login-triangle"></div>
    <h2 class="login-header">CONTROL CARNETS</h2>
                        <form class="login-container" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <p><input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required autofocus></p>
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <p><input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required></p>
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <!--div class="row">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuerdame') }}
                                        </label>
                                    </div>
                            </div-->
                                <p>
                                    <input type="submit" value="Iniciar Sesión">
                                    @if (Route::has('password.request'))
                                        <!--a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a-->
                                    @endif
                                </p>
                        </form>
    </div>
</body>
</html>