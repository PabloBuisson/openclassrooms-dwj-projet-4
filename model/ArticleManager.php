<?php
class ArticleManager
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
        $query = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_creation, on_line FROM articles WHERE id = ?');
        $query->execute([
            $id
        ]);
        $article = $query->fetch();

        // var_dump($article);
        return new Article($article);
    }

    public function getAll()
	{
		// retourne la liste de tous les articles sous forme de tableau d'objets
		$articles = [];

		$query = $this->db->query("SELECT id, title, date_creation, on_line FROM articles ORDER BY date_creation DESC");

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($data);
		}

		return $articles;
	}

    public function getPosted()
	{
		// retourne la liste des articles publiés sous forme de tableau d'objets
		$articles = [];

		$query = $this->db->query("SELECT id, title, content, date_creation, on_line FROM articles WHERE on_line = 1 ORDER BY date_creation");

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($data);
		}

        return $articles;
	}

    public function add(Article $article) // oblige à recevoir un objet Article
    {
        $req = $this->db->prepare("INSERT INTO articles(title, content, date_creation, on_line) VALUES(?, ?, NOW(), ?)");
        $req->execute([
            $article->getTitle(),
            $article->getContent(),
            $article->getOn_line()
        ]);
    }

    public function update(Article $article)
    {
        $req = $this->db->prepare("UPDATE articles SET title = :title, content = :content, date_creation = NOW(), on_line = :on_line WHERE id = :id") or die(print_r($db->errorInfo()));
        $req->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent(),
            ':on_line' => $article->getOn_line(),
            ':id' => $article->getId()
        ]);
    }

    public function delete(Article $article)
    {
        $query = $this->db->prepare("DELETE FROM articles WHERE id = ?");
        $result = $query->execute([
            $article->getId()
        ]);
        
        return (bool) $result;
    }
}
