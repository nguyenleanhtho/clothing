@extends('admin.layouts.master')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="space-y-6 text-black">

    <h1 class="text-3xl font-black">Danh sách người dùng</h1>

    <div class="overflow-x-auto bg-white border rounded-2xl shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Tên</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-center">Vai trò</th>
                    <th class="p-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $user->id }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3 text-center">
                        <span class="px-3 py-1 border rounded-full text-xs">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="text-blue-600 hover:underline">
                            Xem
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
