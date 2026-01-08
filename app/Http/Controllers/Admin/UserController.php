<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name','email','role','phone','address','created_at')->get();

        $users->transform(function ($user) {
            $user->id = '****' . substr($user->id, -3);
            $parts = explode('@', $user->email);
            if (count($parts) === 2) {
                $user->email = substr($parts[0], 0, 3) . '****@' . $parts[1];
            }
            if ($user->phone) {
                $user->phone = substr($user->phone, 0, 3) . '****' . substr($user->phone, -3);
            }
            return $user;
        });

        return view('admin.users.index', compact('users'));
    }
}
