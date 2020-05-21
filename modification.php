<?php
include("connexpdo.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Site</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="citation.php">Information</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="recherche.php">Rechercher</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modification.php">Modification</a>
                    </li>

                </ul>
            </div>
        </nav>
        <h1>Ajout</h1>
        <div>
            <form class="form" method="post">
                <div class="form-group">
                    <label for="iidAuteur">ID de l'auteur</label>
                    <input type="text" class="form-control" id="iidAuteur" name="idAuteur" >
                </div>
                <div class="form-group">
                    <label for="inomAuteur">Nom de l'auteur</label>
                    <input type="text" class="form-control" id="inomAuteur" name="nomAuteur" >
                </div>
                <div class="form-group">
                    <label for="iprenomAuteur">Prenom de l'auteur</label>
                    <input type="text" class="form-control" id="iprenomAuteur" name="prenomAuteur">
                </div>
                <div class="form-group">
                    <label for="iidSiecle">ID du siecle</label>
                    <input type="text" class="form-control" id="iidSiecle" name="idSiecle" >
                </div>
                <div class="form-group">
                    <label for="inumSiecle">Siecle</label>
                    <input type="text" class="form-control" id="inumSiecle" name="numSiecle">
                </div>
                <div class="form-group">
                    <label for="icitation">Citation</label>
                    <input type="text" class="form-control" id="icitation" name="citation">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php
            if(!empty($_POST['idAuteur']) && !empty($_POST['nomAuteur']) && !empty($_POST['prenomAuteur']) && !empty($_POST['idSiecle']) && !empty($_POST['numSiecle']) && !empty($_POST['citation'])){
                $dbh = connexpdo("citations", "postgres", "Isen2018");
                $dbh->query("INSERT into auteur values ('".$_POST['idAuteur']."','".$_POST['nomAuteur']."','".$_POST['prenomAuteur']."');");
                $dbh->query("INSERT into siecle values ('".$_POST['idSiecle']."','".$_POST['numSiecle']."');");
                $dbh->query("INSERT into citation values ('".($_POST['idAuteur']+$_POST['idSiecle'])."','".$_POST['citation']."','".$_POST['idAuteur']."','".$_POST['idSiecle']."');");
            }

            ?>
        </div>
        <h1>Suppression</h1>
        <form method="post">
            <div class="form-group" >
                <label for="idCitation">Selectionnez l'id de la citation à supprimer</label>
                <select class="form-control" id="idCitation" name="idCitation">
                    <?php
                    $dbh = connexpdo("citations", "postgres", "Isen2018");
                    $auteur = $dbh->query("SELECT * from citation");
                    foreach ($auteur as $data){
                        echo "<option value='".$data["id"]."'>".$data["id"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Supprimer</button>
        </form>
        <?php
            if(!empty($_POST['idCitation'])){
                $dbh = connexpdo("citations", "postgres", "Isen2018");
                $dbh->query("DELETE from citation where id = ".$_POST['idCitation'].";");

            }

        ?>
    </body>
</html>
<?php
?>
