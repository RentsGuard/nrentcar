<!DOCTYPE html>
<html>
<head>
    <title>RentGuards</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

    body{
        margin:0;
        background:#050505;
        color:white;
        font-family:Arial, Helvetica, sans-serif;
    }

    .sidebar{
        width:250px;
        height:100vh;
        position:fixed;
        left:0;
        top:0;
        background:#1a0000;
        padding:20px;
        overflow-y:auto;
    }

    .main-content{
        margin-left:250px;
        padding:20px;
    }

    .sidebar-menu{
        list-style:none;
        padding:0;
    }

    .sidebar-menu li{
        margin-bottom:10px;
    }

    .sidebar-menu a{
        display:flex;
        align-items:center;
        gap:10px;
        text-decoration:none;
        color:white;
        padding:12px;
        border-radius:10px;
    }

    .sidebar-menu a:hover{
        background:#660000;
    }

    .sidebar-menu a.active{
        background:red;
    }

    </style>

</head>
<body>

@if(auth()->check())

<div class="sidebar">

    <h4 class="text-danger">RentGuards</h4>

    <ul class="sidebar-menu">

        <li>
            <a href="/admin/dashboard">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="/mobil">
                <i class="bi bi-car-front"></i>
                Mobil
            </a>
        </li>

        <li>
            <a href="/customer">
                <i class="bi bi-people"></i>
                Customer
            </a>
        </li>

        @if(auth()->user()->role == 'admin')

        <li>
            <a href="/staff">
                <i class="bi bi-person"></i>
                Kelola Staff
            </a>
        </li>

        @endif

    </ul>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>

<div class="main-content">
    @yield('content')
</div>

@else

@yield('content')

@endif

</body>
</html>