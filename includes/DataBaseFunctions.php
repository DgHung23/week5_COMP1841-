<?php
function query ($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}
function allJokes($pdo) {
    $query = query($pdo, 'SELECT joke.id,joketext,author.name, email,img_path, category.name as joke_type FROM joke INNER JOIN author ON `author_id` = author.id INNER JOIN category ON `category_id` = category.id ORDER BY joke.id ASC');
    return $query->fetchAll();
}
function totalJokes($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM joke');
    $row = $query->fetch();
    return $row[0];
}
function getJokes($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT id, joketext, jokedate FROM joke WHERE id = :id', $parameters);
    return $query->fetch();
}
function updateJoke($pdo, $id, $joketext, $jokedate) {
    $parameters = [
        ':id' => $id,
        ':joketext' => $joketext,
        ':jokedate' => $jokedate
    ];
    query($pdo, 'UPDATE joke SET joketext = :joketext, jokedate = :jokedate WHERE id = :id', $parameters);
}

function deleteJoke($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, "DELETE FROM JOKE WHERE id = :id", $parameters);
}
function insertJoke($pdo, $joketext, $author_id, $category_id, $img_path = '') {
    $parameters = [
        ':joketext' => $joketext,
        ':author_id' => $author_id,
        ':category_id' => $category_id,
        ':joke_img' => $img_path
    ];
    query($pdo, 'INSERT INTO joke SET
        joketext = :joketext,
        jokedate = CURDATE(),
        img_path = :joke_img,
        author_id = :author_id,
        category_id = :category_id', $parameters);
}

function allAuthors($pdo) {
    $authors = query($pdo, 'SELECT * FROM author');
    return $authors->fetchAll();
}
function allCategories($pdo) {
    $categories = query($pdo, 'SELECT * FROM category');
    return $categories->fetchAll();
}