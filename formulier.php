<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SHOT-SOLO Concert | Kaartverkoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="jumbotron">
        <h2>Bestelformulier Toegangskaarten SHOT-SOLO Concert</h2>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor het SHOT-SOLO Concert! </h3>
            <h5>U kunt hier toeganskaarten bestellen voor het concert wat plaatsvindt op 10 april
            om 15:30 uur. De toegangskaarten zijn &euro;10,00 per stuk en kunnen hier all&eacute;&eacute;n worden afgerekend
            door middel van iDeal. Als u eenmaal de kaarten heeft besteld kunt u deze bij aankomst ophalen.<br><br></h5>
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
                        <select class="form-control" name="aantal">
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