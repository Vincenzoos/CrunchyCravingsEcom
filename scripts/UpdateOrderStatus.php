<?php
declare(strict_types=1);

try {
    // Define database configuration based on the provided information
    $dsn = 'mysql:host=localhost;dbname=cake_landing_page;charset=utf8mb4';
    $username = 'cake_landing_page';
    $password = 'YES';

    // Connect to the database
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    echo "Database connection successful.\n";

    // Reset orders back to 'pending' if shipped_date is null
    $queryResetPending = "
        UPDATE orders
        SET status = 'pending', shipped_date = NULL
        WHERE status = 'shipped'
        AND shipped_date IS NULL
    ";
    $pdo->exec($queryResetPending);

    // Update orders from 'pending' to 'shipped' if 2 days have passed
    $queryShipped = "
        UPDATE orders
        SET status = 'shipped', shipped_date = NOW()
        WHERE status = 'pending'
        AND TIMESTAMPDIFF(DAY, created, NOW()) >= 2
    ";
    $pdo->exec($queryShipped);

    // Update orders from 'shipped' to 'completed' if 14 days have passed since creation
    $queryCompleted = "
        UPDATE orders
        SET status = 'completed'
        WHERE status = 'shipped'
        AND TIMESTAMPDIFF(DAY, created, NOW()) >= 14
    ";
    $pdo->exec($queryCompleted);


    echo "Order statuses updated successfully.\n";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
}