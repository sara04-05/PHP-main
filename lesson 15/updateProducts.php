<?php 

include_once('config.php');

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price']; 
    $id = $_POST['id']; 

    if(empty($title) || empty($description) || empty($quantity) || empty($price) || empty($id))
    {
        echo "You need to fill all the fields.";
        header( "refresh:2; url=products.php" ); 
    else
    {
        $sql= "UPDATE products SET title=:title, description=:description, quantity=:quantity, price=:price WHERE id=:id";

        $updateSql = $conn->prepare($sql);

        $updateSql->bindParam(':title', $title);
        $updateSql->bindParam(':description', $description);
        $updateSql->bindParam(':quantity', $quantity);
        $updateSql->bindParam(':price', $price);
        $updateSql->bindParam(':id', $id); 

        $updateSql->execute();

        header('Location: productsDashboard.php');
    }
    }
}
?>