<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LecturerController extends Controller
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
            $res = $this->client->request('GET', '/lecturers', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.lecturers.index', [
                'lecturers' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.lecturers.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'academic_title' => 'required|string|max:100',
            'department' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'full_name', 'contents' => $request->input('full_name')],
                ['name' => 'academic_title', 'contents' => $request->input('academic_title')],
                ['name' => 'department', 'contents' => $request->input('department')],
                ['name' => 'bio', 'contents' => $request->input('bio')],
            ];

            if ($request->hasFile('image')) {
                $multipart[] = [
                    'name' => 'image',
                    'contents' => fopen($request->file('image')->getPathname(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName(),
                ];
            }

            $this->client->request('POST', '/lecturers', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.lecturers.index')->with('success', 'Thêm giảng viên thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/lecturers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            $lecturer = json_decode($res->getBody(), true);

            return view('admin.lecturers.edit', compact('lecturer'));
        } catch (\Exception $e) {
            return redirect()->route('admin.lecturers.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'academic_title' => 'required|string|max:100',
            'department' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'full_name', 'contents' => $request->input('full_name')],
                ['name' => 'academic_title', 'contents' => $request->input('academic_title')],
                ['name' => 'department', 'contents' => $request->input('department')],
                ['name' => 'bio', 'contents' => $request->input('bio')],
            ];

            if ($request->hasFile('image')) {
                $multipart[] = [
                    'name' => 'image',
                    'contents' => fopen($request->file('image')->getPathname(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName(),
                ];
            }

            $this->client->request('PUT', "/lecturers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.lecturers.index')->with('success', 'Cập nhật giảng viên thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/lecturers/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.lecturers.index')->with('success', 'Xóa giảng viên thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }

    public function webIndex()
    {
        try {
            $res = $this->client->request('GET', "/lecturers", [
                'query' => [
                    'limit' => 1000
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            $lecturers = $data['data'];

            return view('web.lecturers.index', compact('lecturers'));
        } catch (\Exception $e) {
            return redirect()->route('web.lecturers.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }
}
