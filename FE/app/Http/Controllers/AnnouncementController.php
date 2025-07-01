<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AnnouncementController extends Controller
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
            $res = $this->client->request('GET', '/announcements', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.announcements.index', [
                'announcements' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.announcements.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'posted_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'content', 'contents' => $request->input('content')],
                ['name' => 'posted_at', 'contents' => $request->input('posted_at')],
            ];

            if ($request->hasFile('cover_image')) {
                $multipart[] = [
                    'name' => 'cover_image',
                    'contents' => fopen($request->file('cover_image')->getPathname(), 'r'),
                    'filename' => $request->file('cover_image')->getClientOriginalName(),
                ];
            }

            $this->client->request('POST', '/announcements', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.announcements.index')->with('success', 'Thêm thông báo thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/announcements/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            $announcement = json_decode($res->getBody(), true);

            return view('admin.announcements.edit', compact('announcement'));
        } catch (\Exception $e) {
            return redirect()->route('admin.announcements.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'posted_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'content', 'contents' => $request->input('content')],
                ['name' => 'posted_at', 'contents' => $request->input('posted_at')],
            ];

            if ($request->hasFile('cover_image')) {
                $multipart[] = [
                    'name' => 'cover_image',
                    'contents' => fopen($request->file('cover_image')->getPathname(), 'r'),
                    'filename' => $request->file('cover_image')->getClientOriginalName(),
                ];
            }

            $this->client->request('PUT', "/announcements/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.announcements.index')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/announcements/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.announcements.index')->with('success', 'Xóa thông báo thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }

    public function webIndex(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $limit = 9;

        try {
            $res = $this->client->request('GET', '/announcements', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('web.announcements.index', [
                'announcements' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('web.announcements.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function webShow($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/announcements/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            $announcement = json_decode($res->getBody(), true);

            $resAnnouncements = $this->client->request('GET', '/announcements');

            $announcements = json_decode($resAnnouncements->getBody(), true);

            return view('web.announcements.show', compact('announcement', 'announcements'));
        } catch (\Exception $e) {
            return redirect()->route('web.announcements.show')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }
}
