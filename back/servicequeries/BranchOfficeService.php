<?php
namespace ServiceQueries;
class BranchOfficeService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

}