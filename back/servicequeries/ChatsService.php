<?php
namespace ServiceQueries;
class ChatsService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }
    public function create ($params) {
        return $this->composer->create($params);
    }
}