<?php
$mysqli=new mysqli('localhost','root','','bd_parfumerie');
$query='SELECT lm.nom_marque,ty.type_produit,p.nom_article,p.ingredients,p.photo FROM produit p inner join type_produit ty
 on ty.id_type_produit=p.id_type_produit inner join liste_marque lm on lm.id_marque=p.id_marque';

$result=$mysqli->query($query);
if($result!=null){
  $product=$result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Site meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Free Bootstrap 4 Ecommerce Template</title>
    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark margBot">
    <div class="container">
      <div class="collapse navbar-collapse justify-content-start">
          <img  style: height="50px" width="50px" src="img/logo.png" class="espace"/>

        <?php
          $requete = "SELECT `nom`, `prenom` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
          $resultat = $mysqli->query($requete);
          $val=$resultat->fetch_assoc();
          if($val == null)
          {
            echo'
              <div class="espace front_bar_nav navbar-collapse align-items-center">
                <img class="icon espace" src="IconesSite\user.png">
                  <a class="btn btn-secondary btn-number espace" href="ListeClients.php">
                    <i class="fa fa-sign-in" aria-hidden="true">
                      Voir les clients
                    </i>
                  </a>
              </div>
            ';
          }
          else
          {
            echo'
              <div class="espace">
                <a href="PageClient.php" class="navbar-brand bouton">
                  <img class="icon" src="IconesSite\user.png">
                    '.$val['nom'].' '.$val['prenom'].'
                </a>
                <a class="btn btn-secondary btn-number espace" href="ExeDecoClient.php">
                  <i class="fa fa-sign-out" aria-hidden="true">
                    Changer de client
                  </i>
                </a>
              </div>
            ';
          }
        ?>
      </div>
      <form method="get" action="RechercheProduit.php" class="collapse navbar-collapse justify-content-center widthSearch">
            <div class="input-group input-group-sm">
                <input type="text" id="Name" name="Name" class="form-control" placeholder="Chercher un produit par nom">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary btn-number" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
      <div class="collapse navbar-collapse justify-content-end">
          <div class="form-inline my-2 my-lg-0 espace" id="navbarsExampleDefault">
              <a class="btn btn-success btn-sm ml-3" href="Panier.php">
                      <i class="fa fa-shopping-cart"></i> Panier
                      <span class="badge badge-light">
                        <?php
                          $requete = "SELECT COUNT(id_article) AS nbArticles FROM `articles_commandes` NATURAL JOIN `commande` JOIN `client_actif` ON `id_client`=`id_client_actif` WHERE `etat_commande` = 'Current being processed'";
                          $resultat = $mysqli->query($requete);
                          $val=$resultat->fetch_assoc();
                          if($val == null)
                          {
                            echo'
                              0
                            ';
                          }
                          else
                          {
                            echo''.
                              $val['nbArticles'].'
                            ';
                          }
                        ?>
                      </span>
              </a>
          </div>
          <a class="btn btn-secondary btn-number" href="ExeDecoConcierge.php"> <!--Voir si on laisse decoUser ou si on met une autre page -->
            <i class="fa fa-sign-out" aria-hidden="true">
              Déconnexion
            </i>

          </a>
        </div>
      </div>
  </nav>

    <div class="container">
      <div class="collapse navbar-collapse justify-content-start">
        <?php
          $requete = "SELECT `nom`, `prenom` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
          $resultat = $mysqli->query($requete);
          $val=$resultat->fetch_assoc();
          if($val == null)
          {
            echo'
              <div class="espace front_bar_nav navbar-collapse align-items-center">
                <img class="icon espace" src="IconesSite\user.png">
                  <a class="btn btn-secondary btn-number espace" href="ListeClient.php">
                    <i class="fa fa-sign-in" aria-hidden="true">
                      Connecter client
                    </i>
                  </a>
              </div>
            ';
          }
          else
          {
            echo'
              <div class="espace">
                <a href="PageClient.php" class="navbar-brand bouton">
                  <img class="icon" src="IconesSite\user.png">
                    '.$val['nom'].' '.$val['prenom'].'
                </a>
                <a class="btn btn-secondary btn-number espace" href="ExeDecoClient.php">
                  <i class="fa fa-sign-out" aria-hidden="true">
                    Deconnecter client
                  </i>
                </a>
              </div>
            ';
          }
        ?>
      </div>
        <form class="collapse navbar-collapse justify-content-center widthSearch">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search a product">
                <div class="input-group-append">
                    <button onclick="window.location.href = 'RechercheProduit.php';" type="button" class="btn btn-secondary btn-number" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="collapse navbar-collapse justify-content-end">
          <div class="form-inline my-2 my-lg-0 espace" id="navbarsExampleDefault">
              <a class="btn btn-success btn-sm ml-3" href="cart.html">
                      <i class="fa fa-shopping-cart"></i> Panier
                      <span class="badge badge-light">
                        <?php
                          $requete = "SELECT COUNT(id_article) AS nbArticles FROM `articles_commandes` NATURAL JOIN `commande` JOIN `client_actif` ON `id_client`=`id_client_actif` WHERE `etat_commande` = 'Current being processed'";
                          $resultat = $mysqli->query($requete);
                          $val=$resultat->fetch_assoc();
                          if($val == null)
                          {
                            echo'
                              0
                            ';
                          }
                          else
                          {
                            echo''.
                              $val['nbArticles'].'
                            ';
                          }
                        ?>
                      </span>
              </a>
          </div>
          <a class="btn btn-secondary btn-number" href="ExeDecoConcierge.php"> <!--Voir si on laisse decoUser ou si on met une autre page -->
            <i class="fa fa-sign-out" aria-hidden="true">
              Deconnection
            </i>

          </a>
        </div>
      </div>
  </nav>




<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact us.
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="6" required></textarea>
                        </div>
                        <div class="mx-auto">
                        <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                <div class="card-body">
                    <p>3 rue des Champs Elysées</p>
                    <p>75008 PARIS</p>
                    <p>France</p>
                    <p>Email : email@example.com</p>
                    <p>Tel. +33 12 56 11 51 84</p>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="justify-content-start espaceGrand">
            <h5>Plan du site</h5>
            <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-50">
            <ul class="list-unstyled">
              <li class="interligne-2"><a href="">Liste des clients</a></li>
              <li class="interligne-2"><a href="">Liste Client</a></li>
              <li class="interligne-2"><a href="">Liste des commandes d'un client</a></li>
              <li class="interligne-2"><a href="InfoProduits.php">Information produit</a></li>
              <li class="interligne-2"><a href="">Information client</a></li>
              <li class="interligne-2"><a href="">Ajouter ou modifier un produit</a></li>
              <li class="interligne-2"><a href="AddModifClient.php">Ajouter ou modifier un client</a></li>
              <li class="interligne-2"><a href="">Recapitulatif de commande</a></li>
                    </ul>
        </div>

          <div class="justify-content-end">
          <h5>Contact</h5>
          <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-50">
          <ul class="list-unstyled">
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> AZHARI Abderrhaman</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> DRIDI Ghada</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> GOURAUD Lauriane</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> VALLÉE Lilian</li>
          </ul>
        </div>
        </div>
      </div>
    </footer>


<!-- JS -->
<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>
