<?php include 'sendemail.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  </head>
  <body>

    <!--alert messages start-->
    <?php echo $alert; ?>
    <!--alert messages end-->

    <!--contact section start-->
    
      <div class="contact-form">
        <form class="contact" action="" method="post">
          
          <h2>Send an Email</h2>

          <label>Name</label>
          <input type="text" name="name" class="text-box" placeholder="Your Name" required>
          <br><br>

          <label>Email</label>
          <input type="email" name="email" class="text-box" placeholder="Your Email" required>
          <br><br>

          <label>Send to</label>
          <input type="email" name="sendEmail" class="text-box" placeholder="Email Send to " required>
          <br><br>

          <label>Subject</label>
          <input name="subject" type="text" placeholder=" Enter Subject">
          <br><br>

          <p>Message</p>
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
          <br><br>
          
          
          <input type="submit" name="submit" class="send-btn" value="Send">
        </form>
      </div>
    
    <!--contact section end-->

    <script type="text/javascript">
    if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }
    </script>

  </body>
</html>