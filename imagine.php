<?php

/**
 * Je déclare mes deux variables avec des valeurs par défaut
 */
$offset = 0;
$limit = 9;

/**
 * Je vérifie si elles sont présente dans l'url dans ce cas je réecris les variables existantes
 */
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
}

// var_dump($_GET);

if(isset($_GET['search'])) {
    $search = $_GET['search'];
}
else{
    $search = 'nature';
}


/**
 * Je construis mon tableau d'image
 * en partant de la première image jusqu'à la limite nouvellement définie représentée par offset+limit
 * ex : Je passe de 0->9 images affichées par défaut à 0->20 images affichées après un premier chargement 
 */

$images = [];

for ($i = 0; $i < $offset + $limit; $i++) {
    $images[] = "https://loremflickr.com/400/400/{$search}?random=".rand(); 

}
// var_dump($images);
/**
 * Je définis qu'elle sera la première image a affichée
 * Soit la première image dans le cas du premier chargement (equivaut au 0)
 * Soit la dernière image chargée avant un nouveau chargement (equivaut à offset-1)
 */
$start = $offset - 1 > 0 ? $offset - 1 : 0;
 
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ImAgIne.....</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="imagine.css">


</head>

<body>
    <header>

        <!-- titre principal -->
        <h1 class="text-center  mt-5">ImAgIne.....</h1>


        <header>
            <!-- menu dropdown -->

            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light border border-black mb-3">

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="deroulant"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thèmes</a>

                        <div class="dropdown-menu" aria-labelledby="deroulant">

                            <a class="dropdown-item" href="#">Animaux</a>
                            <a class="dropdown-item" href="#">Sourire</a>
                            <a class="dropdown-item" href="#">Nature</a>
                            <a class="dropdown-item" href="#">Voyage</a>
                            <a class="dropdown-item" href="#">Art</a>
                            <a class="dropdown-item" href="#">Food</a>
                            <a class="dropdown-item" href="#">Sport</a>
                            <a class="dropdown-item" href="#">Black & White</a>

                        </div>

                    </div>
                    <!-- barre navigation -->

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="mon_compte.php">Mon Compte</a>
                            </li>
                        </ul>

                        <form class="form-inline my-2 my-lg-0 ">
                            <input class="form-control mr-sm-2 mr-auto" name="search" placeholder="Rechercher" 
                            aria-label="Rechercher">
                            <button class="btn btn-outline-info my-2 my-sm-0 mr-auto" type="submit"><i class="fa fa-search mr-1">
                                </i>Rechercher</button>
                        </form>
                    </div>

            </div>
        </header>

        <main>
            <div class="container">

                <div class="row">

                    <div class="row  p-5 ml-3">
                        <?php
                        /**
                         * Je boucle sur l'ensemble des images pour les afficher
                         */
                        $length = count($images);
                        $i = 0;
                        foreach ($images as $image) :
                        ?>
                            <div <?php
                            
                                    
                                    if ($i == $start) : ?>id="start" <?php endif;
                                                                        ?> class="mb-3">
                                                                        
                                <img class="rounded d-block mx-auto  p-2  img-fluid img-thumbnail p-3" src="<?= $image ?>">
                            </div>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8 offset-2 text-center">
                    <!--
					Le formulaire va se charger d'envoyer les champs offset et limit directement dans la barre d'adresse
				-->
                    <form action="imagine.php" method="get" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="offset" value="<?= $offset + $limit; ?>">
                        <label>Nombre d'images supplémentaires : </label>

                        <select name="limit">
                            <?php
                            /**
                             * Je recrée la liste de sélection avec la dernière limite sélectionnée par defaut
                             */
                            for ($i = 9; $i <= 99; $i += 9) :
                            ?>
                                <option value="<?= $i; ?>" <?php if ($limit == $i) : ?>selected="selected" <?php endif; ?>>
                                    <?= $i; ?>
                                </option>

                            <?php endfor;  ?>
                        </select>

                        <br />
                        <button type="submit" class="btn btn-outline-info">
                            Charger plus d'images
                        </button>

                        <br />
                        <br />

                        <!--ancre, top-->

                        <a class="fleche" href="#"><img src="fleche.svg" alt="top fleche"></a>
                    </form>
                </div>
            </div>
            </div>


        </main>



        <footer>
            <div class="container">
                <hr class="my-4">
                <p class="text-center  mt-5">Créer par...</p>
            </div>
        </footer>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

</html>