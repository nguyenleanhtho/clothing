@extends('admin.layouts.master')

@section('content')
<h3>Quản lý sản phẩm</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.products.store') }}">
@csrf
<input name="name" placeholder="Tên" required>
<select name="idCategory" required>
@foreach($categories as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>
<input name="price" placeholder="Giá" type="number" min="0" step="0.01" required>
<input name="stock" placeholder="SL" type="number" min="0" required>
<textarea name="description" placeholder="Mô tả"></textarea>
<button>Thêm</button>
</form>

<table border="1">
<tr>
<th>Tên</th><th>Danh mục</th><th>Giá</th><th>SL</th><th>Mô tả</th><th>Thao tác</th>
</tr>
@foreach($products as $p)
<tr>
<td>{{ $p->name }}</td>
<td>{{ $p->category->name ?? '' }}</td>
<td>{{ number_format($p->price) }}</td>
<td>{{ $p->stock }}</td>
<td>{{ Str::limit($p->description, 50) }}</td>
<td>
<form method="POST" action="{{ route('admin.products.update', $p->id) }}" style="display:inline-block;">
@csrf @method('PUT')
<input name="name" value="{{ $p->name }}" required>
<select name="idCategory" required>
@foreach($categories as $c)
<option value="{{ $c->id }}" {{ $c->id == $p->idCategory ? 'selected' : '' }}>{{ $c->name }}</option>
@endforeach
</select>
<input name="price" value="{{ $p->price }}" type="number" min="0" step="0.01" required>
<input name="stock" value="{{ $p->stock }}" type="number" min="0" required>
<textarea name="description">{{ $p->description }}</textarea>
<button>Sửa</button>
</form>
<form method="POST" action="{{ route('admin.products.destroy', $p->id) }}" style="display:inline-block;">
@csrf @method('DELETE')
<button onclick="return confirm('Xoá sản phẩm này?')">Xoá</button>
</form>
</td>
</tr>
@endforeach
</table>
@endsection