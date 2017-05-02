<?php
include ('includes/airports.php');


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
                            if ($value['code'] == $destinationAirport) {
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

