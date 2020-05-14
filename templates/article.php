<?php $this->title = "Article"; ?>
<!--Include form navbar-->
<?php include ('navbar.php'); ?>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest" alt="livre"/>
            <div class='caption'>
                <?= $this->session->show('add_comment'); ?>
                <h1>Billet simple<br>pour l'Alaska</h1>
            </div>   
        </section>
        <section id="bloc-articles" class="container" >
            <div class="row">
                <div class="bloc-content col-md-12 " >
                    <div class="bloc-billet">
                    <?php $date = new Datetime($article->getCreatedAt()); ?>
                        <h3 class="title-billet"><?= $article->getTitle();?><br/><span class="date">Créé le: <?= htmlspecialchars($date->format('d-m-Y H:i:s'));?></span></h3>
                        <p class="billet"><?= $article->getContent();?></p>
                    </div>
                    <?php if($this->session->get('pseudo')){include ('post_comment.php');}; ?>
            
                    <div class="comments">
                        <p class="section-title">Commentaires:</p>  
            <?php
               
                foreach ($comments as $comment)
                {
            ?>
                        <div class="user-comment">
                            <div class="comments-header">
                            <?php $commentDate = new Datetime($comment->getCreatedAt()); ?>
                                <span class="pseudo">De : <?= isset($userPseudo) ? htmlspecialchars($userPseudo):''; ?> </span>
                                <span class="date">Le : <?= isset($comment) ? htmlspecialchars($commentDate->format('d-m-Y H:i:s')) :'';?></span>
                            </div>  
                            <p class="comments-content"><?= isset($comment) ?  htmlspecialchars($comment->getContent()) : '';?></p>
                    <?php
                        if($comment->isFlag()) {
                    ?>
                        <p>Ce commentaire a déjà été signalé</p>
                    <?php
                    } else {
                    ?>
                        <a href="../public/index.php?route=flag&commentId=<?= $comment->getId(); ?>" class="flag-comment">Signaler <i class="fas fa-flag"></i></a>
                    <?php
                    }
                    ?>
                    <?php
            if($this->session->get('role')==="admin")
            {
            ?> 
                <a href="../public/index.php?route=deletecomment&commentId=<?= $comment->getId(); ?>" class="flag-comment">Supprimer<i class="fas fa-flag"></i></a>
            <?php 
            } 
            ?>
                           
                        </div>
            <?php
                };
            ?>
            
                    </div>
            
                </div>
                
        <?php
            if($this->session->get('role')==="admin")
            {
        ?>
         <a href="../public/index.php?route=administration" class="btn btn-info return">Admin</a>
         <a href="../public/index.php" class="btn btn-info return">Accueil</a>
        <?php 
            } else {
        ?>
        <a href="../public/index.php" class="btn btn-info return">Retour</a>
        <?php }
         ?>
            </div>
        </section>
        <!--Include form contact-->
        <?php include ('contact.php'); ?>
        
