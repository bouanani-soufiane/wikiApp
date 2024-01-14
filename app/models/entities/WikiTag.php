<?php
require_once __DIR__ . './Tag.php';
require_once __DIR__ . './Wiki.php';

class WikiTag
{
    private int $id;
    private Tag $tag;
    private Wiki $wiki;

    public function __construct(Tag $tag = null, Wiki $wiki = null)
    {
        $this->tag = $tag ?? new Tag();
        $this->wiki = $wiki ?? new Wiki();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }

    public function setTag(Tag $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function getWiki(): Wiki
    {
        return $this->wiki;
    }

    public function setWiki(Wiki $wiki): self
    {
        $this->wiki = $wiki;
        return $this;
    }
}