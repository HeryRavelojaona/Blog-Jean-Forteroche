
<?php $this->title = "Accueil"; ?>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="../public/index.php">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="../public/index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
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
                <?= $this->session->show('register'); ?>
                <?= $this->session->show('login'); ?>
                <?= $this->session->show('logout'); ?>
                <?= $this->session->show('update_password'); ?>
                <?= $this->session->show('mailforgot'); ?>
                <?= $this->session->show('delete_account'); ?>
                <?= $this->session->show('validate'); ?>
                <?= $this->session->show('flag'); ?>
                <?= $this->session->show('contact'); ?>
                <h1>Billet simple<br>pour l'Alaska</h1>
            </div>   
        </section>
        <section id="description">
            <p>
                Jean Forteroche, acteur et écrivain. J'ai décidé d'innover en vous présentant mon nouveau livre épisodes par épisodes
                lement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour
                ljdzljdzln</p>
            
        </section>
        <section id="content" class="container" >

            <div class="row">
            <?php
                foreach ($articles as $article)
                {
            ?>
                <div class="bloc-content col-md-6 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet"><?= htmlspecialchars($article->getTitle());?> <span class="date">Créé le: <?= htmlspecialchars($article->getCreatedAt());?></span></h3>
                        <p class="billet"><?= substr(htmlspecialchars($article->getContent()),0, 500);?></p>
                        <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>">Lire la suite...
                            <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>
            <?php
                }
            ?>  
            </div>
        </section>
        <div class="page">
            <ul class="pagination">
                <li class="disabled"><a href="../public/index.php?page=<?= htmlspecialchars($currentPage - 1) ;?>">&laquo;</a></li>
            <?php
               for($i=1; $i<=$nbPage; $i++){
                   echo '<li><a href="../public/index.php?page='.$i.'">'.$i.'</a></li>';
                }
            ?>
                <li><a href="../public/index.php?page=<?= htmlspecialchars($currentPage + 1) ;?>">&raquo;</a></li>
            </ul>
        </div>
        <!--Include form contact-->
        <?php include ('contact.php'); ?>

