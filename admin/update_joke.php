<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataBaseFunctions.php';

    if (isset($_POST['joketext']) and isset($_POST['jokedate']) ) {
        updateJoke($pdo, $_POST['id'], $_POST['joketext'], $_POST['jokedate']);

        header('location: jokes.php');
        exit;
    } else {
        $joke = getJokes($pdo, $_POST['id']);

        $title = 'Update joke';
        ob_start();
        include '../templates/update_joke.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';
