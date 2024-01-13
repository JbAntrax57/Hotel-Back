<?php
namespace ServiceQueries;
class NameBrandService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

    public function createValidate ($params) {
        return $this->composer->createValidate($params);
    }

}