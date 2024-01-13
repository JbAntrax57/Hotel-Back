<?php
namespace ServiceQueries;
class CategoriesAccountsService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

}