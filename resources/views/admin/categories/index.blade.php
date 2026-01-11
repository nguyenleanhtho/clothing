@extends('admin.layouts.master')

@section('content')

<h3>Quản lý danh mục</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.categories.store') }}">
@csrf
<input name="name" placeholder="Tên danh mục">
<button>Thêm</button>
</form>

<table border="1" cellpadding="5">
<tr>
<th>Tên</th><th>Slug</th><th>Thao tác</th>
</tr>

@foreach($categories as $c)
<tr>
<td>{{ $c->name }}</td>
<td>{{ $c->slug }}</td>
<td>

<form method="POST" action="{{ route('admin.categories.update',$c->id) }}">
@csrf @method('PUT')
<input name="name" value="{{ $c->name }}">
<button>Sửa</button>
</form>

<form method="POST" action="{{ route('admin.categories.destroy',$c->id) }}">
@csrf @method('DELETE')
<button>Xoá</button>
</form>

</td>
</tr>
@endforeach
</table>

@endsection
