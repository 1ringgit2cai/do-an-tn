<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $client = new Client([
                'base_uri' => 'http://127.0.0.1:3001',
                'timeout'  => 10,
            ]);

            $res = $client->request('GET', '/pages', [
                'query' => [
                    'limit' => 1000 // số lượng đủ lớn để lấy tất cả
                ]
            ]);

            $data = json_decode($res->getBody(), true);
            $allPages = $data['data'] ?? [];

            // Share biến cho tất cả view
            View::share('all_pages', $allPages);
        } catch (\Exception $e) {
            View::share('all_pages', []); // fallback khi lỗi
        }
    }
}
