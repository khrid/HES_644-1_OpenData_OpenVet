<?php
require_once "inc/init.php";
$database = new Database();
//$api = new ApiTelSearch();
//$database->clearDatabase();
//$api->insertAllVets();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>FINDVETVS</title>
    <!--
    SOFTY PINKO
    https://templatemo.com/tm-535-softy-pinko
    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">

    <script>
        var geocoder;
        var map;
        var address = "groupe mutuel martigny";
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: 46.1833, lng: 7.5833}
            });
            geocoder = new google.maps.Geocoder();

            $.ajax({
                url: "ajax.php?target=vetstojson",
                datatype: "json",
                crossDomain: true,
                success: function (data) {
                    //alert(data);
                    var vets = JSON.parse(data);
                    //console.log(vets);
                    for (let i in vets) {
                        var vet = vets[i];
                        codeAddress(vet, geocoder, map);
                        // TODO fix geocoding limit + store vet lat and lng in db
                    }
                }
            });
        }

        function codeAddress(vet, geocoder, map) {
            geocoder.geocode({'address': vet.name + " " + vet.street + " " + vet.city}, function(results, status) {
                if (status === 'OK') {
                    //map.setCenter(results[0].geometry.location);
                    const infowindow = new google.maps.InfoWindow({
                        content: "<b>"+vet.name + "</b><br/> " + vet.street + "<br/>" + vet.city+
                            "<br/><br/>Tel: " + vet.phone,
                    });
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: vet.name
                    });
                    marker.addListener("click", () => {
                        infowindow.open(map, marker);
                    });
                } else {
                    //alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
    <script async defer
            src=https://maps.googleapis.com/maps/api/js?key=AIzaSyDvALHpLikMI2sPGihN6RAxrq-q9wDQkDc&callback=initMap&libraries=&v=weekly">
    </script>

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <img src="assets/images/logo.png" alt="Softy Pinko"/>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <a class="nav">
                        Sierre-Sion-Conthey<br>
                        0900 502 502</a>
                    <a class="nav">
                        Riddes-Martigny-Monthey<br>
                        0900 506 506
                    </a>

                    <a class="nav">
                        Numéros de garde :
                    </a>

                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome">

    <!-- ***** Header Text Start ***** -->
    <div class="header-text">
        <div class="container">
            <div class="row">
                <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                    <h1> Trouve ton vétérinaire dans le Valais romand</h1>

                    <p>Tu retrouveras ici tous les cabinets vétérinaires disponibles dans ta région. Tu peux consulter leurs horaires et leurs informations de contact.</p>

                </div>
            </div>
        </div>
    </div>
    <!-- ***** Header Text End ***** -->
</div>
<!-- ***** Welcome Area End ***** -->

<!-- ***** Features Small Start ***** -->
<section class="section home-feature">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-01.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Vous avez une urgence</h5>
                            <p>Votre animal est mal en point et vous devez l'aider au plus vite.</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-02.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Vous cherchez un vétérinaire</h5>
                            <p>Grâce à notre plateforme, trouvez votre vétérinaire proche de chez vous.</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-03.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Vous contactez le vétérinaire</h5>
                            <p>Toutes les informations utiles sont disponibles en un clic.</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Small End ***** -->




<!-- ***** Testimonials Start ***** -->
<section class="section" id="testimonials">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">Les cabinets</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>Trouvez le vétérinaire qui vous correspond le plus dans notre liste ci-dessous:</p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">

            <?php
            $database->displayAllVets();
            ?>


        </div>

    </div>
</section>
<!-- ***** Testimonials End ***** -->


<!-- ***** Testimonials Start ***** -->
<section class="section" id="testimonials">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">Carte</h2>
                </div>
            </div>

        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">

            <div id="map"></div>
        </div>

    </div>
</section>
<!-- ***** Testimonials End ***** -->


<!-- ***** Counter Parallax Start ***** -->
<section class="counter">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="count-item decoration-bottom">
                        <?php $database->displayVetsCount(); ?>
                        <span>Cabinets</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="count-item decoration-bottom">
                        <?php $database->displayCitiesCount(); ?>
                        <span>Localités</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ***** Counter Parallax End ***** -->

<!-- ***** Contact Us Start ***** -->


<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="copyright">Copyright &copy; 2021 FindVetVS</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script>

<!-- Global Init -->
<script src="assets/js/custom.js"></script>

</body>
</html>
