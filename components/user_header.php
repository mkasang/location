<!-- header section starts  -->

<header class="header">

    <nav class="navbar nav-1">
        <section class="flex">
            <a href="home.php" class="logo"><i class="fas fa-house"></i>Maison</a>

            <ul>
                <li><a href="post_property.php">Poster une propriété<i class="fas fa-paper-plane"></i></a></li>
            </ul>
        </section>
    </nav>

    <nav class="navbar nav-2">
        <section class="flex">
            <div id="menu-btn" class="fas fa-bars"></div>

            <div class="menu">
                <ul>
                    <li><a href="#">Mes annonces<i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="dashboard.php">Tableau de bord</a></li>
                            <li><a href="post_property.php">Poster une propriété</a></li>
                            <li><a href="my_listings.php">Mes annonces</a></li>
                        </ul>
                    </li>
                    <li><a href="#">options<i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="search.php">Recherche par filtre</a></li>
                            <li><a href="listings.php">Tous les listings</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Aide<i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="about.php">A propos</a></i></li>
                            <li><a href="contact.php">Nous contact</a></i></li>
                            <li><a href="contact.php#faq">FAQ</a></i></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <ul>
                <li><a href="saved.php">saved <i class="far fa-heart"></i></a></li>
                <li><a href="#">Compte <i class="fas fa-angle-down"></i></a>
                    <ul>
                        <?php if($user_id != ''){ ?>
                        <li><a href="update.php">Mettre à jour le profil</a></li>
                        <li><a href="components/user_logout.php"
                                onclick="return confirm('Se déconnecter de ce site ?');">Deconnexion</a>
                            <?php } else { ?>
                        <li><a href="login.php">Connecte-toi</a></li>
                        <li><a href="register.php">S'inscrire</a></li>

                        <?php } ?>
                </li>
            </ul>
            </li>
            </ul>
        </section>
    </nav>

</header>

<!-- header section ends -->