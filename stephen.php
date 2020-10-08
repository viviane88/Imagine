<?php

    $value = rand(1,4);

    /*
    *Variable pour la recherche d'images par mots clés
    */
    $search = "";


    $position = 0;
    $limit = 9;


    /*
    * vérifié la présence des variables dans l'url
    */

    if(isset($_GET['position'])) {
		$offset = $_GET['position']; 
	}
	if(isset($_GET['limit'])) {
		$limit = $_GET['limit']; 
    }

    $images = [];
	for($i = 0; $i < $position+$limit; $i++) {
       
            $images[] = "<img src='https://loremflickr.com/320/240/{$search}' />";
        
	}
    

    $start=$position-1 > 0 ? $position-1 : 0;
    
    /*
    * vérifié que la variable pour le mot clé de recherche est présent
    */
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    session_start();

    if(isset($_GET['logout'])) {
        session_unset();
        session_destroy();
    }
    
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application d'inspiration</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

    <!--navbar-->
    <nav class="navbar navbar-light bg-light border-bottom">
        <?php
            if(isset($_SESSION['user']) && isset($_SESSION['mail']) ){
                echo "<a class=\"navbar-brand\">Bienvenue {$_SESSION['user']}</a>";
                echo '<a class="navbar-brand mr-sm-2 "  href="logout.php?logout">Déconnexion</a>';
                if($_SESSION['level'] == '2'){
                    echo '<a class="navbar-brand mr-sm-2 "  href="logout.php?logout">Test</a>';
                }  
            }
            else{
                echo '<a class="navbar-brand mr-sm-2 "  href="connexion.php">Connexion</a>';
            }
          var_dump($_SESSION['level'] );
        ?>
    </nav>

    <!-- Titre -->

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div>
                        <h1>Inspiration d'images</h1>
                        <p>La banque d'images d'inspirations</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- les images -->

    <section>
        <div class="container border-bottom">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-light bg-light">
                                <form class="form-inline" action="stephen.php" method="get" enctype="application/x-www-form-urlencoded">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" value="Nature" name="search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 align-items-end" type="submit">Search</button>
                                    <div>
                                        <select class="custom-select my-1 mr-sm-2" name="limit">
                                            <?php 
                                                for($i =9; $i <= 100; $i+=9): ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?> images</option>
                                            <?php endfor; ?><br/>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-large" id="loadMore"> Charger plus dimages</button>
                                    </div>
                                </form>
                            </nav>
                        </div>    
                    </div>    

                    <?php
                    $length = count($images);
				  $i = 0;
                  foreach($images as $image):
                    ?>

                    <div class="container">
                    <div class="row ">
                        <div class="row  p-5 ml-3">
                            <?php
                                if(isset($_GET['search'])){

                                    echo "<img src='https://loremflickr.com/320/240/{$search}?random=1' />";
                                }   
                               
                                
                            ?>
                        </div>
                   
                           
                        </div>   
                        </div>         
                    </div> 
                    <?php 
					$i++;
					endforeach; 
				?>           
                    </div>  
                </div>         
            </div>
        </div>    
    </section>

    <!-- inscription -->

    <section>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <div>
                        <?php
                            if(!isset($_SESSION['user'])){
                                echo '<h2>Vous voulez plus d\'imagination ?</h2>';
                                echo '<p>il suffit de vous inscrire</p>';
                                echo '<a href="inscription.php"><button type="button" class="btn btn-primary">Inscription</button></a>';
                            }
                        ?>
                    </div>
                </div>   
            </div>    
        </div>    
    </section>

    <!--footer-->

    <footer>
        <div class="container mt-5 text-center">
            <div class="row">
                <div class="col-md-12">
                    <p>© By Maguette & Stephen 2020
                </div>   
            </div>
        </div>    
    </footer>    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>