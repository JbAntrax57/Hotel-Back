<?php
namespace ServiceQueries;
class UserService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }
    public function add_account ($params) {
        return $this->composer->add_account($params);
    }
}