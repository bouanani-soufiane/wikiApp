<?php
require_once __DIR__ . './Tag.php';
require_once __DIR__ . './User.php';
require_once __DIR__ . './Category.php';

class Wiki
{
    private int $id;
    private string $titre;
    private string $description;
    private string $content;
    private string $image;
    private bool $isArchived;
    private string $createdAt;
    private Category $category;
    private User $user;

    public function __construct(
        string   $titre = '',
        string   $description = '',
        string   $content = '',
        string   $image = '',
        bool     $isArchived = false,
        string   $createdAt = '',
        Category $category = null,
        User     $user = null
    )
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->content = $content;
        $this->image = $image;
        $this->isArchived = $isArchived;
        $this->createdAt = $createdAt;
        $this->category = $category ?? new Category();
        $this->user = $user ?? new User();
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

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}