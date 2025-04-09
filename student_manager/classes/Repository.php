<?php
include_once '../config/database.php';

abstract class Repository 
{
    protected $db;
    public function __construct(protected $tableName)
    {
        $this->db = Database::getInstance();
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
        $query = "delete from {$this->tableName} where id = :id";
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
    }
    public function create($params){
        $keys = array_keys($params);
        $keyString = implode(",", $keys);
        $paramselements = array_fill(0, count($keys), '?');
        $paramString = implode(",", $paramselements);
        $request = "INSERT INTO $this->tableName (`id`, $keyString) VALUES (NULL, $paramString);";
        $reponse = $this->db->prepare($request);
        $reponse->execute(array_values($params));
        return $reponse->rowCount() > 0;
        
    }

    public function update($id, $data) {
        $setClause = array_map(fn($key) => "$key = :$key", array_keys($data));
        $sql = "UPDATE $this->tableName SET " . implode(', ', $setClause) . " WHERE id = :id";
        $data['id'] = $id; 
        $response = $this->db->prepare($sql);
        return $response->execute($data);
    }
}
?>