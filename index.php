<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <!--CDN bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Script google reCAPTCHA rechargement différé -->
    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LdGbTUpAAAAAE4Leefo1Zqo9DikcezmXoJDnVeg'
        });
      };
    </script>
</head>
<body>
    <div class="container py-5">
        <h2 class="text text-center text-primary mb-3">Formulaire</h2>

        <form action="mail.php" method="post" id="contact-form">
            <div class="row">
                <div class="form-floating mb-3 col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="name *" name="name" autocomplete="on">
                    <label for="name">Nom</label>
                </div>
                <div class="form-floating mb-3 col-sm-6">
                    <input type="email" class="form-control" id="email" placeholder="email" name="email" autocomplete="on">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3 col-sm-6">
                    <input type="tel" class="form-control" id="phone" placeholder="phone *" name="phone" autocomplete="on">
                    <label for="phone">Phone</label>
                </div>
                <div class="form-floating mb-3 col-sm-6">
                    <input type="text" class="form-control" id="city" placeholder="city" name="city" autocomplete="on">
                    <label for="city">City</label>
                </div>
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="message" rows="4" placeholder="Message ..." name="message" autocomplete="on"></textarea>
            </div>

            <div class="py-5">
                <div id="html_element"></div>
                <br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="conditions" name="conditions">
                    <label class="form-check-label" for="conditions">En soumettant ce formulaire, j'accepte que mes données personnelles soient utilisées pour me recontacter dans le cadre de ma demande indiquée dans ce formulaire. Aucun autre traitement ne sera effectué avec mes informations.</label>
                    </div>
                </div>
           
            <div class="row">
                <input type="submit" value="Envoyer" class="btn btn-danger col-3 d-block mx-auto">
            </div>
            <div class="col-sm-6 mx-auto text-center py-3" id="result-container">

            </div>
        </form>
    </div>
    
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="mail.js"></script>
</body>
</html>