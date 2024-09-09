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

    public function __get(string $attr): string
    {
        switch($attr)
        {
            case 'id':
                return $this->id;
            case 'title':
                return $this->title;
            case 'publish_date':
                return $this->publish_date;
            case 'content':
                return $this->content;
            case 'id_user':
                return $this->id_user;
            default:
                die('Error, no attribute named '.$attr);
        }
    }

    public function __set(string $attr, string $value): void
    {
        switch($attr)
        {
            case 'id':
                $this->id = $value;
                break;
            case 'title':
                $this->title = $value;
                break;
            case 'publish_date':
                $this->publish_date = $value;
                break;
            case 'content':
                $this->content = $value;
                break;
            case 'id_user':
                $this->id_user = $value;
                break;
            default:
                die('Error, no attribute named '.$attr);
        }
    }

    public function __toString(): string
    {
        return "Article id : ".$this->id."\ntitle : ".$this->title."\npublish date : ".$this->publish_date."\ncontent : ".$this->content."\n id_user : ".$this->id_user."\n";
    }


}