<?php $this->title = "Récupération de mot de passe"; ?>
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
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=register">S'inscrire</a></li>
                            <li><a href="../public/index.php?route=login">Connexion</a></li>
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
            <form class="form-horizontal connexion all-forms" method="post" action="../public/index.php?route=forgotpass">
                <fieldset>
                    <legend>Récupération de mot de passe</legend>
                    <div class="form-group">
                        <label for="mail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="email" class="form-control" id="inputEmail" name="mail" placeholder="Email">
                        <span class="form-error"><?= isset($errors) ? $errors : ''; ?></span>
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