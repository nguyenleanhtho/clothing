<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Bootstrap (chỉ dùng component, không layout) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-zinc-50 text-black">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-black text-white p-8 space-y-8">
        <div class="text-2xl font-black tracking-tight">BLUE.ADMIN</div>

        <nav class="space-y-4 text-xs uppercase tracking-widest">
            <a href="{{ route('admin.dashboard') }}" class="block text-gray-300 hover:text-white">Dashboard</a>
            <a href="{{ route('admin.categories.index') }}" class="block text-gray-300 hover:text-white">Danh mục</a>
            <a href="{{ route('admin.products.index') }}" class="block text-gray-300 hover:text-white">Sản phẩm</a>
            <a href="{{ route('admin.orders.index') }}" class="block text-gray-300 hover:text-white">Đơn hàng</a>
            <a href="{{ route('admin.users.index') }}" class="block text-gray-300 hover:text-white">Người dùng</a>
        </nav>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- HEADER --}}
        <header class="h-20 bg-white border-b px-10 flex items-center justify-between">
            <div class="font-bold">@yield('page-title')</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-xs uppercase tracking-widest border px-4 py-2 hover:bg-black hover:text-white transition">
                    Thoát
                </button>
            </form>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-12">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
