<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class RegisterController extends Controller
{
    protected $client;
    protected $baseUrl = 'http://127.0.0.1:3001';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $limit = 10;

        try {
            $token = session('jwt_token');

            $res = $this->client->request('GET', '/registers', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.registers.index', [
                'registers' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.registers.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{L}\s\.\'-]+$/u' // Cho phép chữ, khoảng trắng, dấu chấm, nháy đơn
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^0[0-9]{9}$/', // VD: 0912345678
            ],
            'email' => [
                'required',
                'email',
                'max:100',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'education' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{L}\s\-\/]+$/u', // VD: Cử nhân / Kỹ sư
            ],
            'major' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{L}\s\-\&]+$/u', // VD: Công nghệ & Thông tin
            ],
        ], [
            'required' => 'Vui lòng nhập :attribute.',
            'email' => 'Vui lòng nhập đúng định dạng email.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'regex' => ':attribute không hợp lệ.',
        ]);

        // Đặt tên các trường bằng tiếng Việt
        $validator->setAttributeNames([
            'full_name' => 'họ và tên',
            'phone' => 'số điện thoại',
            'email' => 'email',
            'address' => 'quê quán',
            'education' => 'trình độ hiện tại',
            'major' => 'chuyên ngành',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $multipart = [
                ['name' => 'full_name', 'contents' => $request->input('full_name')],
                ['name' => 'phone', 'contents' => $request->input('phone')],
                ['name' => 'email', 'contents' => $request->input('email')],
                ['name' => 'address', 'contents' => $request->input('address')],
                ['name' => 'education', 'contents' => $request->input('education')],
                ['name' => 'major', 'contents' => $request->input('major')],
            ];

            $this->client->request('POST', '/registers', [
                'multipart' => $multipart,
            ]);

            return redirect()->route('web.home')->with('success', 'Gửi thông tin đăng ký thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'message' => 'API lỗi: ' . $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $token = session('jwt_token');

            $res = $this->client->request('GET', "/registers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            $register = json_decode($res->getBody(), true);

            return view('admin.registers.edit', compact('register'));
        } catch (\Exception $e) {
            return redirect()->route('admin.registers.index')->withErrors(['message' => 'Không lý dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $token = session('jwt_token');

            // Nhận status và kiểm tra status
            $status = $request->input('status');
            if ($status !== 'pending' && $status !== 'processed') {
                return back()->withInput()->withErrors([
                    'status' => 'Trạng thái không hợp lệ.',
                ]);
            }

            $multipart = [
                ['name' => 'status', 'contents' => $status],
            ];

            $this->client->request('PUT', "/registers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.registers.index')->with('success', 'Cập nhật dữ liệu thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'message' => 'API lỗi: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $token = session('jwt_token');

            $this->client->request('DELETE', "/registers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.registers.index')->with('success', 'Xóa dữ liệu thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }
}
