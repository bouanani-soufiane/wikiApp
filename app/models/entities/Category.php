<?php
class Category {
    private int $id;
    private string $name;
    private string $image;

    public function __construct(string $name = '', string $image = '') {
        $this->name = $name;
        $this->image = $image;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): self {
        $this->image = $image;
        return $this;
    }
}