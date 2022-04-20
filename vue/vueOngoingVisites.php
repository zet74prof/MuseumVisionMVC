<div class="row m-3 text-center">
    <h1>Visites en cours</h1>
</div>
<div class="row m-3">
    Il y a <?=$nbVisitesEnCours?> visites en cours
</div>
<div class="row m-3">
    <form method="post" action="./?action=ongoing_visites">
        <button type="submit" class="btn btn-primary">Terminer les visites</button>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Numéro de visite</th>
                <th scope="col">Sélectionner les visites à terminer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($visites as $visite)
            { ?>
                <tr>
                    <th scope="row"><?=$visite['id']?></th>
                    <td><input type="checkbox" name="<?=$visite['id']?>"</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </form>
</div>