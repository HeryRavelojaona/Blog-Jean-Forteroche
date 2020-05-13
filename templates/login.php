<?php $this->title = "Connexion"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="../public/images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
                <?= $this->session->show('update_password'); ?>
                <?= $this->session->show('validate'); ?>
                <?= $this->session->show('not_login'); ?>
                <h1>Billet simple<br>pour l'Alaska</h1> 
                <h2 >Bienvenue sur la page de connexion</h2>    
            </div>   
        </section>
        <section class="login-part container">
            <form class="form-horizontal connexion all-forms" method="post" action="../public/index.php?route=login">
                <fieldset>
                    <legend class="title-connexion">Connexion</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="email" class="form-control" id="inputEmail" name="mail" placeholder="Email">
                        <span class="form-error"><?= isset($errors) ? $errors: ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="col-lg-2 control-label">Mot de passe</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        <span class="form-error"><?= isset($errors) ? $errors: ''; ?></span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-10 col-lg-offset-2 button-submit desktop-form">
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <input type="submit" name="submit" class="btn btn-perso" value="Soumettre">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-10 col-lg-offset-2 btnPass">
                            <a href="../public/index.php?route=forgotpass" class="btn btn-warning btn-sm" id="forgot_pass"name="forgotPass">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </fieldset>
            </form>
            <a href="../public/index.php" class="btn btn-info return">Retour</a>
        </section>
        <?php include ('contact.php'); ?>