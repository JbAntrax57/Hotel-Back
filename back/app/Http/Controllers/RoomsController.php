<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\RoomsComposer;
use ServiceQueries\RoomsService;
use App\Models\Rooms;
use App\Models\Views\ViewRoomsAndTypes;

class RoomsController extends Controller
{
    public $message = 'La habitación';
    public function service ($rooms = new Rooms()) {
        //$types = new Rooms();
        $composer = new RoomsComposer($rooms, 'View1', $this->message);
        $service = new RoomsService($composer);
        return $service;
    }

    public function create (Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->create($arreglo);
        return response()->json($service);
    }

    public function update ($id, Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->update($id, $arreglo);
        return response()->json($service);
    }

    public function delete ($id) {
        $service = $this->service()->delete($id);
        return response()->json($service);
    }

    public function getAll (Request $request) {
        $arreglo = $request->all();
        $view = new ViewRoomsAndTypes();
        $service = $this->service($view)->pagination_model([], $arreglo);
        return response()->json($service);
    }

    public function getOptions (Request $request) {
        $arreglo = $request->all();
       //$view = new ViewCategoriesAccoutsOptions();
        $service = $this->service()
        ->pagination_model(['id as value', 'name as label'], []);
        return response()->json($service);
    }
}
