<?php $this->title = "Récupération de mot de passe"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
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
                    <div class="form-group">
                        <label for="checkmail" class="col-lg-2 control-label">Verification email</label>
                        <div class="col-lg-10 desktop-form">
                        <input type="email" class="form-control" id="inputEmail" name="checkmail" placeholder="Email">
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
            <a href="../public/index.php" class="btn btn-info return">Retour</a>
        </section>