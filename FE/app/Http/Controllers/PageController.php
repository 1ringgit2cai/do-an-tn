<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PageController extends Controller
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

    // [GET] /admin/pages
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $limit = 10;

        try {
            $res = $this->client->request('GET', '/pages', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.pages.index', [
                'pages' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.pages.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|string|in:support,admission',
        ]);

        $token = session('jwt_token');

        $multipart = [
            ['name' => 'title', 'contents' => $request->input('title')],
            ['name' => 'content', 'contents' => $request->input('content')],
            ['name' => 'slug', 'contents' => $request->input('slug')],
            ['name' => 'type', 'contents' => $request->input('type')],
        ];

        try {
            $this->client->request('POST', '/pages', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.pages.index')->with('success', 'Thêm trang thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/pages/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            $page = json_decode($res->getBody(), true);

            return view('admin.pages.edit', compact('page'));
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|string|in:support,admission',
        ]);

        $token = session('jwt_token');

        $multipart = [
            ['name' => 'title', 'contents' => $request->input('title')],
            ['name' => 'content', 'contents' => $request->input('content')],
            ['name' => 'slug', 'contents' => $request->input('slug')],
            ['name' => 'type', 'contents' => $request->input('type')],
        ];

        try {
            $this->client->request('PUT', "/pages/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.pages.index')->with('success', 'Cập nhật trang thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/pages/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.pages.index')->with('success', 'Xóa trang thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }

    public function webShow($slug)
    {
        try {
            $page = $this->client->request('GET', "/pages/$slug/detail");
            $data = json_decode($page->getBody(), true);

            $resAnnouncements = $this->client->request('GET', '/announcements');

            $announcements = json_decode($resAnnouncements->getBody(), true);

            return view('web.pages.show', ['page' => $data, 'announcements' => $announcements]);
        } catch (\Exception $e) {
            abort(404, 'Không tìm thấy trang');
        }
    }
}
