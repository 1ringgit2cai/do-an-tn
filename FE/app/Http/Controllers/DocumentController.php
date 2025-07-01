<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DocumentController extends Controller
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
            $res = $this->client->request('GET', '/documents', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('admin.documents.index', [
                'documents' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('admin.documents.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        $token = session('jwt_token');

        try {
            $response = $this->client->request('GET', '/courses', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'limit' => 1000, // để lấy tất cả khoá học, tuỳ theo API backend hỗ trợ
                    'page' => 1
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $courses = $data['data'] ?? [];

            return view('admin.documents.create', compact('courses'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Không thể tải danh sách môn học: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|integer',
            'uploaded_at' => 'nullable|date',
            'file_path' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'description', 'contents' => $request->input('description')],
                ['name' => 'course_id', 'contents' => $request->input('course_id')],
                ['name' => 'uploaded_at', 'contents' => $request->input('uploaded_at')],
                [
                    'name' => 'file_path', // ĐÚNG: tên field backend nhận file
                    'contents' => fopen($request->file('file_path')->getPathname(), 'r'),
                    'filename' => $request->file('file_path')->getClientOriginalName(),
                ],
            ];

            $this->client->request('POST', '/documents', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.documents.index')->with('success', 'Thêm tài liệu thành công!');
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $token = session('jwt_token');

        try {
            // Lấy thông tin tài liệu theo ID
            $resDoc = $this->client->request('GET', "/documents/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ]
            ]);
            $document = json_decode($resDoc->getBody(), true);

            // Lấy danh sách courses để đổ vào select box
            $resCourses = $this->client->request('GET', '/courses', [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'limit' => 1000,
                    'page' => 1,
                ]
            ]);
            $coursesData = json_decode($resCourses->getBody(), true);
            $courses = $coursesData['data'] ?? [];

            return view('admin.documents.edit', compact('document', 'courses'));
        } catch (\Exception $e) {
            return redirect()->route('admin.documents.index')->withErrors([
                'message' => 'Không lấy được dữ liệu: ' . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|integer',
            'uploaded_at' => 'nullable|date',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $token = session('jwt_token');

        try {
            $multipart = [
                ['name' => 'title', 'contents' => $request->input('title')],
                ['name' => 'description', 'contents' => $request->input('description')],
                ['name' => 'course_id', 'contents' => $request->input('course_id')],
                ['name' => 'uploaded_at', 'contents' => $request->input('uploaded_at')],
            ];

            if ($request->hasFile('file_path')) {
                $multipart[] = [
                    'name' => 'file_path',
                    'contents' => fopen($request->file('file_path')->getPathname(), 'r'),
                    'filename' => $request->file('file_path')->getClientOriginalName(),
                ];
            }

            $this->client->request('PUT', "/documents/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $multipart,
            ]);

            return redirect()->route('admin.documents.index')->with('success', 'Cập nhật tài liệu thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'API lỗi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $token = session('jwt_token');

        try {
            $this->client->request('DELETE', "/documents/{$id}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ]
            ]);

            return redirect()->route('admin.documents.index')->with('success', 'Xóa tài liệu thành công!');
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
            $res = $this->client->request('GET', '/documents', [
                'query' => [
                    'search' => $search,
                    'page' => $page,
                    'limit' => $limit,
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('web.documents.index', [
                'documents' => $data['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('web.documents.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }
}
