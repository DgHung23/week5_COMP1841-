<?php
if (isset($_POST['joketext']) and isset($_POST['author_id']) and isset($_POST['category_id'])) {
    try {
        include 'includes/DatabaseConnection.php';

        $imgPath = '';
        if (isset($_FILES['joke_img']) && $_FILES['joke_img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/img/';
            $fileName = $_FILES['joke_img']['name'];
            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['joke_img']['tmp_name'], $targetPath)) {
                throw new RuntimeException('Failed to upload image.');
            }

            $imgPath = 'img/' . $fileName;
        }

        $sql = 'INSERT INTO joke SET
        joketext = :joketext,
        jokedate = CURDATE(),
        img_path = :joke_img,
        author_id = :author_id,
        category_id = :category_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':joke_img', $imgPath);
        $stmt->bindValue(':author_id', $_POST['author_id']);
        $stmt->bindValue(':category_id', $_POST['category_id']);
        $stmt->execute();
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
    include 'includes/DatabaseConnection.php';
    $sql_a = 'SELECT * FROM author';
    $authors = $pdo->query($sql_a);
    $sql_c = 'SELECT * FROM category';
    $categories = $pdo->query($sql_c);
    $title = 'Add a new joke';
    ob_start();
    include 'templates/add_joke.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';