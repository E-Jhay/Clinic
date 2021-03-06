<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('custom-css/style.css') }}">
    <link rel="icon" href="{{ asset('dist/img/psu.png') }}" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{asset('custom-img/wave.png')}}">
	<div class="container">
		<div class="img">
			<img src="{{asset('custom-img/password.svg')}}">
		</div>
		<div class="login-content">
			<form method="POST" action="{{ route('password.email') }}">
                @csrf
				<img src="{{asset('custom-img/avatar.svg')}}">
				<h4 class="title">Forgot Password</h4>
           		<div class="">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
           		</div>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>E-mail</h5>
           		   		<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
           		   </div>
           		</div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            	<input type="submit" class="btn" value="Send Password reset link">
            </form>	
        </div>
    </div>
    <script type="text/javascript" src="{{asset('custom-js/main.js')}}"></script>
</body>
</html>
