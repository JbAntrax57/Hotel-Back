<?php

namespace App\Http\Controllers\sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use GeneralsQueries\RolesComposer;
use ServiceQueries\RolesService;

class RolesController extends Controller
{
    public $message = 'el rol';
    public function service () {
        $user = new Roles();
        $composer = new RolesComposer($user, 'View1', $this->message);
        $service = new RolesService($composer);
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
        $service = $this->service()->pagination_model($arreglo);
        return response()->json($service);
    }
}
