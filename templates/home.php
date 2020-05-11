
<?php $this->title = "Accueil"; ?>
        <!--Include form navbar-->
        <?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest"/>
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
            <p>HellozdzdLe Lorem Ipsum est simp
                lement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour
                ljdzljdzln</p>
        </section>
        <section id="content" class="container" >
             
            <div class="row">
            <?php
                foreach ($articles as $article)
                {
            ?>
                <div class="bloc-content col-md-6 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet"><?= htmlspecialchars($article->getTitle());?> <span class="date">Créé le: <?= htmlspecialchars($article->getCreatedAt());?></span></h3>
                        <p class="billet"><?= substr(htmlspecialchars($article->getContent()),0, 500);?></p>
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

