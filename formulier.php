<?php global $concert_title,
             $normal_price,
             $student_price,
             $ns_retour_price,
             $concert_title,
             $ns_retour_possible,
             $concert_date,
             $concert_time; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Voorjaarsconcert | Kaartverkoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function confirmForm() {
            var email = document.getElementById("email").value;
            var email2 = document.getElementById("email2").value;
            var aantal_concert = document.getElementById("aantal_concert").selectedIndex;
            var aantal_ns = document.getElementById("aantal_ns").selectedIndex;
            var aantal_st = document.getElementById("aantal_st").selectedIndex;
            var price = (aantal_concert * <?php printf("%.2f", $normal_price);?>) +
                (aantal_ns * <?php printf("%.2f", $ns_retour_price); ?>) +
                (aantal_st * <?php printf("%.2f", $student_price); ?>);
            if(email !== email2 && price <= 0) {
                alert('De ingevoerde e-mail adressen zijn niet gelijk aan elkaar!\n' +
                    'Selecteer ten minste 1 ticket!');
                return false;
            } else if (email !== email2) {
                alert('De ingevoerde e-mail adressen zijn niet gelijk aan elkaar!');
                return false;
            } else if (price <= 0) {
                alert('Selecteer ten minste 1 ticket!');
                return false;
            }
            return true;
        }
        function confirmEmail() {
            var email = document.getElementById("email").value;
            var email2 = document.getElementById("email2").value;
            if(email !== email2) {
                document.getElementById('emailerror').innerHTML="Het e-mail adres is niet hetzelfde!";
            }
            if(email === email2) {
                document.getElementById('emailerror').innerHTML="";
            }
        }
        function confirmPrice() {
            var aantal_concert = document.getElementById("aantal_concert").selectedIndex;
            var aantal_ns = document.getElementById("aantal_ns").selectedIndex;
            var aantal_st = document.getElementById("aantal_st").selectedIndex;
            var price = (aantal_concert * <?php printf("%.2f", $normal_price);?>) +
                (aantal_ns * <?php printf("%.2f", $ns_retour_price); ?>) +
                (aantal_st * <?php printf("%.2f", $student_price); ?>);
            if (price <= 0) {
                document.getElementById("price_error").innerHTML="Selecteer ten minste 1 ticket!";
            } else {
                document.getElementById("price_error").innerHTML="";
            }
            document.getElementById("price").value= "€" + price.toFixed(2);

        }
    </script>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h2>Bestelformulier Toegangskaarten <br>
            Voorjaarsconcert Euregio Brassband & SHOT</h2>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor <?php print($concert_title); ?></h3>
            <h5>
            <?php if($currently_selling) { ?>
                U kunt hier toegangskaarten bestellen voor <?php print($concert_title); ?> van Euregio Brassband en
                SHOT. Dit concert vindt plaats op <?php print($concert_date); ?> om <?php print($concert_time); ?> uur
                in de Ontmoetingskerk te Enschede (Varviksingel 139). Toegangskaarten kosten
                &euro;<?php printf("%.2f", $normal_price);?> per stuk in de
                voorverkoop (studenten: &euro;<?php printf("%.2f", $student_price); ?>) en kunnen online worden
                betaald. De kaarten die u besteld heeft, kunt u voorafgaand aan het concert ophalen bij de ingang van de
                kerk. Het is ook  mogelijk om toegangskaarten aan de deur te verkrijgen. In het geval u gebruik maakt
                van het studenten-tarief, verzoeken wij u uw studentenkaart mee te nemen.
                <?php if($ns_retour_possible) { ?>
                    <br><br> Komt u van ver maar wilt u dit mooie concert niet missen? Wij bieden de mogelijkheid een NS
                    Groepsretour ticket aan te schaffen. Hiermee kunt u van een willekeurig station opstappen richting
                    station Enschede of station Enschede Kennispark. Vanaf station Enschede kunt u de bus (lijn 1, 8 of 9)
                    nemen richting de campus van de UT. Vanaf station Enschede Kennispark kunt u zich lopend begeven naar
                    het sportcentrum (15 tot 20 minuten) of de bus (lijn 1) nemen richting de campus van de UT
                    (let op: de buskosten zitten niet inbegrepen in het NS Groepsretour!). Dit ticket kost
                    &euro;<?php printf("%.2f", $ns_retour_price); ?> en is verkrijgbaar t/m 1 juni 2017. Ook het
                    NS Groepsretour kan online worden betaald.
                <?php } else { ?>
                    <br><br>Helaas is het voor dit concert niet (meer) mogelijk om een NS Groepsretour ticket bij ons aan te
                    schaffen.
                <?php } ?>
            <?php } else { ?>
                Helaas kunt u online geen toegangskaarten meer bestellen voor <?php print($concert_title); ?>,
                dat plaatsvindt op <?php print($concert_date); ?> om <?php print($concert_time); ?> uur in de Ontmoetingskerk
                te Enschede (Varviksingel 139). Kaarten zijn nog wel beschikbaar aan de deur. Toegangskaarten kosten daar
                &euro;<?php printf("%.2f", $normal_price);?> per stuk (student:
                &euro;<?php printf("%.2f", $student_price); ?>).
            <?php } ?>
                <br><br>Voor vragen naar aanleiding van de bestelprocedure, of heeft u andere vragen en / of
                        opmerkingen, dan kunt u contact opnemen met:
                <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a><br><br>
            </h5>
            <?php if($currently_selling) { ?>
                <h4>Vul hier uw gegevens in:</h4>
                <form class="form-horizontal" role="form" method="post" onsubmit="return confirmForm()">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="firstname">Voornaam:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="firstname" required>
                        </div>
                        <label class="control-label col-sm-4" for="aantal_concert">Aantal toegangskaarten:</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="aantal_concert" id="aantal_concert"
                                    onchange="confirmPrice()">
                                <option value="0">0</option>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lastname">Achternaam:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="lastname" required>
                        </div>
                        <label class="control-label col-sm-4" for="aantal_st">Aantal toegangskaarten (student):</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="aantal_st" id="aantal_st" onchange="confirmPrice()">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="e-mail">E-mail:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="e-mail" id="email" required
                                   pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                        </div>
                        <label class="control-label col-sm-4" for="aantal_ns">Aantal NS Groepsretour tickets:</label>
                        <div class="col-sm-2">
                            <select <?php if(!$ns_retour_possible) { ?> disabled <?php } ?>
                                    class="form-control" name="aantal_ns" id="aantal_ns" onchange="confirmPrice()">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="e-mail2">E-mail ter controle:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="e-mail2" id="email2" required
                                   pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}" onblur="confirmEmail()">
                            <div id="emailerror" style="color: red;"></div>
                            <div id="price_error" style="color: red;"></div>
                        </div>
                        <label class="control-label col-sm-4" for="method">Prijs:</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="price" id="price" required
                                   value="€<?php printf("%.2f", $normal_price);?>"
                                   disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="method">Betaalmethode:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="method">
                                <option value="ideal">iDeal</option>
                                <option value="mistercash">Bancontact</option>
                                <option value="sofort">SOFORT Banking</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Bestellen en betalen</button>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <img src="http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg" alt="SHOT Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
            <img src="https://www.euregiobrassband.nl/templates/siteground-j16-41/images/website_logo.png"
                 alt="ESMG Quadrivium Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
        </div>
    </div>
</div>
</body>
</html>
