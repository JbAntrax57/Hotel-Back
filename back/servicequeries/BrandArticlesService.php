<?php
namespace ServiceQueries;
class BrandArticlesService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

    public function getOptions ($data) {
        return $this->composer->getOptions($data);
    }

}