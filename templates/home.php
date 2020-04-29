
<?php $this->title = "Accueil"; ?>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
                <a class="navbar-brand logo" href="default.html">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="../public/index.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                <?php
                    if($this->session->get('pseudo'))
                    {
                ?>
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Votre espace</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=profile">Profil</a></li>
                            <li><a href="../public/index.php?route=logout">Déconnexion</a></li>
                <?php 
                    }else{ 
                ?>
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="../public/index.php?route=register">S'inscrire</a></li>
                            <li><a href="../public/index.php?route=login">Connexion</a></li>        
                <?php 
                } 
                ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <section id="header_img">
            <img src="images/book.jpg"class="img-fluid imgtest"/>
            <div class='caption'>
                <?= $this->session->show('register'); ?>
                <?= $this->session->show('login'); ?>
                <?= $this->session->show('logout'); ?>
                <?= $this->session->show('update_password'); ?>
                <?= $this->session->show('mailforgot'); ?>
                <?= $this->session->show('delete_account'); ?>
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
                <div class="bloc-content col-md-6 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet">titre</h3>
                        <p class="billet">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme 
                            assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte,
                            comme Aldus PageMaker.
                        </p>
                        <a href="article.html">Lire la suite...
                            <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>
                <div class="bloc-content col-md-6 " >
                    <div class="bloc-billets">
                        <h3 class="title-billet">titre</h3>
                        <p class="billet">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme 
                            assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte,
                            comme Aldus PageMaker.
                        </p>
                        <a href="article.html">Lire la suite...
                            <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="page">
            <ul class="pagination">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="default.html?page=1">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>

