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
        <h1>La citation du jour</h1>
        <?php
        $dbh = connexpdo("citations", "postgres", "Isen2018");
        $citation = $dbh->query("SELECT * from citation");
        $tmp = 0 ;
        foreach($citation as $data)
        {
            $tmp += 1 ;
        }
        echo "<p>Il y a <strong>$tmp</strong> citations répertoriées.</p>";
        echo "<p>Voici un d'autre elles générée aléatoirement :</p>";
        $tmp2 = rand(1,$tmp);
        $citation = $dbh->query("SELECT * from citation where id = $tmp2");

        foreach($citation as $data2)
        {
            echo "<strong>".$data2['phrase']."</strong><br>";
            $auteur = $dbh->query("select * from auteur where id = ".$data2['auteurid']);
            $siecle = $dbh->query("select * from siecle where id = ".$data2['siecleid']);
        }
        foreach($auteur as $data)
        {
            echo $data['prenom']." ".$data['nom'];
        }
        foreach ($siecle as $data){
            echo " (".$data['numero']."ème siècle)";
        }


        ?>
    </body>
    </html>
<?php
?>