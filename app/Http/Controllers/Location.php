<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Location extends Controller
{
    public function fetchProvinceData()
    {
        $url = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';
        
        // Mã thông báo (token) của bạn
        $token = 'eecd35b7-08f8-11ef-bfe9-c2d25c6518ab';
        
        $client = new GuzzleHttpClient();

        // Cấu hình tiêu đề với mã thông báo
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ];
        
        try {
            // Gửi yêu cầu GET đến URL với tiêu đề
            $response = $client->get($url, [
                'headers' => $headers,
            ]);

            // Nhận phản hồi và giải mã JSON
            $data = json_decode($response->getBody(), true);

            // Xử lý dữ liệu nhận được
            return $data;
            
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json([
                'error' => 'Có lỗi xảy ra trong quá trình gửi yêu cầu',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
