<!DOCTYPE html>
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	</head>
        <body>
            <div class="login">
                <h1>Login</h1>
                <form action = " {{ route('pushlogin') }} " method="post">
                    @csrf
                    <label for="username">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="name" placeholder="Username" id="name" required>
                        <label for="password">
                            <i class="fas fa-lock"></i>
                        </label>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <input type="submit" value="Login">
                </form>

            </div>
        </body>
</html>
