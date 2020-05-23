<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="img/carreta.png" type="image/x-icon">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <title>FIND Shopping cart</title>
</head>

<body>
<body style="background-image: url(img/back.jpg); background-repeat: no-repeat; background-size: cover;">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f9a826!important;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="img/LogoFind.png" style="width: 150px">
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <form class="form-inline my-lg-0 ml-auto">
          <input type="text" id="inSearch" placeholder="Search">
          <a type="button" class="btn btn-outline-primary">Search</a>
          <a type="button" href="../PerfilUsuario/index.php" class="btn btn-outline-primary">Profile</a>
          <img src="img/carrito-plus.png" style="width: 80px; margin-left: 3px;">
        </form>
      </div>
    </nav>
  </header>


  <div class="row" >
    <div class="col-xl-2 col-lg-1 col-12" >
      <input id="idUsuario" type="text" value="<?php echo $_COOKIE["id"] ?>">
      <div id="categorias">
        <ul>
          <li onclick="generateProduct('Technology')"><span><i class="fas fa-laptop"></i></span><b>Technology</b></li>
          <li onclick="generateProduct('Fashion')"><span><i class="fas fa-tshirt"></i></span><b>Fashion</b></li>
          <li onclick="generateProduct('Sports')"><span><i class="fas fa-futbol"></i></span><b>Sports</b></li>
          <li onclick="generateProduct('Home')"><span><i class="fas fa-home"></i></span><b>Home</b></li>
          <li onclick="generateProduct('Electrodomestics')"><span><i class="fas fa-plug"></i></span><b>Electrodomestics</b></li>
          <li onclick="generateProduct('Accesories')"><span><i class="fas fa-clock"></i></span><b>Accesories</b></li>
          <li onclick="generateProduct('Health')"><span><i class="fas fa-notes-medical"></i></span><b>Health</b></li>
          <li onclick="generateProduct('Education')"><span><i class="fas fa-book-open"></i></span><b>Education</b></li>
        </ul>
      </div>
    </div>

    <div class="col-xl-10 " style="margin-top: 100px;">
      <div>
        <h1 style="color: #0e7248; text-align: center;" id="titulo"><b>Categories</b></h1>
        <hr class="mx-5">
      </div>
      <div class="row" id="area">

        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12">
          <div class="card-deck" onclick="generateProduct('Fashion')">
            <div class="card mx-1">
              <img src="img/fashion.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Fashion</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12">
          <div class="card-deck" onclick="generateProduct('Electrodomestics')">
            <div class="card mx-1">
              <img src="img/electrodomestics.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Electrodomestics</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12">
          <div class="card-deck" onclick="generateProduct('Home')">
            <div class="card mx-1">
              <img src="img/home.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Home</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12">
          <div class="card-deck" onclick="generateProduct('Sports')">
            <div class="card mx-1">
              <img src="img/sports.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Sports</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12" style="margin-top: 30px;">
          <div class="card-deck" onclick="generateProduct('Technology')">
            <div class="card mx-1">
              <img src="img/technology.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Technology</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12" style="margin-top: 30px;">
          <div class="card-deck" onclick="generateProduct('Accesories')">
            <div class="card mx-1">
              <img src="img/accesories.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Accesories</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12" style="margin-top: 30px;">
          <div class="card-deck" onclick="generateProduct('Health')">
            <div class="card mx-1">
              <img src="img/health.jpeg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Health</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-xs-6 col-12" style="margin-top: 30px;">
          <div class="card-deck" onclick="generateProduct('Education')">
            <div class="card mx-1">
              <img src="img/education.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h2><b>Education</b></h2>
                <h3>$ -50%</h3>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur fuga illum laudantium ducimus beatae fugit.
                  content.</p>
            </div>
          </div>
          </div>
        </div>
        



        </div>
      </div>


      
      <!--detalles -->
      <div class="modal" tabindex="-1" role="dialog" id="modal-detalles">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #f9a826;">
              <div id="tituloDetalle"></div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div  id="detalles">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- modal-qualify -->
      <div class="modal"  tabindex="-1" role="dialog" id="modal-qualify">
        <div class="modal-dialog" style="top: 30%;" role="document">
          <div class="modal-content" >
            <div class="modal-header" style="background-color: #f9a826; ">
              <h5 class="modal-title">Qualify this promotion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body m-auto" >
              <div class="stars" >
                <form action="">
                  <input class="star star-5"  id="star-5" type="radio" name="star"/>
                  <label class="star star-5" for="star-5"></label>
                  <input class="star star-4" id="star-4" type="radio" name="star"/>
                  <label class="star star-4" for="star-4"></label>
                  <input class="star star-3" id="star-3" type="radio" name="star"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" id="star-2" type="radio" name="star"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" id="star-1" type="radio" name="star"/>
                  <label class="star star-1" for="star-1"></label>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-comment -->
      <div class="modal" tabindex="-1" role="dialog" id="modal-comment">
        <div class="modal-dialog" style="top: 30%;" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #f9a826;">
              <h5 class="modal-title">Make your comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input class="form-control" id="comment" type="text">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-secondary" onclick="guardarComentario()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      
      <a class="back-to-top"><img src="img/top.png" alt="" srcset=""></span></a>
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/controlador.js"></script>

</body>

</html>