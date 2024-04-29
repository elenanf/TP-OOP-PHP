<div class="d-flex justify-content-center mb-2"><h1><?= $this->title ?></h1></div>
<div style="display: flex; justify-content: space-around; width: 80%; margin: auto; flex-wrap: wrap">
    <?php
    if ($this->movies) {
        foreach ($this->movies as $movie) { ?>
        <a href="index.php?page=detailsMovie&id=<?= $movie['movie_id'] ?>">
            <img src="src/public/images/<?= $movie['movie_image'] ?>"
                 width="300"
                 height="450"
                 class="m-2"
                 alt="<?= $movie['movie_name']
                 ?>">
        </a>
    <?php }
    } ?>
</div>