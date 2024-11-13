<?php

require "config.php";


$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            color: #1F2937;
            background-color: #F3F4F6;
        }

        h2 {
            color: #374151;
            font-size: 2rem;
            border-bottom: 4px solid #7C3AED;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        table {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #CBD5E0;
        }

        th {
            background-color: #E9D8FD;
            color: #4C1D95;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: 700;
        }

        td, th {
            padding: 0.75rem 1rem;
        }

        tr:nth-child(even) {
            background-color: #F3E8FF;
        }

        tr:hover {
            background-color: #F0FFF4;
        }

        .btn {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-create {
            background-color: #10B981;
            color: #ffffff;
        }

        .btn-create:hover {
            background-color: #059669;
        }

        .btn-edit {
            color: #2563EB;
        }

        .btn-edit:hover {
            color: #1D4ED8;
        }

        .btn-delete {
            color: #EF4444;
        }

        .btn-delete:hover {
            color: #DC2626;
        }
    </style>
</head>
<body class="p-6">
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Product List</h2>
        <a href="create.php" class="btn btn-create">Create Product</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="border px-4 py-2 text-left">ID</th>
                <th class="border px-4 py-2 text-left">Product Name</th>
                <th class="border px-4 py-2 text-left">Description</th>
                <th class="border px-4 py-2 text-left">Price</th>
                <th class="border px-4 py-2 text-left">Quantity</th>
                <th class="border px-4 py-2 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row): ?>
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['id']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['product_name']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['description']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['price']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['quantity']); ?></td>
                    <td class="border px-4 py-2 text-center">
                        <a href="edit.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn-delete ml-2" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
