<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Thư viện xử lý đăng nhập
use Illuminate\Support\Facades\Hash; // Thư viện mã hóa mật khẩu
use App\Models\User; // Model User (có sẵn trong Laravel)

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('client.auth.login');
    }

    public function showRegister()
    {
        return view('client.auth.register');
    }
    


    // 1. XỬ LÝ ĐĂNG NHẬP
    public function login(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Thử đăng nhập
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Kiểm tra ô "Remember me"

        if (Auth::attempt($credentials, $remember)) {
            // Đăng nhập thành công -> Về trang chủ
            return redirect()->route('client.index')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập thất bại -> Quay lại trang cũ
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }

    // 2. XỬ LÝ ĐĂNG KÝ
    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // confirmed để check 2 ô mật khẩu giống nhau
        ]);

        // Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        // Đăng nhập luôn sau khi đăng ký
        Auth::login($user);

        return redirect()->route('client.index')->with('success', 'Đăng ký thành công!');
    }

    // 3. XỬ LÝ ĐĂNG XUẤT
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.index');
    }
}