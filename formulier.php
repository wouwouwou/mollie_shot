<?php global $concert_title,
             $normal_price,
             $student_price,
             $concert_title,
             $concert_date,
             $concert_time,
             $student_group_discount,
             $student_group_discount_available,
             $student_group_discount_from_amount_of_students; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>QHarmony Meets SHOT | Kaartverkoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://shot.utwente.nl/templates/shaper_helix3/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function confirmForm() {
            var email = document.getElementById("email").value;
            var email2 = document.getElementById("email2").value;
            var aantal_concert = document.getElementById("aantal_concert").selectedIndex;
            var aantal_ns = document.getElementById("aantal_ns").selectedIndex;
            var aantal_st = document.getElementById("aantal_st").selectedIndex;
            var discount = 0.00;
            if (<?php echo $student_group_discount_available ? 'true' : 'false'; ?> &&
            aantal_st >= <?php print($student_group_discount_from_amount_of_students) ?>) {
                discount = (aantal_st * <?php printf("%.2f", $student_group_discount); ?>);
            }
            var price = (aantal_concert * <?php printf("%.2f", $normal_price);?>) +
                (aantal_st * <?php printf("%.2f", $student_price); ?>) -
                discount;
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
            var aantal_st = document.getElementById("aantal_st").selectedIndex;
            var discount = 0;
            if (<?php echo $student_group_discount_available ? 'true' : 'false'; ?> &&
            aantal_st >= <?php print($student_group_discount_from_amount_of_students) ?>) {
                discount = (aantal_st * <?php printf("%.2f", $student_group_discount); ?>);
            }
            var price = (aantal_concert * <?php printf("%.2f", $normal_price);?>) +
                (aantal_st * <?php printf("%.2f", $student_price); ?>) -
                discount;
            if (price <= 0) {
                document.getElementById("price_error").innerHTML="Selecteer ten minste 1 ticket!";
            } else {
                document.getElementById("price_error").innerHTML="";
            }
            document.getElementById("discount").value = "€" + discount.toFixed(2);
            document.getElementById("price").value = "€" + price.toFixed(2);
        }
    </script>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h2>Bestelformulier Toegangskaarten <br>
            QHarmony Meets SHOT | Kaartverkoop</h2>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3>Welkom op de bestelwebsite voor <?php print($concert_title); ?></h3>
            <h5>
            <?php if($currently_selling) { ?>
                U kunt hier toegangskaarten bestellen voor <?php print($concert_title); ?> van
                SHOT. Dit concert vindt plaats op <?php print($concert_date); ?> om <?php print($concert_time); ?> uur
                op de HAN (Kapittelweg 33) te Nijmegen. Toegangskaarten kosten
                &euro;<?php printf("%.2f", $normal_price);?> per stuk in de
                voorverkoop (studenten en vrienden: &euro;<?php printf("%.2f", $student_price); ?>) en kunnen online worden
                betaald. De kaarten die u besteld heeft, kunt u voorafgaand aan het concert ophalen bij de ingang.
                Het is ook  mogelijk om toegangskaarten aan de deur te verkrijgen. In het geval u gebruik maakt
                van het gereduceerde tarief, verzoeken wij u uw studentenkaart mee te nemen.
                <?php if($student_group_discount_available) { ?>
                    Bij een groepsgrootte van minstens <?php print($student_group_discount_from_amount_of_students) ?>
                    studenten geldt er een korting van &euro; <?php printf("%.2f", $student_group_discount);?>
                    op iedere aangekochte studenten-toegangskaart.
                <?php } else { ?>
                    Voor dit concert geldt geen groepskorting.
            <?php }
            } else { ?>
                Helaas kunt u online geen toegangskaarten meer bestellen voor <?php print($concert_title); ?>,
                dat plaatsvindt op <?php print($concert_date); ?> om <?php print($concert_time); ?> uur op de HAN (Kapittelweg 33)
                te Nijmegen. Kaarten zijn nog wel beschikbaar aan de deur.
                Toegangskaarten kosten daar
                &euro;<?php printf("%.2f", $normal_price);?> per stuk (student:
                &euro;<?php printf("%.2f", $student_price); ?>).
                <?php if($student_group_discount_available) { ?>
                    Bij een groepsgrootte van minstens <?php print($student_group_discount_from_amount_of_students) ?>
                    studenten geldt er een korting van &euro; <?php printf("%.2f", $student_group_discount);?>
                    op iedere aangekochte studenten-toegangskaart.
                <?php } else { ?>
                    Voor dit concert geldt geen groepskorting.
                <?php } ?>
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
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="e-mail2">E-mail ter controle:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="e-mail2" id="email2" required
                                   pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,6}" onblur="confirmEmail()">
                            <div id="emailerror" style="color: red;"></div>
                            <div id="price_error" style="color: red;"></div>
                        </div>
                        <label class="control-label col-sm-4" for="method">Groepskorting:</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="discount" id="discount" required
                                   value="€<?php printf("%.2f", $discount);?>"
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
                        <label class="control-label col-sm-4" for="method">Totaalprijs:</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="price" id="price" required
                                   value="€<?php printf("%.2f", $normal_price);?>"
                                   disabled>
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
            <img src="https://shot.utwente.nl/images/logos/1920px-SHOT_logo.png" alt="SHOT Logo"
                 style="width: 200px;" class="img-responsive img-rounded">
        </div>
    </div>
</div>
</body>
</html>
