<?php $this->title = 'Ajouter un article'; ?> 
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
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
                        <label for="title" class="title-form">Titre</label>
                        <input type="text" name="title" value="<?= isset($post) ? $post->get('title') : '' ?>" class="title-billet-add form-control">
                        <span class="form-error"><?= isset($errors['title']) ? $errors['title']: ''; ?></span>
                        <label for="content" class="title-form">Billet</label>
                        <textarea id="admintext" name="content" class="billet form-control "><?= isset($post) ? $post->get('content') : '' ?></textarea>
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