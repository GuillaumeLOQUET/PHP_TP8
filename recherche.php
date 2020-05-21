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
        <form method="post">
            <div class="form-group" >
                <label for="auteur">Auteur</label>
                <select class="form-control" id="auteur" name="idAuteur">
                    <?php
                    $dbh = connexpdo("citations", "postgres", "Isen2018");
                    $auteur = $dbh->query("SELECT * from auteur");
                    foreach ($auteur as $data){
                        echo "<option value='".$data["id"]."'>".$data["prenom"]." ".$data['nom']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="siecle">Siecle</label>
                <select class="form-control" id="siecle" name="idSiecle">
                    <?php
                    $siecle = $dbh->query("SELECT * from siecle");
                    foreach ($siecle as $data){
                    echo "<option value='".$data["id"]."'>".$data["numero"]."ème siècle</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    <div>
            <?php
            if(!empty($_POST['idAuteur']) && !empty($_POST['idSiecle'])){
                echo "<table class='table'>
            <tr class='font-weight-bold'>
                <td>Citation</td>
                <td>Auteur</td>
                <td>Siecle</td>
            </tr>";
                $citation = $dbh->query("Select c.phrase, a.nom,s.numero from citation c,auteur a,siecle s  where c.auteurid = ".$_POST['idAuteur']." and c.siecleid = ".$_POST['idSiecle']." and s.id = c.siecleid and a.id = c.auteurid ;");

                foreach ($citation as $data){
                    echo "<tr><td>".$data["phrase"]."</td><td>".$data["nom"]."</td><td>".$data["numero"]."</td></tr>";
                }
                echo "</table>";
            }

            ?>

    </div>

    </body>
    </html>
<?php
?>