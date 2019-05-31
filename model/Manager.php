<?php 
class Manager 
{
    protected $db;

    public function log()
    {
        // exécuté à l'instanciation des models
        
        require('log.php');
        
        try
        {
            $this->db = $logDetails;
        } 
        catch (Exception $e) 
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
}