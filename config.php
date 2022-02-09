<?php
    $Tva = 0.14;
    $calibre = ["small" =>22.65, "medium" =>37.05, "large" =>46.20];

    class Tranche {
        public $min;
        public $max;
        public $tarif;
        function __construct($min, $max, $tarif){
            $this->min = $min;
            $this->max = $max;
            $this->tarif = $tarif;
        }
    }

    $trancheList = [
        new Tranche(0, 100, 0.794),
        new Tranche(101, 150, 0.883),
        new Tranche(151, 210, 0.9451),
        new Tranche(211, 310, 1.0489),
        new Tranche(311, 510, 1.2915),
        new Tranche(511, NULL, 1.4975)
    ];

    function calculate($trn_num, $facture, $tar){
        global $Tva;
        return "<tr>*
            <td>TRANCHE $trn_num</td>
            <td>$facture</td>
            <td>$tar</td>
            <td>".$facture*$tar."</td>
            <td>14%</td>
            <td>".$facture*$tar*$Tva."</td>
            <td>الشطر $trn_num</td>
        </tr>";
    }
?>