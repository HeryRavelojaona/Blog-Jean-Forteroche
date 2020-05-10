<section id="contact">
    <h2>CONTACT</h2>
    <form class="form-horizontal" method="post" action="../public/index.php?route=contact">
        <fieldset>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10 desktop-form">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="mail" value="<?= isset($this->session) ? $this->session->get('mail') : ''; ?>">
                <span class="form-error"><?= isset($errors['mail']) ? $errors['mail'] : ''; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="pseudo" class="col-lg-2 control-label">Nom/pseudo</label>
                <div class="col-lg-10 desktop-form">
                <input type="text" class="form-control" id="pseudo" placeholder="Nom/pseudo" name="pseudo" value="<?= isset($this->session) ? $this->session->get('pseudo') : ''; ?>">
                <span class="form-error"><?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="col-lg-2 control-label">Message</label>
                <div class="col-lg-10 desktop-form">
                <textarea class="form-control 
                " rows="3" id="message" name="content"></textarea>
                </div>
                <span class="form-error"><?= isset($errors['content']) ? $errors['content'] : ''; ?></span>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2 desktop-form">
                <button type="reset" class="btn btn-danger">Effacer</button>
                <input type="submit" class="btn btn-perso" name="submit" value="Envoyer">
                </div>
            </div>
        </fieldset>
    </form>
</section>