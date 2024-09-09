<?php

class Article
{
    private int $id;
    private string $title;
    private string $publish_date;
    private string $content;
    private int $id_user;

    public function __construct(int $id = 0, string $title = "default_title", string $publish_date = "2000-00-00", string $content = "default content", int $id_user = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->publish_date = $publish_date;
        $this->content = $content;
        $this->id_user = $id_user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPublishDate(): string
    {
        return $this->publish_date;
    }

    public function setPublishDate(string $publish_date): void
    {
        $this->publish_date = $publish_date;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function __toString(): string
    {
        return "Article id : ".$this->id."\ntitle : ".$this->title."\npublish date : ".$this->publish_date."\ncontent : ".$this->content."\n id_user : ".$this->id_user."\n";
    }


}