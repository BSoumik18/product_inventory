<?php

require "config.php";


$error = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    
    if (!empty($product_name) && !empty($description) && !empty($price) && !empty($quantity)) {
        
        $stmt = $pdo->prepare("INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $product_name);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $quantity);

        
        if ($stmt->execute()) {
            
            $success = "Your product was added successfully.";
        } else {
            
            $error = "Failed to insert data. Please try again.";
        }
    } else {
    
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #F8FAFC;
            color: #2D3748;
        }

        .container {
            max-width: 100%;
        }

        .alert-success, .alert-error {
            position: relative;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #D1FAE5;
            border-left: 6px solid #10B981;
            color: #065F46;
        }

        .alert-error {
            background-color: #FED7D7;
            border-left: 6px solid #E53E3E;
            color: #822727;
        }

        .alert button {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: inherit;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
            line-height: 1;
        }

        .form-container {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #4A5568;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #CBD5E0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #4299E1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.4);
        }

        .btn-submit {
            background-color: #4299E1;
            color: #FFFFFF;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #3182CE;
        }

        .btn-back {
            background-color: #EDF2F7;
            color: #2D3748;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .btn-back:hover {
            background-color: #E2E8F0;
        }
    </style>
</head>
<body class="p-6">
<div class="container mx-auto">
    <!-- Display success message if available -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> <?= $success; ?>
            <button type="button" onclick="this.parentElement.style.display='none'">×</button>
        </div>
    <?php endif; ?>

    <!-- Display error message if available -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-error" role="alert">
            <strong>Error!</strong> <?= $error; ?>
            <button type="button" onclick="this.parentElement.style.display='none'">×</button>
        </div>
    <?php endif; ?>

    <!-- Page header with the title and link to show all products -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Add Product</h2>
        <a href="index.php" class="btn-back">Show Products</a>
    </div>

    
    <div class="form-container">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Product Name Input -->
            <div class="mb-4">
                <label for="product_name" class="form-label">Product Name <span class="text-red-500">*</span></label>
                <input type="text" id="product_name" name="product_name" class="form-input">
            </div>
            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="form-label">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" class="form-textarea"></textarea>
            </div>
            <!-- Price Input -->
            <div class="mb-4">
                <label for="price" class="form-label">Price <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="price" name="price" class="form-input">
            </div>
            <!-- Quantity Input -->
            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity <span class="text-red-500">*</span></label>
                <input type="number" id="quantity" name="quantity" class="form-input">
            </div>
            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn-submit">Add Product</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
