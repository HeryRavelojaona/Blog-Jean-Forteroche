<?php $this->title = "Profil"; ?>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="default.html">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" href="../public/index.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown  active">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Votre espace</a>
                            <ul class="dropdown-menu" role="menu">
                    <?php if($this->session->get('role') === 'admin') { ?>
                            <li><a href="../public/index.php?route=administration">Administration</a></li>
                    <?php } ?>
                            <li><a href="../public/index.php?route=logout">Déconnexion</a></li>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <section id="header_img">
            <img src="../public/images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
                <h1>Billet simple<br>pour l'Alaska</h1> 
            </div>   
        </section>
        <section id="content" class="container" >
            <div class="row">
                <div class="bloc-content col-md-12 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet">Pseudo: <?= $this->session->get('pseudo'); ?></h3>
                        <p class="billet">Identifiant: <?= $this->session->get('id'); ?><br/>
                        <p class="billet">Role: <?= $this->session->get('role'); ?>
                        <p class="billet">Email: <?= $this->session->get('mail'); ?>
                        </p>
                        <a href="../public/index.php?route=updatePassword">Modifier votre mot de passe</a><br/>
                        <a href="../public/index.php?route=deleteAccount">Supprimer votre compte</a>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    