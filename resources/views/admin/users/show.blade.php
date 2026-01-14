@extends('admin.layouts.master')

@section('title', 'Chi tiết người dùng')

@section('content')
<div class="max-w-xl space-y-6 text-black">

    <h1 class="text-3xl font-black">Thông tin người dùng</h1>

    <div class="bg-white border rounded-2xl p-6 space-y-3">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Vai trò:</strong> {{ $user->roles }}</p>
        <p>
            <strong>Ngày tạo:</strong>
            {{ $user->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <div>
        <a href="{{ route('admin.users.index') }}"
           class="inline-block px-6 py-3 border rounded-xl">
            Quay lại
        </a>
    </div>

</div>
@endsection
