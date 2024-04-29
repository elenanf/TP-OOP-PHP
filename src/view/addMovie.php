<h1><?= $this->title ?></h1>

<form action="" method="post" style="width: 60%; margin: auto" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre du film</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Année de sortie</label>
        <input type="number" min="1830" max="2100" class="form-control" name="year" id="year">
    </div>
    <div class="form-group">
        <label for="synopsis">Résumé</label>
        <textarea class="form-control" name="synopsis" id="synopsis" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="trailer" class="form-label">Bande annonce</label>
        <input type="text" class="form-control" name="trailer" id="trailer">
    </div>
    <div class="mb-3">
        <label for="duration" class="form-label">Durée du film</label>
        <input type="time" class="form-control" name="duration" id="duration">
    </div>
    <div class="form-group">
        <label for="cat">Catégorie</label>
        <select class="form-control" id="category" name="category">
            <option value=""></option>
            <?php foreach ($this->categories as $cat) {
                echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="cat">Réalisateur</label>
        <select class="form-control" id="director" name="director">
            <option value=""></option>
            <?php foreach ($this->directors as $dir) {
                echo "<option value='{$dir['director_id']}'>{$dir['director_firstname']} {$dir['director_lastname']}</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="actor">Acteur</label>
        <select class="form-control" id="actor" name="actor[]" multiple>
            <option value=""></option>
            <?php foreach ($this->actors as $actor) {
                echo "<option value='{$actor['actor_id']}'>{$actor['actor_name']}</option>";
            } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Affiche du film</label>
        <input class="form-control" type="file" id="formatFile" name="picture">
    </div>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>