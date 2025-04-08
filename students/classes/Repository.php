<?php
include_once "connexionDB.php";
abstract class Repository 
{
    protected $db;
    public function __construct(protected $tableName)
    {
        $this->db = ConnexionDB::getInstance();
    }
    public function findAll()
    {
        $query = "SELECT * from {$this->tableName}";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function findById($id)
    {
        $query = "SELECT * from {$this->tableName} where id = :id";
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
        return $response->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $query = "delete * from {$this->tableName} where id = :id";
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
    }
    public function create($params)
    {
        $keys = array_keys($params);
        $keyString = implode(",", $keys);
        $paramselements = array_fill(0, count($keys), '?');
        $paramString = implode(",", $paramselements);
        $request = "INSERT INTO $this->tableName (`id`, $keyString) VALUES (NULL, $paramString);";
        $reponse = $this->db->prepare($request);
        $reponse->execute(array_values($params));
        return $reponse->fetch(PDO::FETCH_OBJ);
        
    }
}