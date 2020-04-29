<?php $this->title = "Inscription"; ?>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="../public/index.php">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" href="../public/index.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link active" data-toggle="dropdown" role="button" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=login">Connexion</a></li>
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
        <section id="description">
            <p>HellozdzdLe Lorem Ipsum est simp
                lement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour
                ljdzljdzln</p>
        </section>
<section class="login-part container">
            <form class="form-horizontal connexion all-forms" method="post" action="../public/index.php?route=register" >
                <fieldset>
                    <legend>Nouvel utilisateur </legend>
                    <div class="form-group">
                        <label for="pseudo" class="col-lg-2 control-label">Pseudo</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')): ''; ?>" placeholder="Pseudo">
                            <span class="form-error"><?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="email" class="form-control" id="inputEmail" name="mail" value="<?= isset($post) ? htmlspecialchars($post->get('mail')): ''; ?>" placeholder="Email">
                            <span class="form-error"><?= isset($errors['mail']) ? $errors['mail'] : ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Mot de passe</label>
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
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2 button-submit desktop-form">
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <input type="submit" class="btn btn-perso" name="submit" value="Valider">
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>