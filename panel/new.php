<?php 
include './func.php';
session_start();
SessionCheck();
$page = 'new';
?>
<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yeni Kayıt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="new-record" style="width: 70%; margin:auto;">
        <form method="POST">
          <h1 style="margin-top: 5%; text-align: center; margin-bottom: 5%;">Yeni Kayıt</h1>
          <div class="form-outline mb-4">
            <label class="form-label">Arama İsmi</label>
            <input type="text" id="form4Example1" class="form-control" name="name" required />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label">Arama Linki</label>
            <textarea class="form-control" rows="4" name="link" required></textarea>
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">Gönder</button>
          </div>
        </form>
        <?php  

        if (isset($_POST['submit'])) {
          $form_name = $_POST['name'];
          $form_link = $_POST['link'];
          NewSearch($form_name, $form_link);
        }

        ?>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
  </html>