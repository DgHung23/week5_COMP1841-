<h2>Update Joke</h2>

<form action="update_joke.php" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?>">

    <label for="joketext">Edit your joke here:</label>
    <textarea id="joketext" name="joketext" rows="3"
        cols="40"><?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?></textarea>

    <label for="jokedate">Edit joke date:</label>
    <input id="jokedate" name="jokedate" type="date"
        value="<?= htmlspecialchars($joke['jokedate'], ENT_QUOTES, 'UTF-8') ?>">

    <input type="submit" name="submit" value="Update">
</form>
