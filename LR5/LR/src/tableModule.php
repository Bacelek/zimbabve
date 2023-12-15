<?php
class tableModule{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllProducts()
    {
        try {
            $sql = "SELECT products.name as name,
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
}