<div class="row m-3 text-center">
    <h1>Nouvelle entrée</h1>
</div>
<div class="row m-3">
    <form action="./?action=create_visite" method="post">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="row mb-1">
                    <label class="col-4 col-form-label" for="nbAdultes">
                        Nombre d'entrées Adulte
                    </label>
                    <div class="col-6">
                        <input class="form-control" required type="number" min="0" value="<?php echo $nbAdultes?>" id="nbAdultes" name="nbAdultes">
                    </div>
                </div>
                <div class="row mb-1">
                    <label class="col-4 col-form-label" for="nbEnfants">
                        Nombre d'entrées Enfant
                    </label>
                    <div class="col-6">
                        <input class="form-control" required type="number" min="0" value="<?php echo $nbEnfants?>" id="nbEnfants" name="nbEnfants">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <?php foreach ($expos as $expo)
                    {?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?php if (in_array($expo['id'], $checkedExpos, true)){echo 'checked';} ?> value="checked" id="expo<?php echo $expo['id']?>" name="expo<?php echo $expo['id']?>">
                        <label class="form-check-label" for="expo<?php echo $expo['id']?>">
                            <?php echo $expo['nomExpo'] ?>
                        </label>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-6 d-md-flex justify-content-md-end">
                <button type="submit" name="calculerTarif" class="btn btn-primary">Calculer tarif</button>
            </div>
            <div class="col-6 d-md-flex justify-content-md-start">
                <button type="submit" name="valider" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</div>
<div class="row m-3 text-center">
    <p>A payer: <?php echo $tarif;?>€</p>
</div>
<div class="row m-3 text-center">
    <p class="text-danger"><?php echo $message;?></p>
</div>
