<?php
namespace ServiceQueries;
class PriceRoomsService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

}