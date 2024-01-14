<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\TypesComposer;
use ServiceQueries\TypesService;
use App\Models\Types;

class TypesController extends Controller
{
    public $message = 'El Tipo';
    public function service () {
        $types = new Types();
        $composer = new TypesComposer($types, 'View1', $this->message);
        $service = new TypesService($composer);
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
        $service = $this->service()->pagination_model([], $arreglo);
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
