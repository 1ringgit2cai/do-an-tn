<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
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

    public function index(Request $request) {
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

            $resDocuments = $this->client->request('GET', '/documents', [
                'query' => [ 
                    'limit' => 8,
                ]
            ]);

            $resThesis = $this->client->request('GET', '/theses', [
                'query' => [ 
                    'limit' => 8,
                ]
            ]);

            $dataDocuments = json_decode($resDocuments->getBody(), true);

            $dataThesis = json_decode($resThesis->getBody(), true);

            $data = json_decode($res->getBody(), true);

            return view('web.home.index', [
                'announcements' => $data['data'],
                'documents' => $dataDocuments['data'],
                'thesis' => $dataThesis['data'],
                'total' => $data['total'],
                'page' => $data['page'],
                'totalPages' => $data['totalPages'],
            ]);
        } catch (\Exception $e) {
            return view('web.home.index')->withErrors(['message' => 'Không thể tải dữ liệu: ' . $e->getMessage()]);
        }
    }
}
