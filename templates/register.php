<?php $this->title = "Inscription"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
                <h1>Billet simple<br>pour l'Alaska</h1>
            </div>   
        </section>
        <section id="description">
            <p>Inscrivez-vous pour faire partie ma communauté</p>
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
            <a href="../public/index.php" class="btn btn-info return">Retour</a>
        </section>
        <?php include ('contact.php'); ?>