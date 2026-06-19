<?php
try {
    include 'includes/DatabaseConnection.php';

    $sql = 'SELECT joke.id,joketext,author.name, email,img_path, category.name as joke_type FROM joke INNER JOIN author ON `author_id` = author.id INNER JOIN category ON `category_id` = category.id ORDER BY joke.id ASC';
    $jokes = $pdo->query($sql);
    $title = 'Joke list';

    ob_start();
    include 'templates/jokes.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';