<?php
include("connexpdo.php");
$dbh = connexpdo("citations","postgres","Isen2018");
$query1 = "SELECT * from auteur";
$result1 = $dbh->query($query1);
foreach($result1 as $data)
{
    echo $data['premon']." ".$data["nom"]."<br>";
}
echo "<br>";
$query1 = "SELECT * from citation";
$result1 = $dbh->query($query1);
foreach($result1 as $data)
{
    echo $data['phrase']."<br>";
}
echo "<br>";
$query1 = "SELECT * from siecle";
$result1 = $dbh->query($query1);
foreach($result1 as $data)
{
    echo $data['numero']."<br>";
}
$query1 = "SELECT * from auteur";
$result1 = $dbh->query($query1);

echo "<table>";
echo "<tr>";
echo "<td>Nom</td><td>Preom</td>";
echo "</tr>";
foreach ($result1 as $data){
    echo "<tr>" ;
    echo "<td>".$data['nom']."</td><td>".$data['prenom']."</td>";
    echo "</tr>" ;
}
echo "</table>";

