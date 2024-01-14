<?php

namespace App\Http\Controllers\sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\UserComposer;
use ServiceQueries\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $message = 'el usuario';
    public function service () {
        $user = new User();
        $composer = new UserComposer($user, 'View1', $this->message);
        $service = new UserService($composer);
        return $service;
    }

    public function create (Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->create($arreglo);
        return response()->json($service);
    }

    public function update ($id, Request $request) {
        $arreglo = $request->all();
        if (isset($arreglo['password'])) {
            $arreglo['password'] = Hash::make($arreglo['password']);
        }
        $service = $this->service()->update($id, $arreglo);
        return response()->json($service);
    }

    public function delete ($id) {
        $service = $this->service()->delete($id);
        return response()->json($service);
    }

    public function getAll (Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->pagination_model([],$arreglo);
        return response()->json($service);
    }
}
