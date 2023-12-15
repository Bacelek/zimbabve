<?php
class tableModule{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    public function getAllProducts()
    {
        try {
            $sql = "SELECT products.id as idp,
        products.name as name,
        brands.name as brand,
        products.img_path,
        products.description,
        products.cost FROM products
        INNER JOIN brands ON products.id_brand = brands.id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function addProduct($name,$id_brand,$description,$cost,$image)
    {
        try {
            $sql = 'INSERT INTO products (name,id_brand,description,cost,img_path) VALUES (:name,:id_brand,:description,:cost,:img_path)';
            $stmt = $this->db->prepare($sql);
            $params = [
                ':name'=> $name,
                ':id_brand' => $id_brand,
                ':description' => $description,
                ':cost' => $cost,
                ':img_path' => $image
                ];
            $stmt -> execute($params);
            return null;
        } catch (PDOException $e){
            echo $e->getMessage();
            return $e;
        }




    }
}