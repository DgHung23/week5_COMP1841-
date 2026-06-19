<?php foreach ($jokes as $joke): ?>
<blockquote>
    <?= htmlspecialchars($joke['id'], ENT_QUOTES, 'UTF-8') ?>
    <?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?>
    <img style="max-width: 75px; height: auto" src="<?= htmlspecialchars($joke['img_path'], ENT_QUOTES, 'UTF-8') ?>"
        alt="">
    <form action='delete_joke.php' method="post">
        <input type='hidden' name='id' value='<?= $joke['id'] ?>'>
        <input style="margin: 0;" type='submit' value='delete'>
    </form>
</blockquote>
<?php endforeach; ?>