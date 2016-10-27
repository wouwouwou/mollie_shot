<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Muzikale Roadtrip SHOT - QHarmony - De Ontzetting | Kaartverkoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="jumbotron">
        p {
        font-family: "Times New Roman", Georgia, Serif;
        }
        <p class="serif"></p><h2>Bestelformulier Toegangskaarten
            Muzikale Roadtrip SHOT - QHarmony - De Ontzetting</h2></p>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor de Muzikale Roadtrip van SHOT, QHarmony en De Ontzetting! </h3>
            <!--<h5>Helaas kunt u online geen toegangskaarten meer bestellen voor het lustrumconcert van SHOT en het SHOT oud-leden orkest, dat plaatsvindt op 10 april
				om 15:30 uur in het Muziekcentrum te Enschede. Kaarten zijn nog wel beschikbaar aan de deur. Toegangskaarten kosten daar &euro;10,00 per stuk.
			</h5>
			-->
			<h5>U kunt hier toegangskaarten bestellen voor het lustrumconcert van SHOT en het SHOT oud-leden orkest, dat plaatsvindt op zondag 4 december
                om 14:30 uur in het Muziekcentrum te Enschede. Toegangskaarten kosten &euro;10,00 per stuk en kunnen betaald worden met behulp van iDeal.
                De kaarten die u besteld heeft kunt u voorafgaand aan het concert ophalen bij de ingang van het Muziekcentrum.<br><br>
                Komt u van ver maar wilt u dit mooie concert niet missen? SHOT biedt de mogelijkheid een NS Groepsretour ticket aan te schaffen.
                Hiermee kunt u van een willekeurig station opstappen richting Enschede. Vanaf station Enschede centraal is het minder dan 5
                minuten lopen naar het Wilmink Theater. Dit ticket kost &euro;8,00. Als u hier gebruik van wilt maken kunt u een mail met het aantal
                gewenste NS tickets sturen naar: <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a>, dan krijgt u hierop
                een bevestigingsmail met verdere betalingsinstructies en een instructie om uw ticket te downloaden.<br><br>
                Voor vragen ten aanzien van de bestelprocedure van toegangskaarten voor het lustrumconcert van SHOT en het SHOT oud-leden orkest kunt u
                contact opnemen met: <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a><br><br>
            </h5>
            <h4>Vul hier uw gegevens in:</h4>
        </div>

        <div class="col-md-3">
            <img src="http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg" alt="SHOT Logo"
                 style="width: 400px;"class="img-responsive img-rounded">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post" onsubmit="return confirmEmail()" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="firstname">Voornaam:</label>
                    <div class="col-sm-4">
                            <input class="form-control" type="text" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="lastname">Achternaam:</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="e-mail">E-mail:</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="e-mail" id="email" required pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-sm-4" for="e-mail2">E-mail ter controle:</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="e-mail2" id="email2" required pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}" onblur="confirmEmail2()"> <div id="error" style="color: red;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="aantal">Aantal toegangskaarten:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="aantal_concert">
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
                <label class="control-label col-sm-4" for="aantal">Aantal NS Groepsretour tickets:</label>
                <div class="col-sm-2">
                    <select class="form-control" name="aantal_ns">
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
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Bestellen en betalen via iDeal</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <img src="https://scontent-ams3-1.xx.fbcdn.net/hphotos-xal1/v/t1.0-9/12524019_727132620719875_4573466835668056095_n.jpg?oh=bf34c1da84feaae697136192ded0b216&oe=57247F21"
                 alt="SOLO Logo" style="width: 400px;"class="img-responsive img-rounded">
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmEmail() {
        var email = document.getElementById("email").value
        var email2 = document.getElementById("email2").value
        if(email != email2) {
            alert('De ingevoerde e-mail adressen zijn niet gelijk aan elkaar!');
			return false;
        }
    }
	function confirmEmail2() {
        var email = document.getElementById("email").value
        var email2 = document.getElementById("email2").value
        if(email != email2) {
            document.getElementById('error').innerHTML="Dit e-mail adres is niet hetzelfde!";
        }
		if(email == email2) {
			document.getElementById('error').innerHTML="";
		}
    }
</script>

</body>
</html>