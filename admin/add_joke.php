<?php
if (isset($_POST['joketext']) and isset($_POST['author_id']) and isset($_POST['category_id'])) {
    try {
        include '../includes/DatabaseConnection.php';
        include '../includes/DataBaseFunctions.php';

        $imgPath = '';
        if (isset($_FILES['joke_img']) && $_FILES['joke_img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../img/';
            $fileName = $_FILES['joke_img']['name'];
            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['joke_img']['tmp_name'], $targetPath)) {
                throw new RuntimeException('Failed to upload image.');
            }

            $imgPath = 'img/' . $fileName;
        }

        insertJoke($pdo, $_POST['joketext'], $_POST['author_id'], $_POST['category_id'], $imgPath);
        header('location: jokes.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    } catch (RuntimeException $e) {
        $title = 'An error has occurred';
        $output = 'Upload error: ' . $e->getMessage();
    }
} else {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataBaseFunctions.php';
    $authors = allAuthors($pdo);
    $categories = allCategories($pdo);
    $title = 'Add a new joke';
    ob_start();
    include '../templates/add_joke.html.php';
    $output = ob_get_clean();
}
include '../templates/admin_layout.html.php';
