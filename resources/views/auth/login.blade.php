<!DOCTYPE html>
<html>
<head>
    <title>Login RentSCar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#1a0000;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            background:#2b0000;
            padding:40px;
            border-radius:15px;
            width:400px;
            color:white;
            box-shadow:0 0 20px rgba(255,0,0,0.3);
        }

        .btn-login{
            background:#b30000;
            border:none;
        }

        .btn-login:hover{
            background:#ff0000;
        }

        .form-control{
            background:#222;
            border:1px solid #800000;
            color:white;
        }

        .form-control:focus{
            background:#222;
            color:white;
            border-color:red;
            box-shadow:none;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h2 class="text-center mb-4">RentSCar Login</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <button class="btn btn-login text-white w-100">
            Login
        </button>

    </form>

</div>

</body>
</html>
