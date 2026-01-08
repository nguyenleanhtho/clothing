@extends('admin.layout')

@section('title', 'Users')

@section('content')

<h2 class="mb-3">Danh sách người dùng</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>

                        <td>
                            <span class="badge 
                                {{ $u->role == 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>

                        <td>{{ $u->phone }}</td>
                        <td>{{ $u->address }}</td>
                        <td>{{ $u->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
