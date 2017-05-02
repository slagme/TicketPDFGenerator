
<?php

include ('includes/airports.php');
require_once ('vendor/autoload.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
           if (($_POST['departureAirport'] != $_POST['destinationAirport'] )){
                if(isset($_POST['startDate']) && isset($_POST['flightLength'])){
                    if ($_POST['price'] > 0) {
                        $departureAirport = $_POST['departureAirport'];
                        $destinationAirport = $_POST['destinationAirport'];
                        $startDate = $_POST['startDate'];
                        $flightLength = $_POST['flightLength'];
                        $price = $_POST['price'];

                        foreach ($airports as $key => $value) {
                            if ($value['code'] == $departureAirport){
                                $depTimezone = $value['timezone'];
                            }
                            if ($value['code'] == $destinationAirport){
                                $arrTimezone = $value['timezone'];
                            }
                        }
                        $departureDateTime = new DateTime($startDate);
                        $newDepartureDateTime= $departureDateTime -> format('d.m.Y H:i:s' );

                        $arrivalTimeZone = new DateTimeZone($arrTimezone);

                        $arrivalTime = new DateTime($startDate);
                        $arrivalTime -> modify("+$flightLength hours");
                        $arrivalTime ->setTimezone($arrivalTimeZone);
                        $newArrivalTime = $arrivalTime -> format ('d.m.Y H:i:s');
                    }else{
                            echo ("Please select price");
                            exit;
                    }

                }else {
                        echo ("Please select start date and flight length");
                        exit;
                }
           }else {
                    echo ("Your destination can't be the same as your starting point");
                    exit;
           }
}

$faker=Faker\Factory::create();

use NumberToWords\NumberToWords;

$numberToWords = new NumberToWords();
$currencyTransformer=$numberToWords->getCurrencyTransformer('en');
$priceToWords=$currencyTransformer->toWords($price*100, 'USD');

?>
$html = '
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flights reservations</title>
</head>
<body>
    <table border="1px">
        <?php
            echo "<th>". "Passenger : " .$faker->name ."</th>";
            echo "<tr><td>". $departureAirport.  " Your departure time is: ". $newDepartureDateTime."</td></tr>";
            echo "<tr><td>". $destinationAirport ." Your arrival time is: ". $newArrivalTime  ."</td></tr>";
            echo "<tr><td>". "Your flight lasts: ".$flightLength." hours". "</td></tr>";
            echo "<tr><td>". "Price of your flight: ". $price ." $"."</td></tr>";
            echo "<tr><td>". "Price in words: ". $priceToWords ."</td></tr>";
        ?>
</table>
</body>
</html>
';
<?php
$mpdf = new mPDF();

$mpdf->writeHtml($html);
$mpdf->Output();