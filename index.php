<?php 
require("./function.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/c3e482de76.js" crossorigin="anonymous"></script>
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <!-- header -->
  <header id="Home" class="header">
    <nav id="nav" class=" col-12 navbar navbar-expand-lg navbar-dark fs-4 pl-5">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button"  aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav display">
            <li class="nav-item p-4">
              <a class="nav-link home" aria-current="page" onclick="smoothScroll('#Home')">HOME</a>
            </li>
            <li class="nav-item p-4">
              <a class="nav-link avalible" aria-current="page" onclick="smoothScroll('#avalible')">DOSTĘPNE AUTA</a>
            </li>
            <li class="nav-item p-4">
              <a class="nav-link unvalible" aria-current="page" onclick="smoothScroll('#unvalible')">ZAREZERWOWANE
                SAMOCHODY</a>
            </li>
            <li class="nav-item p-4">
              <a class="nav-link reservation" aria-current="page" onclick="smoothScroll('#reservation')">ZAREZERWUJ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container h-75 d-flex align-items-center">
      <div class="row">
        <div class="col-12">
          <h1 class="text-white font-weight-bold header-title">WYPOŻYCZALNIA SAMOCHODÓW</h1>
        </div>
        <div class="col-12">
          <div class="mt-5 buttons">
            <button onclick="smoothScroll('#avalible')"
              class=" header-btn col-lg-3 col-md-5 col-sm-12 font-weight-bold">OFERTA</button>
            <button onclick="smoothScroll('#reservation')"
              class=" header-btn col-lg-3 col-md-5 col-sm-12 mt-sm-5 font-weight-bold">REZERWUJ</button>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- header-->

   <!-- avalible -->
   <section id="avalible">
    <div class="container-fluid pt-4 pb-4">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center p-5">DOSTĘPNE SAMOCHODY</h1>
          </div>
        </div>
        <div class="swiper">
      <div class="swiper-wrapper">
        <?php
        $rows=get_cars("avalible");
        foreach ($rows as $row):?>
        <div class="swiper-slide">
          <div id="car<?php echo $row['id']?>" class="card">
            <img src="./assets/<?php echo $row['photo_url'] ?>" class="card-img-top" alt="car1">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $row['name']?></h5>
              <p class="text-center"><?php echo $row['type']?></p>
              <p class="text-center font-weight-bold"><?php echo $row['price']?> zł / h</p>
              <a onclick="reserve(<?php echo $row['id']?>); calculatePrice(<?php echo $row['price'] ?>)" class="btn btn-primary col-12">Rezerwuj</a>
            </div>
          </div>
        </div>
        <?php endforeach?>
      </div>
    <!-- Add Navigation -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next">
    </div>
    </div>
  </section>


  <!-- avalible -->

  <!-- unvalible -->
  <section id="unvalible">
      <div class="container-fluid pt-4 pb-4">
          <div class="row">
            <div class="col-12">
              <h1 class="text-center pt-5 pb-5">OBECNIE ZAREZERWOWANE</h1>
            </div>
          </div>
          <div class="swiper">
      <div class="swiper-wrapper">
          <?php
          $rows=get_cars("unvalible");
          foreach ($rows as $row):?>
        <div class="swiper-slide">
        <div id="car<?php echo $row['id']?>" class="card">
            <img src="./assets/<?php echo $row['photo_url'] ?>" class="card-img-top" alt="car1">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $row['name']?></h5>
              <p class="text-center"><?php echo $row['type']?></p>
              <p class="text-center font-weight-bold"><?php echo $row['price']?> zł / h</p>
              <btn href="#" class="btn btn-danger col-12" disabled>Dostępny od: <?php echo substr($row['to_date'],0,10)?><btn>
            </div>
          </div>
        </div>
          <?php endforeach?>
      </div>
    <!-- Add Navigation -->
      <div class="swiper-button-prev"></div>
    <div class="swiper-button-next">
    </div>
      </div>
  </section>

  <!-- unvalible -->

  <i class="fa-solid fa-arrow-up"></i>

  <!-- reservation form -->

  <section id="reservation">
    <div class="container-fluid hero">
        <h1 class="text-center p-4 font-weight-bold">ZAREZERWUJ</h1>
        <div class="col-12 text-danger text-center d-flex justify-content-center">
          <h3 ><span class="finalPrice">0</span> <span>zł</span></h3>
        </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-center p-5 text-white">  
          <form action="reserve.php" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Imię</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Podaj imię" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="surname">Nazwisko</label>
                  <input type="text" class="form-control" name="surname" id="surname" placeholder="Podaj nazwisko"
                    required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="phone">Numer telefonu</label>
              <input type="tel" name="phone" class="form-control" placeholder="Wprowadź number" required>
            </div>
            <div class="form-group">
              <label for="car">Samochód</label>
              <select name="car" class="car col-12" id="car" class="form-control">
                <option value="" selected disabled hidden>samochód</option>
                  <?php
                  $rows=get_cars('list');
                  foreach ($rows as $row):?>
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                    <?php endforeach?>
              </select>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="date">Termin</label>
                  <input type="datetime-local" name="term" id="date" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="days">Dni</label>
                      <input type="number" name="days" id="days" min='0' max="30" placeholder="Dni"
                        class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="days">Godziny</label>
                      <input type="number" name="hours" id="hours" min='0' max="23" placeholder="Godziny"
                        class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-12">
              <input type="submit" value="REZERWUJ" class=" col-12 mt-4 btn btn-danger">
              </div>
          </div>
        </form>
      </div>
    </div>
    </div>
  </section>
  <!-- reservation form -->
  <!-- footer -->
  <footer>
    <div class="col-12 d-flex flex-column justify-content-center align-items-center footer pt-4 pb-4">
      <div>
        <a href="#"><i class="fa-brands fa-facebook fa-2x text-primary p-2"></i></a>
        <a href="#"><i class="fa-brands fa-twitter fa-2x text-primary p-2"></i></a>
        <a href="#"><i class="fa-brands fa-instagram fa-2x text-primary p-2"></i></a>
        <a href="#"><i class="fa-brands fa-linkedin fa-2x text-primary p-2"></i></a>
      </div>
      <h5 class=" font-weight-bold text-center m-0">
        Copyright&copy <span class="curentYear"></span>
      </h5>

    </div>
  </footer>
  <!-- footer -->
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./js/myScript.js"></script>

</body>

</html>