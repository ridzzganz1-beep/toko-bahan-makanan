<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=toko_bahan_makanan', 'root', '');
    $result = $pdo->query('SELECT email, role FROM users ORDER BY id');
    
    echo "=== Users in Database ===\n";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['email']} ({$row['role']})\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
