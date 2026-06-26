<form action="" method="post" enctype="multipart/form-data">
    <label for="joketext">enter ur joke here:</label>
    <textarea id="joketext" name="joketext" rows="3" cols="40"></textarea>
    <label for="joke_img">select ur joke image here:</label>
    <input id="joke_img" name="joke_img" type="file" accept="image/*">

    <label for="author_id">Choose ur author here:</label>
    <select name="author_id" id="author_id">
        <?php foreach ($authors as $author) : ?>
        <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="category_id">Choose ur joke category here:</label>
    <select name="category_id" id="category_id">
        <?php foreach ($categories as $category) : ?>
        <option value="<?=$category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select>





    <input type="submit" name="submit" value="add">
</form>