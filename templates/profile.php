<?php $this->title = "Profil"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="../public/images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
            <?= $this->session->show('not_admin'); ?>
                <h1>Billet simple<br>pour l'Alaska</h1> 
            </div>   
        </section>
        <section id="content" class="container" >
            <div class="row">
                <div class="bloc-content col-md-12 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet">Pseudo: <?= $this->session->get('pseudo'); ?></h3>
                        <p class="billet">Role: <?= $this->session->get('role'); ?>
                        <p class="billet">Email: <?= $this->session->get('mail'); ?>
                        </p>
                        <a href="../public/index.php?route=updatePassword" class="btn btn-warning">Modifier votre mot de passe</a><br/>
                        <div class="control-delete">
                            <button class="check-delete btn-danger">Supprimer votre compte</button>
                            <p class="go-delete">Etes vous sur ?</p>
                            <a href="../public/index.php?route=deleteAccount" class="go-delete btn btn-warning">Oui</a>
                            <button class="go-delete stop-delete btn btn-secondary">Non</button>
                        </div>
                    </div>
                </div>
                <a href="../public/index.php" class="btn btn-info return">Retour</a>
            </div>  
        </section>
        <?php include ('contact.php'); ?>
    