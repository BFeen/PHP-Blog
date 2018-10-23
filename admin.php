<h1>Добавить запись</h1>
<form class="form-admin" enctype="multipart/form-data" action="posting.php" method="POST">
    <div class="form-group">
        <label for="header">Заголовок</label>
        <input class="form-control" id="header" name="header" required>
    </div>
    <div class="form-group">
        <label for="content">Текст</label>
        <textarea class="form-control" id="content" name="content" maxlength="1000" required></textarea>
    </div>
    <div class="form-group">
        <label for="picture">Прикрепить изображение</label>
        <input type="file" id="picture" name="picture">
    </div>
    <input class="btn btn-primary" type="submit" value="Добавить">
    <a class="" href="exit.php" role="button">Выход</a>
</form>
