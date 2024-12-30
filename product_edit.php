<?php
include 'connect.php';

$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
?>

<form action="product_actions.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="existing_image" value="<?php echo $product['image']; ?>">
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
    <input type="number" name="price" value="<?php echo $product['price']; ?>" required step="0.01">
    <input type="file" name="image" accept="image/*">
    <button type="submit">Update Product</button>
</form>

<?php mysqli_close($conn); ?>