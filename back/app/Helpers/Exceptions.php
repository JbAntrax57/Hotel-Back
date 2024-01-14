<?php
namespace App\Helpers;
use App\Helpers\HelperNotify;
class Exceptions {
    public $codeError = [
        "23000" => "Ya existe un registro con el mismo código o correo.",
        '23503' => 'Problemas al eliminar, hay datos que dependen de este registro',
        "22001" => 'El valor es demasiado largo.'
    ];

    public function codeErrors ($e) {
        $helper = new HelperNotify();
        if (isset($this->codeError[$e->getCode()])) {
            return $helper->getNotify('exception', $this->codeError[$e->getCode()]);
        } else {
            var_dump('Colocar este código nuevo: ' . $e->getCode());
        }
    }
}