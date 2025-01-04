<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class DokuModels extends Model
{
    use HasFactory;

    // Fungsi untuk membuat signature
    public static function generateSignature($headers, $targetPath, $body, $secret)
    {
        $digest = base64_encode(hash('sha256', $body, true)); // Menghitung digest body
        $rawSignature = "Client-Id:" . $headers['Client-Id'] . "\n"
            . "Request-Id:" . $headers['Request-Id'] . "\n"
            . "Request-Timestamp:" . $headers['Request-Timestamp'] . "\n"
            . "Request-Target:" . $targetPath . "\n"
            . "Digest:" . $digest; // Gabungkan semua data menjadi rawSignature

        $signatureHmac = hash_hmac('sha256', $rawSignature, $secret, true); // HMAC menggunakan SHA-256
        return 'HMACSHA256=' . base64_encode($signatureHmac); // Hasilkan signature
    }

    // Fungsi untuk checkout pembayaran menggunakan curl
    public function checkoutWithCurl($orderData, $orderDetails)
    {
            $dokuUrl = env('DOKU_URL'); // Base URL API DOKU
            $callbackUrl = env('CALLBACK_URL'); // URL callback untuk notifikasi
            $clientId = env('CLIENT_ID'); // Client ID dari DOKU
            $secretKey = env('SECRETKEY'); // Secret key untuk signature

            $targetPath = "/checkout/v1/payment"; // Endpoint tujuan
            $requestId = Uuid::uuid4()->toString(); // Buat UUID unik
            $timestamp = Carbon::now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z'); // UTC timestamp

            // Header awal
            $headers = [
                "Client-Id" => $clientId,
                "Request-Id" => $requestId,
                "Request-Timestamp" => $timestamp,
                "Content-Type" => "application/json"
            ];

            // Body request
            $body = [
                "order" => [
                    "amount" => $orderData['harga'],
                    "invoice_number" => $orderData['inv'],
                    "currency" => "IDR",
                    "callback_url" => $callbackUrl,
                    "line_items" => $orderDetails
                ],
                "payment" => [
                    "payment_due_date" => env('EXPIREDTIME', 60)
                ],
            ];


            $bodyJson = json_encode($body);

            // Buat signature
            $signature = $this->generateSignature($headers, $targetPath, $bodyJson, $secretKey);

            // Header dengan signature
            $headersWithSignature = [
                "Client-Id: $clientId",
                "Request-Id: $requestId",
                "Request-Timestamp: $timestamp",
                "Signature: $signature",
                "Content-Type: application/json"
            ];

            // Kirim permintaan menggunakan cURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $dokuUrl . $targetPath,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headersWithSignature,
                CURLOPT_POSTFIELDS => $bodyJson,
                CURLOPT_CUSTOMREQUEST => 'POST'
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            curl_close($curl);

            // Jika terjadi kesalahan
            if ($error) {
                return [
                    'status' => 'ERROR',
                    'message' => $error
                ];
            }

            // Decode respons JSON
            $responseData = json_decode($response, true);

            // Ambil URL pembayaran jika tersedia
            $paymentUrl = $responseData['response']['payment']['url'] ?? null;

            // Kembalikan respons termasuk URL pembayaran
            return [
                'status_code' => $httpCode,
                'payment_url' => $paymentUrl,
                'response' => $responseData
            ];
        }

    }
