<?php
session_start();
if(empty($_SESSION['auth']) || !isset($_GET['id']) || empty($_GET['id'])){
    header("Location: .");
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link href="css/bootstrap.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

    <script src="js/bootstrap.bundle.js"></script>

    <style type="text/css">
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        p.blocktext {
            margin-left: auto;
            margin-right: auto;
            width: 18em;

        }
    </style>
</head>

<body>
    <h1 style="text-align: center;"><strong>Bon de réservation</strong></h1>
    <div class="container" style="margin-top:5%;">

        <div id="qrcode" style="display:block; margin-right: auto;margin-right: auto;"></div>

        <div id="content" style="display:block; margin-right: auto;margin-right: auto;margin-top: 3%;">
        </div>

        <div class="row mb-4" style="margin-top:17%;margin-left: auto;margin-right: auto;width: 70px;">
            <input type="button" value="Retour" class="btn btn-secondary" onclick="javascript:history.back()">
        </div>


    </div>
</body>

</html>
<script type="text/javascript" src="js/qrcode.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 250,
            height: 250
        });

        var idTicket = <?= $_GET['id'] ?>;
        var qrCodeContent;

        $.ajax({
            url: "requetes/getTicketById.php",
            method: "GET",
            data: { idTicket: idTicket },
            dataType: "json",
            success: function (ticket) {
                qrCodeContent = '{"idTicket": ' + ticket[0].idTicket + '}';
                qrcode.makeCode(qrCodeContent);

                prix = Number.parseFloat(ticket[0].prix).toFixed(2);
                quant = ticket[0].quant;
                total = Number.parseFloat(quant * prix).toFixed(2);

                contenu = "Film : " + ticket[0].titleMovie + "<br>"
                    + "Séance : " + ticket[0].dateSession + " - " + ticket[0].timeSession + "<br>"
                    + "Info de prix : " + quant + " x ticket(s) " + ticket[0].namePrix + " (" + prix + "€)<br>"
                    + "Total : " + total + "€"

                $("<p class='blocktext'>" + contenu + "</p>").appendTo("#content");

            }
        });



    });


</script>