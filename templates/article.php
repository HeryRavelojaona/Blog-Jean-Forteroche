<?php $this->title = "Article"; ?>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="default.html">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="../public/index.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                <?php
                    if($this->session->get('pseudo'))
                    {
                ?>
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Votre espace</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=profile">Profil</a></li>
                    <?php if($this->session->get('role') === 'admin') { ?>
                            <li><a href="../public/index.php?route=administration">Administration</a></li>
                    <?php } ?>
                            <li><a href="../public/index.php?route=logout">Déconnexion</a></li>
                <?php 
                    }else{ 
                ?>
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=register">S'inscrire</a></li>
                            <li><a href="../public/index.php?route=login">Connexion</a></li>        
                <?php 
                } 
                ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
                <h1>Billet simple<br>pour l'Alaska</h1>
            </div>   
        </section>
        <section id="content" class="container" >
             
            <div class="row">
                <div class="bloc-content col-md-12 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet"><?= htmlspecialchars($article->getTitle());?>  <span class="date">Créé le: <?= htmlspecialchars($article->getCreatedAt());?></span></h3>
                        <p class="billet"><?= htmlspecialchars($article->getContent());?></p>
                     
                            <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>
                <?php
            if($this->session->get('role')==="admin")
            {
        ?>
         <a href="../public/index.php?route=administration" class="btn btn-info return">Retour</a>
        <?php 
            } else {
        ?>
        <a href="../public/index.php" class="btn btn-info return">Retour</a>
        <?php 
            } 
        ?>
            </div>
        </section>
        
