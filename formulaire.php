<?php
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

$erreur = null;

if (isset($_POST['contact'])) {

    //si rgpd a été coché
    if (isset($_POST['rgpd']) && $_POST['rgpd'] == '1') {

        if (
            !empty($_POST['optradio'])
            && !empty($_POST['nom'])
            && !empty($_POST['prenom'])
            && !empty($_POST['email'])
            && !empty($_POST['mot_de_passe'])
        ) {
            var_dump('bravo');
            //c'est ici que j'insère l'utilisateur ds la Base de données et je 
            //peux faire une redirection vers le formulaire de connexion OU 
            //vers un fichier de confirmation (header location, exo Aurélien)

        } else {
            $erreur = 'Veuillez remplir tous les champs';
        }
    } else {
        $erreur = 'Veuillez accepter la rgpd';
    }
}

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="formulaire.css">
    <title>ImAgIne.....</title>
</head>

<body>

    <form action="formulaire.php" method="post" enctype="application/x-www-form-urlencoded">

        <?php if ($erreur !== null) : ?>
            Erreur : <?php echo $erreur ?>
        <?php endif; ?>

        <head>

            <h1>S'inscrire</h1>
            <a class="fleche" href="imagine.php"><img src="fleche_retour.svg" alt="top fleche"></a>

            <hr class="my-4">


            <div class="container my-3">

        </head>
        <main>
            <p class="my-5 p-3"><ins><strong>Merci de remplir tous les champs:</strong></ins></p>

            <div class="border border-info p-5">
                <!-- formulaire -->
                <form>

                    <div class="form-row">

                        <div class="col-md-6">
                            <!--civilité input -->
                            <div class="md-form form-group">
                                <p class="my-2 p-1 font-italic">Civilité:</p>
                                <label for="radio_inline_mr pr-2">Monsieur</label>
                                <input type="radio" id="m" name="optradio" value="1" required />
                                <label for="radio_inline_mdm">Madame</label>
                                <input type="radio" id="mme" name="optradio" value="0" required />

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <!-- input prenom -->
                            <div class="md-form form-group font-italic">
                                <label for="prénom">Votre Prénom:</label>
                                <input type="text" class="form-control" id="prénom" name="prenom" placeholder="Entrez votre prénom" value="" required />
                            </div>
                        </div>

                        <!-- input nom -->
                        <div class="col-md-12">

                            <div class="md-form form-group font-italic">
                                <label for="nom">Nom:</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" value="" required />
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6">
                            <!-- email input -->
                            <div class="md-form form-group font-italic">
                                <label for="email">Votre Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email" value="" required />
                            </div>
                        </div>


                        <div class="col-md-6">

                            <!-- input mot de passe -->

                            <div class="md-form form-group font-italic pb-3">
                                <label for="mot_de_passe">Mot de passe:</label>
                                <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="Entrez votre Mot de Passe" value="" required />
                            </div>
                        </div>


                        <!-- Dropdown+checkbox -->


                        <div class="dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="deroulant" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Comment nous avez-vous connu ? </a>

                            <div class="dropdown-menu" aria-labelledby="boutonMenu">
                                <ul>
                                    <li><label><input type="checkbox" value="1"> Moteurs de recherche</label></li>
                                    <li><label><input type="checkbox" value="2"> Bouche à oreille</label></li>
                                    <li><label><input type="checkbox" value="3"> Publicité</label></li>
                                    <li><label><input type="checkbox" value="4"> Réseaux sociaux</label></li>
                                </ul>
                            </div>
                        </div>


                        <!-- bouton  Round switch -->
                        <div>
                            <label class="switch">
                                <input type="checkbox" name="rgpd" value="1" id="rgpd" required>
                                <span class="slider round"></span>
                            </label>
                            <p class="font-italic">“En soumettant ce formulaire j’accepte que mes informations soient
                                utilisées dans le cadre de l’utilisation normale du service et de la relation commerciale”
                            </p>
                        </div>


                        <!-- bouton inscription -->
                        <button type="submit" name="contact" class="btn btn-outline-info ">Inscription</button>


                </form>
            </div>

            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    </form>
    </main>

</body>

</html>