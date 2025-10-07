<?php 

// Include the database connection file
include_once('config.php');

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price']; // Fixed missing semicolon
    $id = $_POST['id']; // Get product id from form

    if(empty($title) || empty($description) || empty($quantity) || empty($price) || empty($id))
    {
        echo "You need to fill all the fields.";
        header( "refresh:2; url=products.php" ); // Redirect to products.php for consistency
    }
    else
    {
        $sql= "UPDATE products SET title=:title, description=:description, quantity=:quantity, price=:price WHERE id=:id";

        $updateSql = $conn->prepare($sql);

        $updateSql->bindParam(':title', $title);
        $updateSql->bindParam(':description', $description);
        $updateSql->bindParam(':quantity', $quantity);
        $updateSql->bindParam(':price', $price);
        $updateSql->bindParam(':id', $id); // Bind the id parameter

        $updateSql->execute();

        header('Location: products.php');
    }
}
?>