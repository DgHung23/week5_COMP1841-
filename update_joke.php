<?php
try {
    include 'includes/DatabaseConnection.php';

    if (isset($_POST['joketext']) and isset($_POST['jokedate']) ) {
        $sql = 'UPDATE joke SET
            joketext = :joketext,
            jokedate = :jokedate
            WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':jokedate', $_POST['jokedate']);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header('location: jokes.php');
        exit;
    } else {
        $sql = 'SELECT id, joketext, jokedate FROM joke WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        $joke = $stmt->fetch();

        $title = 'Update joke';
        ob_start();
        include 'templates/update_joke.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
