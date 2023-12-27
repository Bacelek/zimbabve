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
    public function deleteProduct($id) {
        try {
            $sql = 'SELECT products.img_path FROM products WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt -> execute([':id' => $id]);
            $productAssoc = $stmt -> fetch(PDO::FETCH_ASSOC);
            $sql = 'DELETE FROM products WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt -> execute([':id' => $id]);
            return $productAssoc;
        } catch (PDOException $e){
            throw new Exception($e);
        }
    }
    public function getProductByID($id){
        $sql = 'SELECT * FROM products WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProduct($id,$name,$id_brand,$description,$cost,$image){
        try {
            if (!empty($image)){
                $sql = 'SELECT products.img_path FROM products WHERE id = :id';
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':id' => $id]);
                $lastImg_path = $stmt->fetch(PDO::FETCH_ASSOC);
                $sql = 'UPDATE products SET name = :name, id_brand = :id_brand,description = :description, cost = :cost, img_path = :img_path WHERE id = :id';
                $stmt = $this->db->prepare($sql);
                $params = [
                            ':id' => $id,
                            ':name'=>$name,
                            ':id_brand'=>$id_brand,
                            ':description'=>$description,
                            ':cost'=>$cost,
                            ':img_path'=>$image];
                $stmt->execute($params);
                return $lastImg_path;
            } else {
                $sql = 'UPDATE products SET name = :name, id_brand = :id_brand,description = :description, cost = :cost WHERE id=:id';
                $stmt = $this->db->prepare($sql);
                $params = [
                    ':id' => $id,
                    ':name'=>$name,
                    ':id_brand'=>$id_brand,
                    ':description'=>$description,
                    ':cost'=>$cost,];
                $stmt->execute($params);
            }
        } catch (PDOException $e){
            throw new Exception($e);
        }
    }
}