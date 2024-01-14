<?php
namespace GeneralsQueries;
use Illuminate\Support\Facades\DB;
use App\Helpers\Exceptions;
class TypesComposer extends ComposerQueries{
    private $model;
    private $view;
    public $message;
    public function __construct($model, $view, $message) {
        parent::__construct($model, $view, $message);
        $this->model = $model;
        $this->view = $view;
        $this->message = $message;
    }
}