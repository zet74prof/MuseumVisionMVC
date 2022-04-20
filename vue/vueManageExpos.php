<div class="row m-3 text-center">
    <h1>Gestion des expositions</h1>
</div>
<div class="row m-3">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de l'expo</th>
            <th scope="col">Tarif adultes</th>
            <th scope="col">Tarif enfants</th>
            <th scope="col">Active</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($expos as $expo)
        { ?>
        <tr>
            <th scope="row"><?=$expo['id']?></th>
            <td><?=$expo['nomExpo']?></td>
            <td><?=$expo['tarifAdulte']?></td>
            <td><?=$expo['tarifEnfant']?></td>
            <td><input type="checkbox" <?php if($expo['active']) echo "checked"?> onclick="return false;"></td>
            <td><a href="./?action=param&actionExpo=modif&expoId=<?=$expo['id']?>#form"><button class="btn btn-secondary">Modifier</button></a></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="./?action=param&actionExpo=create#form"><button class="btn btn-secondary">Créer une expo</button></a></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row m-3" id="form">
    <form method="post" action="./?action=param" <?php if ($hidden) echo "hidden"?>>
        <input name="expoId" value="<?php if ($action == 2) echo $expoSelected['id']?>" hidden>
        <div class="row mb-3">
            <div class="col-2">
                <label for="expoName" class="form-label">
                    Nom de l'expo
                </label>
            </div>
            <div class="col-10">
                <input name="expoName" type="text" required class="form-control" value="<?php if ($action == 2) echo $expoSelected['nomExpo']?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label for="tarifAdulte" class="form-label">
                    Tarif adultes
                </label>
            </div>
            <div class="col-10">
                <input type="number" step=".01" required name="tarifAdulte" class="form-control" value="<?php if ($action == 2) echo $expoSelected['tarifAdulte']?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label for="tarifEnfant" class="form-label">
                    Tarif enfants
                </label>
            </div>
            <div class="col-10">
                <input type="number" step=".01" required name="tarifEnfant" class="form-control" value="<?php if ($action == 2) echo $expoSelected['tarifEnfant']?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label for="active" class="form-check-label">
                    Active
                </label>
            </div>
            <div class="col-10">
                <input type="checkbox" name="active" class="form-check-input" <?php if ($action == 2 && $expoSelected['active']) echo 'checked'?>>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </form>
</div>
<div class="row m-3" <?php if (!$displayAlert) echo 'hidden'?>>
    <div class="alert alert-danger" role="alert">
        <?=$message?>
    </div>
</div>