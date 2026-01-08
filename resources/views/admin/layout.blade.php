<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f6f7fb;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1f2937;
            padding: 20px 0;
            color: white;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: #374151;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            padding: 25px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4>ADMIN</h4>

    <a href="{{ route('admin.orders.index') }}"
       class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        Orders
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        Users
    </a>

</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
