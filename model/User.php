<?php
class User
{
    private $id;
    private $pseudo;
    private $pass;
    private $mail;
    private $date_inscription;

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

        if (isset($data['pseudo']))
        {
            $this->setPseudo($data['pseudo']);
        }

        if (isset($data['pass']))
        {
            $this->setPass($data['pass']);
        }

        if (isset($data['mail']))
        {
            $this->setMail($data['mail']);
        }

        if (isset($data['date_inscription']))
        {
            $this->setDate_inscription($data['date_inscription']);
        }
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getDate_inscription()
    {
        return $this->date_inscription;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setDate_inscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }
}