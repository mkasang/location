<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['send'])){

   $msg_id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $message = $_POST['message'];
   $message = filter_var($message, FILTER_SANITIZE_STRING);

   $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $verify_contact->execute([$name, $email, $number, $message]);

   if($verify_contact->rowCount() > 0){
      $warning_msg[] = 'message déjà envoyé !';
   }else{
      $send_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
      $send_message->execute([$msg_id, $name, $email, $number, $message]);
      $success_msg[] = 'Message envoyé avec succès !';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <!-- contact section starts  -->

    <section class="contact">

        <div class="row">
            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>
            <form action="" method="post">
                <h3>entrer en contact</h3>
                <input type="text" name="name" required maxlength="50" placeholder="Entrer votre nom" class="box">
                <input type="email" name="email" required maxlength="50" placeholder="entrer votre email" class="box">
                <input type="number" name="number" required maxlength="10" max="9999999999" min="0"
                    placeholder="entrer votre numero de telephone" class="box">
                <textarea name="message" placeholder="enter your message" required maxlength="1000" cols="30" rows="10"
                    class="box"></textarea>
                <input type="submit" value="Envoyer" name="send" class="btn">
            </form>
        </div>

    </section>

    <!-- contact section ends -->

    <!-- faq section starts  -->

    <section class="faq" id="faq">

        <h1 class="heading">FAQ</h1>

        <div class="box-container">

            <div class="box active">
                <h3><span>comment annuler une réservation ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

            <div class="box active">
                <h3><span>Quand est-ce que j'en prendrai possession ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

            <div class="box">
                <h3><span>où puis-je payer le loyer ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

            <div class="box">
                <h3><span>comment contacter les acheteurs ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

            <div class="box">
                <h3><span>pourquoi mon annonce n'apparaît pas ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

            <div class="box">
                <h3><span>comment promouvoir mon annonce ?</span><i class="fas fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus veritatis ducimus aut
                    accusantium sunt error esse laborum cumque ipsum ab.</p>
            </div>

        </div>

    </section>

    <!-- faq section ends -->










    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <?php include 'components/message.php'; ?>

</body>

</html>