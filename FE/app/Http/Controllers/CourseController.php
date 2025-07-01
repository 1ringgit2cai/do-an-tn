<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CourseController extends Controller
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
            $res = $this->client->request('GET', '/courses', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.courses.index', [
                'courses' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.courses.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:0',
        ]);

        $token = session('jwt_token');

        try {
            $this->client->request('POST', '/courses', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'course_code' => $request->input('course_code'),
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'credits' => $request->input('credits'),
                ],
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Thêm môn học thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/courses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ]
            ]);

            $course = json_decode($res->getBody(), true);

            return view('admin.courses.edit', compact('course'));
        } catch (\Exception $e) {
            return redirect()->route('admin.courses.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:0',
        ]);

        $token = session('jwt_token');

        try {
            $this->client->request('PUT', "/courses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'course_code' => $request->input('course_code'),
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'credits' => $request->input('credits'),
                ],
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Cập nhật môn học thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/courses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Xóa môn học thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }

    public function webIndex(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $limit = 10;

        try {
            $res = $this->client->request('GET', '/courses', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('web.courses.index', [
                'courses' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('web.courses.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function webShow($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/courses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ]
            ]);

            $course = json_decode($res->getBody(), true);

            $resAnnouncements = $this->client->request('GET', '/announcements');

            $announcements = json_decode($resAnnouncements->getBody(), true);

            return view('web.courses.show', compact('course', 'announcements'));
        } catch (\Exception $e) {
            return redirect()->route('web.courses.show')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }
}
