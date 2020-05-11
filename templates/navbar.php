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
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Chapitres</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                        $i=0;
                    foreach ($episodes as $episode){
                            $i++;
                    ?>
                        <a class='dropdown-item' href='../public/index.php?route=article&articleId=<?= $episode->getId();?>'>Episode <?= $i ;?></a>
                    <?php 
                    };
                        ?>
                    </div>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item dropdown">
        <?php
            if($this->session->get('pseudo'))
            {
        ?>
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Votre espace</a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="../public/index.php?route=profile" class="dropdown-item">Profil</a></li>
            <?php if($this->session->get('role') === 'admin') { ?>
                    <li><a href="../public/index.php?route=administration" class="dropdown-item">Administration</a></li>
            <?php } ?>
                    <li><a href="../public/index.php?route=logout" class="dropdown-item">Déconnexion</a></li>
        <?php 
            }else{ 
        ?>
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Login</a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="../public/index.php?route=register" class="dropdown-item">S'inscrire</a></li>
                    <li><a href="../public/index.php?route=login" class="dropdown-item">Connexion</a></li>        
        <?php 
        } 
        ?>
                </li>
            </ul>
        </div>
    </nav>
</header>