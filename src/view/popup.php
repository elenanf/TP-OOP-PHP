<?php if ($this->msgSuccess) { ?>
    <div class="alert alert-success" role="alert">
        <?= $this->msgSuccess ?>
    </div>
<?php }

if ($this->msgError) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->msgError ?>
    </div>
<?php } ?>