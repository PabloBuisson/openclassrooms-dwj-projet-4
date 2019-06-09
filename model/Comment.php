<?php
class Comment
{
    private $id;
    private $id_article;
    private $pseudo;
    private $comment;
    private $date_comment;
    private $report;
    private $title; // titre de l'article associé

    public function __construct(Array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }

        if (isset($data['id_article']))
        {
            $this->setId_article($data['id_article']);
        }

        if (isset($data['pseudo']))
        {
            $this->setPseudo($data['pseudo']);
        }

        if (isset($data['comment']))
        {
            $this->setComment($data['comment']);
        }

        if (isset($data['date_comment']))
        {
            $this->setDate_comment($data['date_comment']);
        }

        if (isset($data['report']))
        {
            $this->setReport($data['report']);
        }

        if (isset($data['title']))
        {
            $this->setTitle($data['title']);
        }
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getId_article()
    {
        return $this->id_article;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDate_comment()
    {
        return $this->date_comment;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function getTitle()
    {
        return $this->title;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setId_article($id_article)
    {
        $this->id_article = $id_article;

        return $this;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = htmlspecialchars($pseudo);

        return $this;
    }

    public function setComment($comment)
    {
        $this->comment = htmlspecialchars_decode($comment);

        return $this;
    }

    public function setDate_comment($date_comment)
    {
        $this->date_comment = $date_comment;

        return $this;
    }

    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);

        return $this;
    }
}