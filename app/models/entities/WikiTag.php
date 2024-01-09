<?php
require_once __DIR__.'./Tag.php';
require_once __DIR__.'./Wiki.php';



class WikiTag
{
    private $id;

    private Tag $tag;
    private Wiki $wiki;

    public function __construct()
    {
        $this->tag = new Tag();
        $this->wiki = new Wiki();

    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
        return $this;
    }
    public function getWiki()
    {
        return $this->wiki;
    }
    public function setWiki(Wiki $wiki)
    {
        $this->wiki = $wiki;
        return $this;
    }


}