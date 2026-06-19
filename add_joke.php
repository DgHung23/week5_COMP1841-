<?php
if (isset($_POST['joketext'])) {
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
        img_path = :joke_img';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':joke_img', $imgPath);
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
    $title = 'Add a new joke';
    ob_start();
    include 'templates/add_joke.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';