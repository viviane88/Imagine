<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="mon_compte.css">
    <title>ImAgIne.....</title>
</head>

<body>
    <h1>Inicier ou Créer mon compte</h1>
    <a class="fleche" href="imagine.php"><img src="fleche_retour.svg" alt="top fleche"></a>


    <hr class="my-4">


    <div class="container">
        <div class="initiation">
            <div class="row">

                <!-- box Rester connecté -->
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="mon_compte">
                        <form class="form-block ">
                            <input type="text" class="form-control mb-3 mr-sm-2" id="nom" placeholder="Votre Identifiant">
                            <input type="password" class="form-control mb-3 mr-sm-2" id="password" placeholder="Votre Mot de passe">

                            <div class="form-check mb-4 mr-sm-4">
                                <input class="form-check-input" type="checkbox" id="rester">
                                <label class="form-check-label" for="rester">
                                    Rester connecté
                                </label>
                            </div>
                            <button type="submit" class="btn btn-outline-info">Se connecter</button>
                        </form>
                    </div>
                </div>
                <!-- box nx client -->

                <div class="col-12 col-md-6 col-lg-4 mb-3 ml-5">
                    <div class="inscription ">
                        <form class="form-block">
                            <a class="form" href="formulaire.php">S'inscrire</a>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/8db063dd2b.js" crossorigin="anonymous"></script>

</body>

</html>