<?php $this->title = 'Administration'; ?>      
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="default.html">Jean Forteroche</a>
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
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                </td> 
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>