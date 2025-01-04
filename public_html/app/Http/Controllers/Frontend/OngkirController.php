<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function index(Request $request)
    {
        $data = null;
        if ($request->ajax()) {
            $response = Http::withHeaders([
                // 'content-type' => 'application/x-www-form-urlencoded',
                'key' => '5b9a5d48f7d8489a7d400ed03a7b73d1'
            ])->get('https://api.rajaongkir.com/starter/city');

            $stations = $response->json();
            // dd($stations['rajaongkir']['results']);

            // Filter stasiun berdasarkan teks yang dicari oleh pengguna
            $filteredStations = [];
            foreach ($stations['rajaongkir']['results'] as $station) {
                if (stripos($station['city_name'], $request->q) !== false) {
                    $filteredStations[] = [
                        'id' => $station['city_id'],
                        'text' => $station['type'] . ' , ' . $station['city_name'] . ' , ' . $station['province'],
                    ];
                }
            }

            return $filteredStations;
        }

        return view('home.ongkir.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|numeric'
        ], [
            'provinsi' => 'Pilih Kota Pengiriman',
        ]);

        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => '5b9a5d48f7d8489a7d400ed03a7b73d1'
        ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => 249,
            'destination' => $request->provinsi,
            'weight' => 1,
            'courier' => 'jne',
        ])->json();

        $data = [];

        // dd($response['rajaongkir']);
        foreach ($response['rajaongkir']['results'][0]['costs'] as $key => $value) {
            # code...
            $data[] = [
                'tujuan' => $response['rajaongkir']['destination_details']['type'] . ' ,' . $response['rajaongkir']['destination_details']['city_name'] . ' ,' . $response['rajaongkir']['destination_details']['province'],
                'title' => 'JNE - ' . $value['service'],
                'harga' => 'Rp. ' . number_format($value['cost'][0]['value']),
                'estimasi' => $value['cost'][0]['etd'] . ' Hari',
            ];
        }


        // dd($data);
        return view('home.ongkir.index', compact('data'));
    }
}
