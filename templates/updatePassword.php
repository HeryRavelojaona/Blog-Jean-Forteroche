<?php $this->title = "Modification du mot de passe"; ?>
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
        <section class="login-part container">
            <form class="form-horizontal connexion all-forms" method="post" action="../public/index.php?route=updatePassword">
                <fieldset>
                    <legend class="title-connexion">Le mot de passe de <?= $this->session->get('pseudo') ; ?> sera modifié</legend>
                    <div class="form-group">
                        <label for="pass" class="col-lg-2 control-label">Nouveau mot de passe</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        <span class="form-error"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="samePassword" class="col-lg-2 control-label">Vérification mot de passe</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="password" class="form-control" id="checkPass" name="samePassword" placeholder="Vérification mot de passe">
                            <span class="form-error"><?= isset($errors['samePassword']) ? $errors['samePassword'] : ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-10 col-lg-offset-2 button-submit desktop-form">
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <input type="submit" name="submit" class="btn btn-perso" value="Soumettre">
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>