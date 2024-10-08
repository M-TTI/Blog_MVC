<?php
require_once('Article.php');

class ArticleDAO
{
    private PDO $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=blog',
                'itiz_mtti', 'password');
        } catch(Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }

    public function getByID(int $id) : Article
    {
        $sql = "SELECT * FROM article WHERE id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
        $articleData = $req->fetch();

        return new Article(
            $articleData['id'],
            $articleData['title'],
            $articleData['publish_date'],
            $articleData['$content'],
            $articleData['image_path'],
            $articleData['id_user']);
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM article";
        $req = $this->db->prepare($sql);
        $req->execute();

        $articleArray = [];
        while ($articleData = $req->fetch())
        {
            $articleArray[] = new Article(
                $articleData['id'],
                $articleData['title'],
                $articleData['publish_date'],
                $articleData['content'],
                $articleData['image_path'],
                $articleData['id_user']);
        }
        return $articleArray;
    }

    public function create(Article $article) : void
    {
        $sql = "INSERT INTO article (title, publish_date, content, image_path, id_user) VALUES(
                            :title, 
                            NOW(), 
                            :content, 
                            :image_path, 
                            :id_user)";
        $req = $this->db->prepare($sql);
        $req->execute([
            'title' => $article->title,
            'content' => $article->content,
            'image_path' => $article->image_path,
            'id_user' => $article->id_user]);
    }

    public function update(int $id, Article $article) : void
    {
        $sql = "UPDATE article SET 
                   title = :title, 
                   publish_date = NOW(), 
                   content = :content, 
                   image_path = :image_path
               WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->execute(['id' => $id,
            'title' => $article->title,
            'content' => $article->content,
            'image_path' => $article->image_path]);
    }

    public function delete(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
    }
}