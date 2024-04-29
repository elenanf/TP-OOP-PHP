<h1 style="text-align: center"><?= $this->title ?></h1>
<form action="index.php?page=<?=$this->location?>" method="post" style="width: 60%; margin: auto" >
    <?php if ($this->displayPseudo) { ?>
    <div class="mb-3">
        <label for="pseudo" class="form-label">Votre pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo">
    </div>
    <?php } ?>
    <div class="mb-3">
        <label for="email" class="form-label">Votre email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
        <label for="pswrd" class="form-label">Votre mot de passe</label>
        <input type="password" class="form-control" name="pswrd" id="pswrd">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>