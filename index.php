<?php
    include "config.php";
    $ancien_index = $_POST["ancien"];
    $nouvel_index = $_POST["nouvel"];
    $conso = $nouvel_index - $ancien_index;
    $cal = $_POST["calibr"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input name="ancien" type="text" placeholder="Ancien Index">
        <input name="nouvel" type="text" placeholder="Nouvel Index">
        <input name="calibr" id="r1" type="radio" value="small"><label for="r1">Small</label>
        <input name="calibr" id="r2" type="radio" value="medium"><label for="r2">Medium</label>
        <input name="calibr" id="r3" type="radio" value="large"><label for="r3">Large</label>
        <input type="submit">
    </form>
    <table class="table table-striped">
        <thead>
            <th></th>
            <th>Facturé</th>
            <th>P.U</th>
            <th>Montant HT</th>
            <th>Taux TVA</th>
            <th>Montant Taxes</th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <th colspan="4">Consommation Electricite</th>
                <th colspan="3" class="right">إستهلاك الكهرباء</th>
            </tr>
            <?php
                $montantHT = 0;
                $montantTaxes = 0;
                $montantTotal = 0;
                if($conso <= 150){
                    if($conso <= 100){
                        echo calculate(1, $conso, $trancheList[0]->tarif);
                        $montantHT+=$conso*$trancheList[0]->tarif;
                    }
                    else{
                        echo calculate(1, $trancheList[0]->max, $trancheList[0]->tarif);
                        echo calculate(2, $conso-$trancheList[0]->max, $trancheList[1]->tarif);
                        $montantHT += $trancheList[0]->max * $trancheList[0]->tarif;
                        $montantHT += ($conso - $trancheList[0]->max)*$trancheList[1]->tarif;
                    }
                }
                else{
                    if($conso <= 210){
                        echo calculate(3, $conso, $trancheList[2]->tarif);
                        $montantHT+=$conso*$trancheList[2]->tarif;
                    }
                    elseif($conso <= 310){
                        echo calculate(4, $conso, $trancheList[3]->tarif);
                        $montantHT+=$conso*$trancheList[3]->tarif;
                    }
                    elseif($conso <= 510){
                        echo calculate(5, $conso, $trancheList[4]->tarif);
                        $montantHT+=$conso*$trancheList[4]->tarif;
                    }
                    else {
                        echo calculate(6, $conso, $trancheList[5]->tarif);
                        $montantHT+=$conso*$trancheList[5]->tarif;
                    }
                }
                
                echo "<tr>
                        <th colspan='3'>Redevance fixe electricite</th>
                        <td>". $calibre[$cal] ."</td>
                        <td>14%</td>
                        <td>".$calibre[$cal]*$Tva."</td>
                        <th class='right'>إثاوة ثابثة الكهرباء</th>
                    </tr>";
                    $montantHT += $calibre[$cal];
            ?>
            <tr>
                <th colspan="6">TAXES POUR LE COMPTE DE L'ETAT</th>
                <th class="right">الرسوم المؤداة لفائدة الدولة</th>
            </tr>
            <tr>
                <td colspan="5">Total TVA</td>
                <td><?php echo ($montantHT)*$Tva ?></td>
                <td class="right">مجموع ض.ق.م</td>
            </tr>
            <tr>
                <td colspan="5">TIMBRE</td>
                <td><?php echo $timbre?></td>
                <td class="right">الطابع</td>
            </tr>
            <tr>
                <th colspan='3'>SOUS-TOTAL</th>
                <th colspan="2"><?php echo $montantHT;?></th>
                <th><?php echo ($montantHT * $Tva) + $timbre;?></th>
                <th class="right">المجموع الجزئي</th>
            </tr>
            <tr>
                <th colspan='4'>TOTAL ELECTRICITE</th>
                <th colspan="2"><?php
                    $montantTotal = $montantHT + ($montantHT*$Tva) + $timbre;
                    echo $montantTotal;
                ?></th>
                <th class='right'>مجموع الكهرباء</th>
            </tr>
        </tbody>
    </table>
</body>
</html>