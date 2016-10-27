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

        <h2 style="font-family: 'Times New Roman', Georgia, Serif;">Bestelformulier Toegangskaarten <br>
            Muzikale Roadtrip SHOT - QHarmony - De Ontzetting</h2>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">
            <img src="http://www.studentunion.utwente.nl/verenigingeninfo/fotos/shotlogo_final1.jpg" alt="SHOT Logo"
                 style="width: 200px;"class="img-responsive img-rounded">
        </div>
        <div class="col-md-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/QHarmony_Nijmegen.png" alt="QHarmony Logo"
                 style="width: 200px;"class="img-responsive img-rounded">
        </div>
        <div class="col-md-3">
            <img src="https://pbs.twimg.com/profile_images/2223593721/Sticker_button_Ontzetting_2008.jpg" alt="Ontzetting Logo"
                 style="width: 200px;"class="img-responsive img-rounded">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor de Muzikale Roadtrip van SHOT, QHarmony en De Ontzetting! </h3>
            <!--<h5>Helaas kunt u online geen toegangskaarten meer bestellen voor het lustrumconcert van SHOT en het SHOT oud-leden orkest, dat plaatsvindt op 10 april
				om 15:30 uur in het Muziekcentrum te Enschede. Kaarten zijn nog wel beschikbaar aan de deur. Toegangskaarten kosten daar &euro;10,00 per stuk.
			</h5>
			-->
			<h5>U kunt hier toegangskaarten bestellen voor het samenwerkingsconcert van Studenten Harmonie Orkest Twente, QHarmony en De Ontzetting, dat plaatsvindt op zondag 4 december
                om 14:30 uur in het Theater Junushoff te Wageningen. Toegangskaarten kosten &euro;7,50 per stuk en kunnen betaald worden met behulp van iDeal.
                De kaarten die u besteld heeft kunt u voorafgaand aan het concert ophalen bij de ingang van het theater.<br><br>
                Komt u van ver maar wilt u dit mooie concert niet missen? Wij bieden de mogelijkheid een NS Groepsretour ticket aan te schaffen.
                Hiermee kunt u van een willekeurig station opstappen richting station Ede-Wageningen. Vanaf station Ede-Wageningen kunt u de bus nemen richting Wageningen, busstation.
                Vanaf dit busstation is het minder dan 10 minuten lopen naar Theater Junushoff. Dit ticket kost &euro;8,00. Als u hier gebruik van wilt maken kunt u een mail met het aantal
                gewenste NS tickets sturen naar: <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a>, dan krijgt u hierop
                een bevestigingsmail met verdere betalingsinstructies en een instructie om uw ticket te downloaden.<br><br>
                Voor vragen ten aanzien van de bestelprocedure van toegangskaarten voor het concert kunt u
                contact opnemen met: <a href="mailto:kaartverkoop@shot.utwente.nl">kaartverkoop@shot.utwente.nl</a><br><br>
            </h5>
            <h4>Vul hier uw gegevens in:</h4>
        </div>
    </div>


    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">

            <div class="col-md-4">
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
            </div>
            <div class="col-md-4">
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
                <div class="col-md-12"
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Bestellen en betalen via iDeal</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmEmail() {
        var email = document.getElementById("email").value;
        var email2 = document.getElementById("email2").value;
        if(email != email2) {
            alert('De ingevoerde e-mail adressen zijn niet gelijk aan elkaar!');
			return false;
        }
    }
	function confirmEmail2() {
        var email = document.getElementById("email").value;
        var email2 = document.getElementById("email2").value;
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