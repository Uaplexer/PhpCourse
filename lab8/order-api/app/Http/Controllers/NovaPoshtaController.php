<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Enums\DeliveryType;

class NovaPoshtaController extends Controller

{
    public static $hash_map_wh_refs = ['post_office' => '841339c7-591a-42e2-8233-7a0a00f0ed6f',
        'parcel_machine' => 'f9316480-5f2d-425d-bc2c-ac7cd29decf0'];

    /**
     * @throws ConnectionException
     */
    public function getCities(Request $request): \Illuminate\Http\JsonResponse
    {
        $cityName = $request->input('city_name', '');

        $response = Http::withoutVerifying()
            ->post('https://api.novaposhta.ua/v2.0/json/', [
                'apiKey' => config('services.novaposhta.api_key'),
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
                'methodProperties' => [
                    'FindByString' => $cityName,
                    'Page' => '1',
                    'Limit' => '10'
                ]
            ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch cities from Nova Poshta'], 500);
        }
    }

    /**
     * @throws ConnectionException
     */
    public function getPostOffices(Request $request)
    {
        $cityName = $request->input('city_name');
        $deliveryType = $request->input('delivery_type');
        $warehouseName = $request->input('warehouse_name');

        $hash_map_wh_refs = self::$hash_map_wh_refs;

        if (isset($hash_map_wh_refs[$deliveryType])) {
            $typeOfWarehouseRef = $hash_map_wh_refs[$deliveryType];
        } else {
            return response()->json(['error' => 'Invalid delivery type'], 400);
        }


        $response = Http::withoutVerifying()
            ->post('https://api.novaposhta.ua/v2.0/json/', [
                'apiKey' => config('services.novaposhta.api_key'),
                'modelName' => 'AddressGeneral',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => [
                    'FindByString' => $warehouseName,
                    'CityName' => $cityName,
                    'TypeOfWarehouseRef' => $typeOfWarehouseRef,
                    'Page' => '1',
                    'Limit' => '10'
                ]
            ]);

        return $response->json();
    }
}
