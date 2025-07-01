<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('jwt_token')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $client = new Client();
            $response = $client->post('http://127.0.0.1:3001/auth/login', [
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            session([
                'jwt_token' => $data['token'],
                'admin' => $data['admin'],
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $message = json_decode($response->getBody(), true)['message'] ?? 'Sai thông tin đăng nhập!';
            return back()->withInput()->withErrors(['email' => $message]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['email' => 'Lỗi kết nối: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['jwt_token', 'admin']);
        return redirect()->route('admin.loginForm')->with('success', 'Đăng xuất thành công!');
    }
}
