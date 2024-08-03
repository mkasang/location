<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="dashboard">

        <h1 class="heading">Tableau de bord</h1>

        <div class="box-container">

            <div class="box">
                <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
                <h3>Bienvenue !</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update.php" class="btn">mettre à jour le profil</a>
            </div>

            <div class="box">
                <h3>recherche par filtre</h3>
                <p>Recherchez la propriété de vos rêves</p>
                <a href="search.php" class="btn">rechercher maintenant</a>
            </div>

            <div class="box">
                <?php
        $count_properties = $conn->prepare("SELECT * FROM `property` WHERE user_id = ?");
        $count_properties->execute([$user_id]);
        $total_properties = $count_properties->rowCount();
      ?>
                <h3><?= $total_properties; ?></h3>
                <p>propriétés répertoriées</p>
                <a href="my_listings.php" class="btn">voir toutes les annonces</a>
            </div>

            <div class="box">
                <?php
        $count_requests_received = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ?");
        $count_requests_received->execute([$user_id]);
        $total_requests_received = $count_requests_received->rowCount();
      ?>
                <h3><?= $total_requests_received; ?></h3>
                <p>demandes reçues</p>
                <a href="requests.php" class="btn">vour toutes les demandes</a>
            </div>

            <div class="box">
                <?php
        $count_requests_sent = $conn->prepare("SELECT * FROM `requests` WHERE sender = ?");
        $count_requests_sent->execute([$user_id]);
        $total_requests_sent = $count_requests_sent->rowCount();
      ?>
                <h3><?= $total_requests_sent; ?></h3>
                <p>demandes envoyer</p>
                <a href="saved.php" class="btn">voir les propriétés enregistrées</a>
            </div>

            <div class="box">
                <?php
        $count_saved_properties = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
        $count_saved_properties->execute([$user_id]);
        $total_saved_properties = $count_saved_properties->rowCount();
      ?>
                <h3><?= $total_saved_properties; ?></h3>
                <p>propriétés sauvegardées</p>
                <a href="saved.php" class="btn">voir les propriétés enregistrées</a>
            </div>

        </div>

    </section>






















    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <?php include 'components/message.php'; ?>

</body>

</html>