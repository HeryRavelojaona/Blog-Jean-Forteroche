
<?php $this->title = "Accueil"; ?>
        <!--Include form navbar-->
        <?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest" alt="Livre"/>
            <div class='caption'>
                <?= $this->session->show('register'); ?>
                <?= $this->session->show('login'); ?>
                <?= $this->session->show('logout'); ?>
                <?= $this->session->show('update_password'); ?>
                <?= $this->session->show('mailforgot'); ?>
                <?= $this->session->show('delete_account'); ?>
                <?= $this->session->show('validate'); ?>
                <?= $this->session->show('flag'); ?>
                <?= $this->session->show('contact'); ?>
                <h1>Billet simple<br>pour l'Alaska</h1>
            </div>   
        </section>
        <section id="description">
            <p>Né à Paris au lendemain de la guerre, Jean Forteroche emprunte des chemins détournés pour arriver à l’écriture.
                Il exerce différents métiers avant de partir pour le sud de la France.
                Trente ans plus tard, il revient à ses origines et s’installe définitivement dans la capitale pour y écrire.
                Acteur et écrivain Jean Forteroche décide d'innover en vous présentant son livre <strong>"Billet simple pour l'Alaska"</strong> épisodes par épisodes.</p>
        </section>
        <section id="bloc-articles" class="container" >
             <h2 class="home-h2">Derniers épisodes</h2>
            <div class="row">
            <?php
                foreach ($articles as $article)
                {
            ?>
                <div class="bloc-content col-md-6 " >
                    <div class="bloc-billets">
                    <?php $date = new Datetime($article->getCreatedAt()); ?>
                        <h3 class="title-billet"><?= $article->getTitle();?><br/> <span class="date">Créé le: <?= htmlspecialchars($date->format('d-m-Y H:i:s'));?></span></h3>
                        <div class="billet extrait"><p><?= $article->getContent();?></p></div>
                        <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>">Lire la suite...
                            <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>
            <?php
                }
            ?>  
            </div>
        </section>
        <div class="page">
            <ul class="pagination">
                <li class="disabled"><a href="../public/index.php?page=<?= htmlspecialchars($currentPage - 1) ;?>">&laquo;</a></li>
            <?php
               for($i=1; $i<=$nbPage; $i++){
        
                   echo '<li><a href="../public/index.php?page='.$i.'">'.$i.'</a></li>';
                } 
            ?>
                <li><a href="../public/index.php?page=<?= htmlspecialchars($currentPage + 1) ;?>">&raquo;</a></li>
            </ul>
        </div>
        <!--Include form contact-->
        <?php include ('contact.php'); ?>

