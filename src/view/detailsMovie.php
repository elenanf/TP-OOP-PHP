<div class="container p-3">
    <?php if ($this->movie && !isset($_GET['delete'])) { ?>
        <div class="d-flex justify-content-center mb-2"><h1>Détails du film : <?= $this->movie['movie_name'] ?></h1></div>

        <div class="row">
            <div class="col">
                <img src="src/public/images/<?= $this->movie['movie_image'] ?>" class="img-fluid m-2" alt="<?= $this->movie['movie_name'] ?>">
            </div>
            <div class="col">
                <h1> <?= $this->movie['movie_name'] ?></h1>
                <h5>Date de sortie : <?= $this->movie['movie_release_year'] ?></h5>
                <h5>Durée : <?= $this->movie['movie_duration'] ?></h5>
                <h5>Réalisateur : <?= $this->movie['director_firstname'] ?> <?= $this->movie['director_lastname'] ?></h5>
                <h5>Catégorie : <?= $this->movie['category_name'] ?></h5>
                <h5>Acteurs :</h5>
                <?php foreach ($this->actors as $actor) { ?>
                    <span><?= $actor['actor_name'] ?></span><br>
                <?php } ?>
                <p><?= $this->movie['movie_synopsis'] ?></p>
                <?= $this->movie['movie_trailer'] ?>
                <a class="btn btn-danger" href="index.php?page=detailsMovie&id=<?= $this->movie['movie_id']?>&delete=true">Supprimer</a>
            </div>
        </div>
    <?php } ?>
</div>