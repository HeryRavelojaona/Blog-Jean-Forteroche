<?php $this->title = 'Administration'; ?>      
<header>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
        <a class="navbar-brand logo" href="../public/index.php">Jean Forteroche</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown  active">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Votre espace</a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="../public/index.php?route=profile">Profil</a></li>
                    <li><a href="../public/index.php?route=logout">Déconnexion</a></li>
                </li>
            </ul>
        </div>
    </nav>
</header>
<section id="header_img">
    <img src="../public/images/book.jpg"class="img-fluid imgtest"/>
    <div class='caption'>
            <?= $this->session->show('addArticle'); ?>
            <?= $this->session->show('updateArticle'); ?>
            <?= $this->session->show('delete_article'); ?>
            <?= $this->session->show('status_article'); ?>
            <?= $this->session->show('delete_comment'); ?>
            <?= $this->session->show('delete_user'); ?>
            <?= $this->session->show('delete_impossible'); ?>
        <h1>Billet simple<br>pour l'Alaska</h1> 
    </div>   
</section>
<section class="container">
    <div class="row">
        <div class="bloc-content col-md-12">
        <h2 class="h2adminView">Liste des articles 
                <a href="../public/index.php?route=addarticle" class="btn btn-success new-billet">Nouvelle article 
                    <span>
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
            <table  class="table table-striped table-bordered table-hover tresponsive">
                <legend>Gestion des articles</legend>
                <thead class="thead-dark">
                    <tr>
                        <th >Titre</th>
                        <th>Date de création</th>
                        <th>Extrait</th>
                        <th>Status</th> 
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($articles as $article)
                    {   
                        if($article->getStatus()== 0){$action = 'publié';
                                                    $status = 'Brouillon';
                                                    $color= 'secondary';
                        }else if($article->getStatus()== 1){$action = 'retiré';
                                                            $status = 'Publié';
                                                             $color= 'primary';}
                ?>   
                    <tr>
                        <td><?= htmlspecialchars($article->getTitle());?></td>
                        <td class="date"><?= htmlspecialchars($article->getCreatedAt());?></td>
                        <td class="extrait"><?= substr(htmlspecialchars($article->getContent()),0 ,100);?></td>
                        <td><?= htmlspecialchars($status);?></td>
                        <td>
                        <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info btnAdmin">Voir <i class="fas fa-eye"></i></a>
                        <a href="../public/index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-warning btnAdmin">Modifier <i class="fas fa-exchange-alt"></i><a>
                        <a href="../public/index.php?route=publishOrnot&articleId=<?= htmlspecialchars($article->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn btn-<?= htmlspecialchars($color);?> btnAdmin"><?= htmlspecialchars($action);?><a>
                        <a href="../public/index.php?route=deletearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-danger btnAdmin">Supprimer <i class="fas fa-trash-alt"></i><a>
                        </td> 
                    </tr>
    <?php
        }
    ?>  
                </tbody>
                <tfoot class="thead-dark">
                    <tr scope="row">
                        <th scope="col">Titre</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Extrait</th>
                        <th scope="col">Status</th> 
                        <th scope="col">Actions</th> 
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<!-- Section Comments-->
<section class="container">
    <div class="row">
        <div class="bloc-content col-md-12">
        <h2 class="h2adminView">Commentaires signalés
                    <span>
                        <i class="fas fa-flag"></i>
                    </span>
                </a>
        </h2>
            <table  class="table table-striped table-bordered table-hover tresponsive">
                <legend>Gestion des commentaires</legend>
                <thead class="thead-dark">
                    <tr>
                        <th >Auteur</th>
                        <th>Date de création</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($comments as $comment)
                    {   
                ?>   
                    <tr>
                        <td><?= htmlspecialchars($userPseudo);?></td>
                        <td><?= htmlspecialchars($comment->getCreatedAt());?></td>
                        <td><?= htmlspecialchars($comment->getContent());?></td>
                        <td>
                        <a href="../public/index.php?route=deleteflagcomment&commentId=<?= htmlspecialchars($comment->getId());?>" class="btn btn-danger btnAdmin">Supprimer <i class="fas fa-trash-alt"></i></a>
                        <a href="../public/index.php?route=unflag&commentId=<?= htmlspecialchars($comment->getId());?>" class="btn btn-warning btnAdmin">Désignaler <i class="fas fa-exchange-alt"></i><a>
                        </td> 
                    </tr>
    <?php
        }
    ?>  
                </tbody>
                <tfoot class="thead-dark">
                    <tr scope="row">
                        <th scope="col">Auteur</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Message</th>
                        <th scope="col">Actions</th> 
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<!-- Section Userss-->
<section class="container">
    <div class="row">
        <div class="bloc-content col-md-12">
        <h2 class="h2adminView">Liste des utilisateurs
                    <span>
                    <i class="fas fa-users"></i>
                    </span>
                </a>
        </h2>
            <table  class="table table-striped table-bordered table-hover tresponsive">
                <legend>Gestion des utilisateurs</legend>
                <thead class="thead-dark">
                    <tr>
                        <th >Pseudo</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($users as $user)
                    {   
                ?>   
                    <tr>
                        <td><?= htmlspecialchars($user->getPseudo());?></td>
                        <td><?= htmlspecialchars($user->getStatus());?></td>
                        <td><?= htmlspecialchars($user->getRole());?></td>
                        <td>
                        <?php
                        if($user->getRole()!= 'admin'){
                         ?>
                         <a href="../public/index.php?route=deleteuser&userId=<?= htmlspecialchars($user->getId());?>" class="btn btn-danger btnAdmin">Supprimer <i class="fas fa-trash-alt"></i></a>
                        <a href="../public/index.php?route=changerole&userId=<?= htmlspecialchars($user->getId());?>&role=<?= htmlspecialchars($user->getRole());?>" class="btn btn-warning btnAdmin">Changer son role en administrateur<i class="fas fa-exchange-alt"></i><a>
                         <?php
                        } 
                        ?>
                        </td> 
                    </tr>
    <?php
        }
    ?>  
                </tbody>
                <tfoot class="thead-dark">
                    <tr scope="row">
                        <th >Pseudo</th>
                        <th>Date de création</th>
                        <th>Role</th>
                        <th>Actions</th> 
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>