<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ThesisController extends Controller
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
            $res = $this->client->request('GET', '/theses', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.theses.index', [
                'theses' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.theses.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.theses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'file_path' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'abstract', 'contents' => $request->input('abstract')],
                ['name' => 'author_name', 'contents' => $request->input('author_name')],
                ['name' => 'year', 'contents' => $request->input('year')],
                [
                    'name' => 'file_path',
                    'contents' => fopen($request->file('file_path')->getPathname(), 'r'),
                    'filename' => $request->file('file_path')->getClientOriginalName(),
                ],
            ];

            $this->client->request('POST', '/theses', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.theses.index')->with('success', 'Thêm khóa luận thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            $res = $this->client->request('GET', "/theses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ]
            ]);

            $thesis = json_decode($res->getBody(), true);

            return view('admin.theses.edit', compact('thesis'));
        } catch (\Exception $e) {
            return redirect()->route('admin.theses.index')->withErrors(['message' => 'Không lấy được dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'abstract', 'contents' => $request->input('abstract')],
                ['name' => 'author_name', 'contents' => $request->input('author_name')],
                ['name' => 'year', 'contents' => $request->input('year')],
            ];

            if ($request->hasFile('file_path')) {
                $multipart[] = [
                    'name' => 'file_path',
                    'contents' => fopen($request->file('file_path')->getPathname(), 'r'),
                    'filename' => $request->file('file_path')->getClientOriginalName(),
                ];
            }

            $this->client->request('PUT', "/theses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.theses.index')->with('success', 'Cập nhật khóa luận thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/theses/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.theses.index')->with('success', 'Xóa khóa luận thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không xóa được: ' . $e->getMessage()]);
        }
    }

    public function webIndex(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $limit = 12;

        try {
            $res = $this->client->request('GET', '/theses', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('web.theses.index', [
                'theses' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('web.theses.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }
}
