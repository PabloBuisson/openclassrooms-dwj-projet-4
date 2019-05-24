<?php
class CommentManager
{
    private $db;

    public function __construct()
    {
        // exécuté à l'instanciation
        try 
        { 
            $this->db = new PDO('mysql:host=localhost;dbname=blog_forteroche;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // affiche des erreurs plus précises)
        } 
        catch (Exception $e) 
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function get($id)
    {

    }

    public function getReported()
    {
        $report = false;
        $query = $this->db->query("SELECT * FROM comments WHERE report = 1");
        $queryReport = $query->fetch();
        if ($queryReport)
        {
            $report = true;
        }

        return $report;
    }

    public function getAll()
    {
        // retourne la liste de tous les commmentaires, et l'article relié
        $comments = [];

        $query = $this->db->query('SELECT comments.id, id_article, pseudo, comment, date_comment, report, articles.title
        FROM comments
        INNER JOIN articles ON comments.id_article = articles.id
        ORDER BY report DESC, date_comment DESC');

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }

        // var_dump($comments);
        return $comments;
    }

    public function getPosted($id_article)
    {
        // retourne la liste des commentaires publiés sous forme de tableau d'objets
        $comments = [];

        $query = $this->db->prepare('SELECT id, id_article, pseudo, comment, date_comment, report FROM comments WHERE id_article = ? ORDER BY report, date_comment DESC');
        $query->execute([
            $id_article
        ]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }

        // var_dump($comments);
        return $comments;
    }

    public function add(Comment $comment)
    {
        $query = $this->db->prepare("INSERT INTO comments(id_article, pseudo, comment, date_comment, report) VALUES(:id_article, :pseudo, :comment, NOW(), 0)");
        $query->execute([
            'id_article' => $comment->getId_article(),
            'pseudo' => $comment->getPseudo(),
            'comment' => $comment->getComment()
        ]);
    }

    public function accept(Comment $comment)
    {
        $query = $this->db->prepare("UPDATE comments SET report = 0 WHERE id = ?");
        $query->execute([
            $comment->getId()
        ]);
    }

    public function report(Comment $comment)
    {
        $query = $this->db->prepare("UPDATE comments SET report = 1 WHERE id = ?");
        $query->execute([
            $comment->getId()
        ]);
    }

    public function delete(Comment $comment)
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $query->execute([
            $comment->getId()
        ]);
    }
}