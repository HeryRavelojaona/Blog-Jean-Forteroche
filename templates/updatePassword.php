<?php $this->title = "Modification du mot de passe"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
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