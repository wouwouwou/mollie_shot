<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Muzikale Roadtrip SHOT - QHarmony - De Ontzetting | Kaartverkoop</title>
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
            var price = (aantal_concert * 7.50) + (aantal_ns * 8.00);
            if(email != email2 && price <= 0) {
                alert('De ingevoerde e-mail adressen zijn niet gelijk aan elkaar!\n' +
                    'Selecteer ten minste 1 ticket!');
                return false;
            } else if (email != email2) {
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
            if(email != email2) {
                document.getElementById('emailerror').innerHTML="Het e-mail adres is niet hetzelfde!";
            }
            if(email == email2) {
                document.getElementById('emailerror').innerHTML="";
            }
        }
        function confirmPrice() {
            var aantal_concert = document.getElementById("aantal_concert").selectedIndex;
            var aantal_ns = document.getElementById("aantal_ns").selectedIndex;
            var price = (aantal_concert * 7.50) + (aantal_ns * 8.00);
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
            Muzikale Roadtrip SHOT - QHarmony - De Ontzetting</h2>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor de Muzikale Roadtrip van SHOT, QHarmony en De Ontzetting! </h3>
            <h5>Helaas kunt u online geen toegangskaarten meer bestellen voor de Muzikale Roadtrip van SHOT, QHarmony en De Ontzetting,
            dat plaatsvindt op 4 december 2016 om 14:30 uur in De Junushoff te Wageningen. Kaarten zijn nog wel beschikbaar aan de deur.
            Toegangskaarten kosten daar &euro;7,50 per stuk.
			      </h5>
            <!--
			      <h5>U kunt hier toegangskaarten bestellen voor het samenwerkingsconcert van het Studenten Harmonie Orkest Twente, QHarmony en De Ontzetting,
                dat plaatsvindt op zondag 4 december om 14:30 uur in de Junushoff te Wageningen. Toegangskaarten kosten &euro;7,50 per stuk en kunnen online
                worden betaald. De kaarten die u besteld heeft, kunt u voorafgaand aan het concert ophalen bij de ingang van het theater.
                <br><br> Komt u van ver maar wilt u dit mooie concert niet missen? Wij bieden de mogelijkheid een NS Groepsretour ticket aan te schaffen.
                Hiermee kunt u van een willekeurig station opstappen richting station Ede-Wageningen. Vanaf station Ede-Wageningen kunt u de bus
                (lijn 84 of 88) nemen richting Wageningen (let op: dit zit niet inbegrepen in het NS Groepsretour!). Vanaf het busstation te Wageningen
                is het minder dan 10 minuten lopen naar de Junushoff. Dit ticket kost &euro;8,00 en is verkrijgbaar t/m 26 november 2016.
                Ook het NS Groepsretour kan online worden betaald.
                <br><br>Voor vragen naar aanleiding van de bestelprocedure van toegangskaarten voor het concert en de NS Groupsretours kunt u
                contact opnemen met: <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a><br><br>
            </h5>
            <h4>Vul hier uw gegevens in:</h4>
            <form class="form-horizontal" role="form" method="post" onsubmit="return confirmForm()" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="firstname">Voornaam:</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="firstname" required>
                    </div>
                    <label class="control-label col-sm-4" for="aantal_concert">Aantal toegangskaarten:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="aantal_concert" id="aantal_concert" onchange="confirmPrice()">
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
                    <label class="control-label col-sm-4" for="aantal_ns">Aantal NS Groepsretour tickets:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="aantal_ns" id="aantal_ns" onchange="confirmPrice()" disabled>
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
                        <input class="form-control" type="text" name="e-mail" id="email" required pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                    </div>
                    <label class="control-label col-sm-4" for="method">Prijs:</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text" name="price" id="price" required value="€7.50" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="e-mail2">E-mail ter controle:</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="e-mail2" id="email2" required pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}" onblur="confirmEmail()">
                        <div id="emailerror" style="color: red;"></div>
                        <div id="price_error" style="color: red;"></div>
                    </div>
                    <label class="control-label col-sm-3" for="method">Betaalmethode:</label>
                    <div class="col-sm-3">
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
          -->
        </div>
        <div class="col-md-3">
            <img src="http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg" alt="SHOT Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/QHarmony_Nijmegen.png" alt="QHarmony Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
            <img src="https://pbs.twimg.com/profile_images/2223593721/Sticker_button_Ontzetting_2008.jpg" alt="Ontzetting Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
        </div>
    </div>
</body>
</html>
