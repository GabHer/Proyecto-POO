<?php 
  include("../../backend/class/verificacion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/css/ol.css" type="text/css">
    <link rel="shortcut icon" href="img/carreta.png">
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/build/ol.js"></script>
    
    <title>Profile Client</title>

</head>
<body style="font-family: 'Comic Neue', cursive;background-image: url(img/); background-size: cover; background-repeat: no-repeat;">
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f9a826!important;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="img/LogoFind.png" style="width: 150px">
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <form class="form-inline my-lg-0 ml-auto">
          <a class="btn btn-outline-primary " style="margin-right:5px;" href="index.php">Principal perfil</a>
          <a class="btn btn-outline-primary ml-auto" href="../../backend/class/logout.php">Cerrar sesión</a>
        </form>
      </div>
    </nav>
    </header>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xs-6 col-md-3 col-12" style="margin-top: 110px; margin-left: 50px;">
                <div id="perfil">
                    <img class="rounded-circle img-thumbnail" src="img/user.jpg"  alt="" srcset="">
                </div>
            </div>
            <div class="col-lg-7 col-xs-6 col-md-3 col-12" style="padding-top: 40px; margin-top: 80px; margin-left:25px">
                        <div class="container" style="text-align: center;">
                          <div id="user">
                          <h1  class="display-4 letter" style="color: #f9a826;">Welcome user</h1>
                          </div>
                          <hr style="background-color: #f9a826;">
                          <a href="../UsuarioRegistro/index.php" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<b>Editar datos</b>">
                            <span> <i class="far fa-address-card fa-3x"></i></span>
                          </a>
                          <button onclick="verPerfilesEmpresas()" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<b>Ver perfiles empresas</b>">
                            <span> <i class="fas fa-building fa-3x"></i></i></span>
                          </button>
                          <button type="button" onclick="location.href='../Carrito/index.php'" class="btn btn-secondary letter" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<b>Ve al carrito</b>">
                            <span> <i class="fas fa-cart-arrow-down fa-3x"></i></i></span>
                          </button>
                          <button  type="button" onclick="promEnGoogle()" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<b>Promociones en google maps</b>">
                            <span> <i class="fas fa-map-marked-alt fa-3x"></i></span>
                          </button>
                          <button onclick="favEmpresasPromo()" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<b>Empresas y promociones favoritas</b>">
                            <span><i class="fas fa-heart fa-3x"></i></i></span> 
                          </button>
                          <button type="button" href="#" data-toggle="modal" data-target="#eliminarCuenta" class="btn btn-secondary letter" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<b>Eliminar cuenta</b>">
                            <span><i class="fas fa-trash-alt fa-3x"></i></span>
                          </button>
                          <hr style="background-color: #f9a826;">
                        </div>
                </div>
                <input style="display: none" type="text" id="id" value="<?php echo $_COOKIE["id"] ?>">
            </div>

            <div class="row" style="margin-top: 60px; margin-left: 20px;" id="area">
              <div class="accordion" id="accordionExample" >
                <div class="card">
                  <div class="card-header" style="background-color: #f9a826;" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Personal Information
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body" >
                      <div class="row" id="information">
                        <p>Name: Gabriela Hernández;     Birthday: 29 Enero;     Address: Carrizal#1;    Phone: 98902164;    Email: gabrielahernandez@gmail.hn;   Card: 037828128318</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What are your benefits?
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body" >
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae suscipit illo, eligendi repudiandae ipsum amet aspernatur exercitationem odit reprehenderit incidunt quidem doloremque sequi veritatis aut cupiditate eaque autem ratione nesciunt.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        About us
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi aspernatur a odit quod, quos, laborum fugit harum, soluta qui laboriosam saepe eveniet nesciunt ab quaerat. At, temporibus. Exercitationem, aliquid ipsa!
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>

   

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
      <div class="row">
        <div class="col-12 col-md">
          <small class="d-block mb-3 text-muted" style="text-align: center;">&copy; Copyright 2020 Find</small>
        </div>
    </footer>

    
    <!-- modal-productsEnterprise -->
    <div class="modal fade" id="modal-productsEnterprise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #f9a826;">
            <h5 class="modal-title" id="titulo">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-p">
            <hr>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Eliminar cuenta -->
    <div class="modal fade" id="eliminarCuenta" tabindex="-1" role="dialog" aria-labelledby="modal-eliminarCuenta"
            aria-hidden="true" style="font-family: 'Comic Neue', cursive;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #f9a826;">
                        <h5 class="modal-title" style="color: red">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div style="color:  #0e7248" class="text-center modal-body" >
                        ¿Estás seguro que deseas eliminar tu cuenta en FIND?<br> 
                        ¡Te extrañaremos!
                    </div>
                    <div class="modal-footer" >
                    <div id="loadingEliminar" style="display: none; color: #0e7248;"class="spinner-border" role="status">
                        <span  class="sr-only">Loading...</span>
                      </div>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <a onclick="eliminarUsuario()" style="cursor: pointer" class="btn btn-outline-primary" >Yes</a>
                    </div>
                </div>
            </div>
        </div>

    <a class="back-to-top"><img src="img/top.png" alt="" srcset=""></a>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/controlador.js"></script>
    
    
</body>
</html>