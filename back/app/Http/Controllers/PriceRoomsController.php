<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceRoom;
use GeneralsQueries\PriceRoomsComposer;
use ServiceQueries\PriceRoomsService;
use App\Models\Views\ViewPriceRooms;

class PriceRoomsController extends Controller
{
    public $message = 'El Precio';

    public function service($priceRoom = new PriceRoom())
    {
        $composer = new PriceRoomsComposer($priceRoom, 'View1', $this->message);
        $service = new PriceRoomsService($composer);
        return $service;
    }

    public function create(Request $request)
    {
        $arreglo = $request->all();
        $service = $this->service(new PriceRoom())->create($arreglo);
        return response()->json($service);
    }

    public function update($id, Request $request)
    {
        $arreglo = $request->all();
        $service = $this->service(new PriceRoom())->update($id, $arreglo);
        return response()->json($service);
    }

    public function delete($id)
    {
        $service = $this->service(new PriceRoom())->delete($id);
        return response()->json($service);
    }

    public function getAll(Request $request)
    {
        $arreglo = $request->all();
        $view = new ViewPriceRooms();
        $service = $this->service($view)->pagination_model([], $arreglo);
        return response()->json($service);
    }
}
