<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'components/save_send.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>


    <!-- home section starts  -->

    <div class="home">

        <section class="center">

            <form action="search.php" method="post">
                <h3>Trouver Votre Maison</h3>
                <div class="box">
                    <p>Entrer l'emplacement <span>*</span></p>
                    <input type="text" name="h_location" required maxlength="100"
                        placeholder="entrez le nom de la ville" class="input">
                </div>
                <div class="flex">
                    <div class="box">
                        <p>Type de propriété <span>*</span></p>
                        <select name="h_type" class="input" required>
                            <option value="flat">appartement</option>
                            <option value="house">maison</option>
                            <option value="shop">magasins</option>
                        </select>
                    </div>
                    <div class="box">
                        <p>Type d'offre <span>*</span></p>
                        <select name="h_offer" class="input" required>
                            <option value="sale">vente</option>
                            <option value="resale">revente</option>
                            <option value="rent">louer</option>
                        </select>
                    </div>
                    <div class="box">
                        <p>Budget minimum $ <span>*</span></p>
                        <select name="h_min" class="input" required>
                            <option value="5000">25</option>
                            <option value="5000">50</option>
                            <option value="10000">100</option>
                            <option value="15000">150</option>
                            <option value="20000">200</option>
                            <option value="30000">300</option>
                            <option value="40000">400</option>
                            <option value="50000">50k</option>
                        </select>
                    </div>
                    <div class="box">
                        <p>Budget maximum $ <span>*</span></p>
                        <select name="h_max" class="input" required>
                            <option value="5000">25</option>
                            <option value="5000">50</option>
                            <option value="10000">100</option>
                            <option value="15000">150</option>
                            <option value="20000">200</option>
                            <option value="30000">300</option>
                            <option value="40000">400</option>
                            <option value="50000">50k</option>
                        </select>
                    </div>
                </div>
                <input type="submit" value="recherche de propriété" name="h_search" class="btn">
            </form>

        </section>

    </div>

    <!-- home section ends -->

    <!-- services section starts  -->

    <section class="services">

        <h1 class="heading">Nos Services</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/icon-1.png" alt="">
                <h3>acheter une maison</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

            <div class="box">
                <img src="images/icon-2.png" alt="">
                <h3>maison à louer</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

            <div class="box">
                <img src="images/icon-3.png" alt="">
                <h3>vendre une maison</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

            <div class="box">
                <img src="images/icon-4.png" alt="">
                <h3>appartements et immeubles</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

            <div class="box">
                <img src="images/icon-5.png" alt="">
                <h3>magasins et centres commerciaux</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

            <div class="box">
                <img src="images/icon-6.png" alt="">
                <h3>24/7 service</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
            </div>

        </div>

    </section>

    <!-- services section ends -->

    <!-- listings section starts  -->

    <section class="listings">

        <h1 class="heading">Dernières annonces</h1>

        <div class="box-container">
            <?php
         $total_images = 0;
         $select_properties = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
         $select_properties->execute();
         if($select_properties->rowCount() > 0){
            while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
               
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            if(!empty($fetch_property['image_02'])){
               $image_coutn_02 = 1;
            }else{
               $image_coutn_02 = 0;
            }
            if(!empty($fetch_property['image_03'])){
               $image_coutn_03 = 1;
            }else{
               $image_coutn_03 = 0;
            }
            if(!empty($fetch_property['image_04'])){
               $image_coutn_04 = 1;
            }else{
               $image_coutn_04 = 0;
            }
            if(!empty($fetch_property['image_05'])){
               $image_coutn_05 = 1;
            }else{
               $image_coutn_05 = 0;
            }

            $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);

            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
            $select_saved->execute([$fetch_property['id'], $user_id]);

      ?>
            <form action="" method="POST">
                <div class="box">
                    <input type="hidden" name="property_id" value="<?= $fetch_property['id']; ?>">
                    <?php
               if($select_saved->rowCount() > 0){
            ?>
                    <button type="submit" name="save" class="save"><i
                            class="fas fa-heart"></i><span>saved</span></button>
                    <?php
               }else{ 
            ?>
                    <button type="submit" name="save" class="save"><i
                            class="far fa-heart"></i><span>save</span></button>
                    <?php
               }
            ?>
                    <div class="thumb">
                        <p class="total-images"><i class="far fa-image"></i><span><?= $total_images; ?></span></p>
                        <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
                    </div>
                    <div class="admin">
                        <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
                        <div>
                            <p><?= $fetch_user['name']; ?></p>
                            <span><?= $fetch_property['date']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="price"><i
                            class="fa-solid fa-dollar-sign"></i><span><?= $fetch_property['price']; ?></span></div>
                    <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
                    <p class="location"><i
                            class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address']; ?></span></p>
                    <div class="flex">
                        <p><i class="fas fa-house"></i><span><?= $fetch_property['type']; ?></span></p>
                        <p><i class="fas fa-tag"></i><span><?= $fetch_property['offer']; ?></span></p>
                        <p><i class="fas fa-bed"></i><span><?= $fetch_property['bhk']; ?> BHK</span></p>
                        <p><i class="fas fa-trowel"></i><span><?= $fetch_property['status']; ?></span></p>
                        <p><i class="fas fa-couch"></i><span><?= $fetch_property['furnished']; ?></span></p>
                        <p><i class="fas fa-maximize"></i><span><?= $fetch_property['carpet']; ?> sqft</span></p>
                    </div>
                    <div class="flex-btn">
                        <a href="view_property.php?get_id=<?= $fetch_property['id']; ?>" class="btn">Voir la
                            propriété</a>
                        <input type="submit" value="Envoyer une demande" name="send" class="btn">
                    </div>
                </div>
            </form>
            <?php
         }
      }else{
         echo '<p class="empty">aucune propriété ajoutée pour le moment ! <a href="post_property.php" style="margin-top:1.5rem;" class="btn">Ajouter un nouveau</a></p>';
      }
      ?>

        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="listings.php" class="inline-btn">Voir tout</a>
        </div>

    </section>

    <!-- listings section ends -->








    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <?php include 'components/message.php'; ?>

    <script>
    let range = document.querySelector("#range");
    range.oninput = () => {
        document.querySelector('#output').innerHTML = range.value;
    }
    </script>

</body>

</html>