<?php
class UserManager extends Manager
{
    
    public function __construct()
    {
        // connexion à la BDD exécutée à l'instanciation
        $this->log();
    }

    public function get($pseudo)
    {
        // recherche le pseudo demandé et renvoie un objet User associé
        $query = $this->db->prepare('SELECT id, pseudo, pass FROM users WHERE pseudo = ?');
        $query->execute([
            $pseudo
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) // si la recherche de pseudo n'a rien donné
        {
            return false;
        }
        else
        {
            return new User($data);
        }
    }

    public function exists($pseudo)
    {
        // on passe en lowercase le pseudo rentré et la recherche de pseudo correspondant pour éviter les doublons
        $query = $this->db->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = ?');
        $query->execute([
            strtolower($pseudo)
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function add(User $user)
    {
        $query = $this->db->prepare('INSERT INTO users(pseudo, pass, mail, date_inscription) VALUES(:pseudo, :pass, :mail, CURDATE())');
        $query->execute([
            'pseudo' => $user->getPseudo(),
            'pass' => $user->getPass(),
            'mail' => $user->getMail()
        ]);
    }
}