<?php

namespace App\Http\Controllers\sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GeneralsQueries\CategoriesAccountsComposer;
use ServiceQueries\CategoriesAccountsService;
use App\Models\CategoriesAccounts;
use App\Models\Views\ViewCategoriesAccoutsOptions;
use App\Models\Views\ViewCategoriesAccountsGrid;

class CategoriesAccountsController extends Controller
{
    public $message = 'la categoria';
    public function service ($model = new CategoriesAccounts()) {
        $model = $model;
        $composer = new CategoriesAccountsComposer($model, 'View1', $this->message);
        $service = new CategoriesAccountsService($composer);
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
        $view = new ViewCategoriesAccountsGrid();
        $service = $this->service($view)->pagination_model([], $arreglo);
        return response()->json($service);
    }

    public function getOptions (Request $request) {
        $arreglo = $request->all();
        $view = new ViewCategoriesAccoutsOptions();
        $service = $this->service($view)
        ->pagination_model(['id as value', "label"], $arreglo);
        return response()->json($service);
    }
}
