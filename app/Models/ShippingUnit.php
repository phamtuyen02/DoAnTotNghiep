
<?php

// Thông tin API của Giao Hàng Nhanh
$apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create';
$apiKey = 'eecd35b7-08f8-11ef-bfe9-c2d25c6518ab';

// Thông tin đơn hàng
$orderData = array(
    'payment_type_id' => 2, // Loại thanh toán, 1 là thanh toán sau, 2 là thanh toán trước
    'note' => 'Giao hàng nhanh',
    // Thêm thông tin về đơn hàng, ví dụ: thông tin sản phẩm, địa chỉ giao hàng, v.v.
);

// Chuyển đổi dữ liệu thành định dạng JSON
$orderJson = json_encode($orderData);

// Tạo header cho yêu cầu HTTP POST
$headers = array(
    'Content-Type: application/json',
    'Token: ' . $apiKey
);

// Khởi tạo cURL session
$ch = curl_init();

// Cấu hình cURL session
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $orderJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Thực hiện yêu cầu HTTP POST và nhận phản hồi từ API của GHN
$response = curl_exec($ch);

// Đóng cURL session
curl_close($ch);

// Xử lý phản hồi từ API của GHN
if ($response) {
    $responseData = json_decode($response, true);
    // Xử lý dữ liệu trả về từ API ở đây
    print_r($responseData);
} else {
    echo "Không thể kết nối đến API của GHN";
}
?>
