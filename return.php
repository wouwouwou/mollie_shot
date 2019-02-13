<?php require "returncode.php"?>
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
    <title>Jubileumconcert | Kaartverkoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h2>Toegangskaarten <br>
            Jubileumconcert | SHOT</h2>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Uw bestelling is voltooid!</h3>
            <h5>
                <?php if($ns_retour_possible) { ?>
                    Er is een e-mail naar u verstuurd met daarin uw gegevens. De toegangskaarten kunt u voor aanvang van het concert afhalen
                    op de concertlocatie en staan op uw naam. De NS Groupretours worden op een later moment verwerkt en
                    uiterlijk één week voor het concert per e-mail naar u toegezonden.<br><br>
                <?php } else { ?>
                    Er is een e-mail naar u verstuurd met daarin uw gegevens. De toegangskaarten kunt u voor aanvang van het concert
                    afhalen op de concertlocatie en staan op uw naam. <br><br>
                <?php } ?>
				Indien u binnen enkele minuten geen e-mail ontvangen heeft, of heeft u een andere vraag, neem dan contact met ons
                op via <a href='mailto:kaartverkoop@shot.utwente.nl'>kaartverkoop@shot.utwente.nl</a> of kijk op
                <a href='https://www.shot.utwente.nl' target="_blank">www.shot.utwente.nl</a>
            </h5>
        </div>
        <div class="col-md-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/SHOT_logo.png" alt="SHOT Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
        </div>
    </div>
</div>
</body>
</html>