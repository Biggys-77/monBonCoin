<?php

var_dump($annonce);

?>

<?php if (!$msg) : ?>
    <div class="card">
        <div class="card-header bg-primary text-center">
            <h3 class="card-title text-white"><?= $annonce['title'] ?></h3>
        </div>
        <div class="card-body text-center">
            <img src="<?= SITEBASE ?>/img/annonces/<?= $annonce['image'] ?>" alt="<?= $annonce['title'] ?>" class="imgAnnonce align-self-center img-thumbnail grow">
            <p>Description :</p>
            <p><?= $annonce['description'] ?></p>
        </div>
    <div class="card-footer text-center">
        <p class="strong"><?= $annonce['price'] ?> €</p>
        <a href="" class="btn btn-primary">Ajouter au panier</a>
    </div>
    </div>
<?php else : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><?= $msg ?></strong>
    </div>
<?php endif ?>