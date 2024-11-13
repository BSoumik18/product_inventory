<?php

require "config.php";


$error = "";
$success = "";


if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $product_id = intval($_GET['id']);

    try {
        
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bindParam(1, $product_id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            
            $success = "Product deleted successfully.";
        } else {
            
            $error = "Failed to delete the product. Please try again.";
        }
    } catch (PDOException $e) {
    
        $error = "Error: " . $e->getMessage();  
    }
} else {
    
    $error = "Product ID is missing or invalid.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- Tailwind CSS CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 max-w-lg mx-auto p-6">
<!-- Main container for displaying messages -->
<div class="max-w-lg w-full">
    <!-- Success Message Display -->
    <?php if (!empty($success)): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline"><?= $success; ?></span>
            <!-- Close button for the success message -->
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <span class="text-green-700">×</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Error Message Display -->
    <?php if (!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline"><?= $error; ?></span>
            <!-- Close button for the error message -->
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <span class="text-red-700">×</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Back to Products Button -->
    <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
        Back to Products List
    </a>
</div>
</body>
</html>