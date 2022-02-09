<?php
    include "config.php";
    $ancien_index = $_POST["ancien"];
    $nouvel_index = $_POST["nouvel"];
    $conso = $nouvel_index - $ancien_index;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input name="ancien" type="text" placeholder="Ancien Index">
        <input name="nouvel" type="text" placeholder="Nouvel Index">
        <input name="calibr" id="r1" type="radio"><label for="r1">Small</label>
        <input name="calibr" id="r2" type="radio"><label for="r2">Medium</label>
        <input name="calibr" id="r3" type="radio"><label for="r3">Large</label>
        <input type="submit">
    </form>
    <table>
        <?php
            if($conso <= 150){
                if($conso <= 100){
                    echo calculate(1, $conso, $trancheList[0]->tarif);
                }
                else{
                    echo calculate(1, $trancheList[0]->max, $trancheList[0]->tarif);
                    echo calculate(2, $conso-$trancheList[0]->max, $trancheList[1]->tarif);
                }
            }
            else{
                if($conso <= 210){
                    echo calculate(3, $conso, $trancheList[2]->tarif);
                }
                elseif($conso <= 310){
                    echo calculate(4, $conso, $trancheList[3]->tarif);
                }
                elseif($conso <= 510){
                    echo calculate(5, $conso, $trancheList[4]->tarif);
                }
                else {
                    echo calculate(6, $conso, $trancheList[5]->tarif);
                }
            }
        ?>
    </table>
</body>
</html>