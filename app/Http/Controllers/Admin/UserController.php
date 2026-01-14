<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Danh sách người dùng
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Xem chi tiết người dùng
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
