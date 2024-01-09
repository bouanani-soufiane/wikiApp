<?php
require_once __DIR__.'./Tag.php';
require_once __DIR__.'./User.php';
require_once __DIR__.'./Category.php';


class Wiki
{
    private $id;
    private $titre;
    private $description;
    private $content;
    private $image;
    private $isArchived;
    private $createdAt;
    private Tag $tag;
    private Category $category;
    private User $user;
    public function __construct()
    {
        $this->tag = new Tag();
        $this->category = new Category();
        $this->user = new User();
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
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    public function getIsArchived()
    {
        return $this->isArchived;
    }
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
        return $this;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getTag(): Tag
    {
        return $this->tag;
    }
    public function setTag(Tag $tag): Wiki
    {
        $this->tag = $tag;
        return $this;
    }
    public function getCategory(): Category
    {
        return $this->category;
    }
    public function setCategory(Category $category): Wiki
    {
        $this->category = $category;
        return $this;
    }
    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): Wiki
    {
        $this->user = $user;
        return $this;
    }

}