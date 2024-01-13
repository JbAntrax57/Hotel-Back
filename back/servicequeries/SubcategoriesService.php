<?php
namespace ServiceQueries;
class SubcategoriesService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

}