<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class CourseLecturerController extends Controller
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

    public function index($id)
    {
        try {

            $res = $this->client->request('GET', "/courses/$id/lecturer");

            $resCourse = $this->client->request('GET', "/courses/$id");

            $courseData = json_decode($resCourse->getBody(), true);
            
            $data = json_decode($res->getBody(), true);

            return view('admin.courses.lecturers.index', [
                'lecturers' => $data['data'],
                'course' => $courseData,
                'courseId' => $id
            ]);
        } catch (\Exception $e) {
            return view('admin.courses.lecturers.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }

    public function create($id)
    {
        try {
            $resLecturers = $this->client->request('GET', '/lecturers', [
                'query' => [
                    'limit' => 10000,
                ]
            ]);

            $dataLecturers = json_decode($resLecturers->getBody(), true);

            $resCourse = $this->client->request('GET', "/courses/$id");

            $courseData = json_decode($resCourse->getBody(), true);

            return view('admin.courses.lecturers.create', [
                'courseId' => $id,
                'course' => $courseData,
                'lecturers' => $dataLecturers['data']
            ]);
        } catch (\Exception $e) {
            return view('admin.courses.lecturers.create')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }

    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'lecturer_id' => 'required|integer',
        ], [
            'lecturer_id.required' => 'Vui lòng chọn giảng viên.',
            'lecturer_id.integer' => 'Giảng viên không hợp lệ.',
        ]);

        try {
            $token = session('jwt_token');

            $multipart = [
                ['name' => 'lecturer_id', 'contents' => $request->input('lecturer_id')],
            ];

            $this->client->request('POST', "/courses/$id/lecturer", [
                'headers' => [
                    'Authorization' => "Bearer $token"
                ],
                'multipart' => $multipart
            ]);

            return redirect()->route('admin.courses.lecturers.index', $id)->with('success', 'Thêm giảng viên thành công.');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = json_decode($e->getResponse()->getBody(), true);
            return redirect()->route('admin.courses.lecturers.index', $id)->withErrors(['message' => $response['message'] ?? 'Có lỗi xảy ra']);
        }
    }

    public function destroy($id, $lecturer_id)
    {
        try {
            $token = session('jwt_token');

            $this->client->request('DELETE', "/courses/$id/lecturer/?lecturer_id=$lecturer_id", [
                'headers' => [
                    'Authorization' => "Bearer $token"
                ]
            ]);

            return redirect()->route('admin.courses.lecturers.index', $id)->with('success', 'Xóa giảng viên thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.courses.lecturers.index', $id)->withErrors(['message' => 'Không thể xóa giảng viên: ' . $e->getMessage()]);
        }
    }
}
