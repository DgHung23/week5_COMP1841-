<h2>Jokes List</h2>
<h3>Total Jokes has submitted to database: <?= $totalJokes ?></h3>

<div class="jokes-table-wrapper">
    <table class="jokes-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Joke</th>
                <th scope="col">Image</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jokes as $joke): ?>
            <tr>
                <td class="joke-id"><?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td class="joke-text"><?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <?php if (!empty($joke['img_path'])): ?>
                    <img class="joke-image" src="<?= htmlspecialchars($joke['img_path'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="Image for joke <?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <?php else: ?>
                    <span class="no-image">No image</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="mailto:<?= htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </td>
                <td>
                    <?= htmlspecialchars($joke['joke_type'], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td>
                    <form class="delete-form" action="delete_joke.php" method="post">
                        <input type="hidden" name="id"
                            value="<?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <input class="delete-button" type="submit" value="Delete">
                    </form>
                </td>
                <td>
                    <form class="update-form" action="update_joke.php" method="post">
                        <input type="hidden" name="id"
                            value="<?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <input class="update-button" type="submit" value="Update">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
.jokes-table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #d8dee4;
    border-radius: 8px;
    background: #fff;
}

.jokes-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 720px;
}

.jokes-table th,
.jokes-table td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid #e8edf2;
    text-align: left;
    vertical-align: middle;
}

.jokes-table th {
    background: #243447;
    color: #fff;
    font-weight: 700;
}

.jokes-table tr:nth-child(even) {
    background: #f7f9fb;
}

.jokes-table tr:hover {
    background: #eef6ff;
}

.jokes-table tbody tr:last-child td {
    border-bottom: 0;
}

.joke-id {
    width: 4rem;
    color: #586069;
    font-weight: 700;
}

.joke-text {
    max-width: 34rem;
    line-height: 1.5;
}

.joke-image {
    display: block;
    width: 90px;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #d8dee4;
}

.no-image {
    color: #6a737d;
    font-size: 0.9rem;
}

.delete-form,
.update-form {
    margin: 0;
}

.delete-form .delete-button,
.update-form .update-button {
    float: none;
    clear: none;
    width: auto;
    margin: 10px;
    padding: 0.45rem 0.8rem;
    border: 0;
    border-radius: 6px;
    background: #d73a49;
    color: #fff;
    cursor: pointer;
    font-weight: 700;
}

.delete-button:hover,
.delete-button:focus,
.update-button:hover,
.update-button:focus {
    background: #b92534;
}
</style>