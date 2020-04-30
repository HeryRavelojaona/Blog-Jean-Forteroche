<?php $this->title = 'Ajouter un article'; ?> 
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
                            <li><a href="../public/index.php?route=administration">Administration</a></li>
                            <li><a href="../public/index.php?route=profile">Profil</a></li>
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
        <section id="description">
            <p>Création d'un nouvel article</p>
        </section>
        <section class="container">
            <div class="row">
                <div class="bloc-content col-md-12">
                    <form class="form-billet form-group" action="../public/index.php?route=addarticle" method="post">
                        <input type="hidden" name="user_id" value="<?= $this->session->get('id'); ?>" >  
                        <label for="title" class="title-form">Titre</label>
                        <input type="text" name="title" placeholder="Titre" class="title-billet form-control">
                        <span class="form-error"><?= isset($errors['title']) ? $errors['title']: ''; ?></span>
                        <label for="content" class="title-form">Billet</label>
                        <textarea name="content" class="billet form-control " ></textarea>
                        <span class="form-error"><?= isset($errors['content']) ? $errors['content']: ''; ?></span>
                    <div class="row">
                        <input type="submit" class="btn btn-warning col-md-6 " name="save" id="save" value="Enregistrer">
                        <input type="submit" class="btn  col-md-6 " name="submit" id="submit" value="Publier">
                    </div>
                        <button type="reset" class="btn btn-danger delete" >Effacer</button>
                        
                    </form>
                </div>
                <a href="../public/index.php?route=administration" class="btn btn-info return">Retour</a>
            </div>
        </section>