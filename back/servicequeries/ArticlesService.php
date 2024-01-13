<?php
namespace ServiceQueries;
class ArticlesService extends Service {
    private $composer;
    public function __construct($composer) {
        parent::__construct($composer);
        $this->composer = $composer;
    }

    public function createArticle ($params) {
        return $this->composer->createArticle($params);
    }

}