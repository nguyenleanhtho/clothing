@extends('admin.layouts.master')

@section('title', 'Quản lý danh mục')
@section('page-title', 'Danh mục')

@section('content')
<div class="space-y-10">

    <!-- Header -->
    <div class="flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight">Danh mục</h1>
            <p class="mt-1 text-xs uppercase tracking-widest text-gray-400">
                Quản lý hệ thống phân loại sản phẩm
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-black text-white px-6 py-3 text-xs font-black uppercase tracking-widest
                  hover:bg-neutral-800 transition rounded-xl shadow">
            + Thêm danh mục
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 text-[10px] uppercase tracking-widest text-gray-400">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Tên danh mục</th>
                    <th class="px-6 py-4 text-center">Hành động</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($categories as $category)
                    <tr class="hover:bg-zinc-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-500">
                            #{{ $category->id }}
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            {{ $category->name }}
                        </td>

                        <td class="px-6 py-4 text-center space-x-4">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="text-xs font-bold uppercase tracking-widest text-blue-600 hover:underline">
                                Sửa
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-xs font-bold uppercase tracking-widest text-red-500 hover:underline">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center text-gray-400 text-sm">
                            Chưa có danh mục nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
