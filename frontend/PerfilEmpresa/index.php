<?php
    include('../../backend/class/verificacion.php');
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
    <link rel="shortcut icon" href="img/carreta.png">
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/build/ol.js"></script>
    <title>Profile Enterprise</title>

</head>
<body >
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f9a826!important;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="img/LogoFind.png" style="width: 150px">
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <form class="form-inline my-lg-0 ml-auto">
            <a class="btn btn-outline-primary " style="margin-right: 5px;" href="index.php">Principal perfil</a>
            <a class="btn btn-outline-primary ml-auto" href="../../backend/class/logoutEmpresa.php">Cerrar sesión</a>
        </form>
      </div>
    </nav>
    </header>

    
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xl-2" style="background-color:rgba(128, 128, 128, 0.363);">
            <div class="col-lg-4 col-xs-6 col-md-3 col-12 " id="logo">
                <img style="margin-top:180px" src="" alt="" srcset="">
            </div>
            <div class="col-lg-7 col-xs-6 col-md-3 col-12 center-block" style="margin-top: 90px;">
                <div style="text-align: center;">
                    <div id="welcome"><h1 class="display-4 letter" style="color: #f9a826;"></h1></div>
                    <hr style="background-color: #f9a826;">
                    <a style="margin:5px" href="../EmpresaRegistro/index.php" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom"
                    data-html="true" title="<b>Editar perfil</b>">
                        <span> <i class="far fa-address-card fa-3x"></i></span>
                    </a>
                    <button style="margin:5px" onclick="registroSucursales()" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom"
                    data-html="true" title="<b>Registro sucursales</b>">
                        <span> <i class="fas fa-store fa-3x"></i></span>
                    </button>
                    <button style="margin:5px" onclick="registroProductos()" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom"
                    data-html="true" title="<b>Registro productos</b>">
                        <span><i class="fas fa-cart-arrow-down fa-3x"></i></span>
                    </button>
                    <button style="margin:5px" onclick="registroPromociones()" type="button" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom"
                    data-html="true" title="<b>Registro promociones</b>">
                        <span> <i class="fas fa-parachute-box fa-3x"></i></span>
                    </button>
                    <a style="margin:5px" type="button" href="ficha.php" class="btn btn-secondary letter" data-toggle="tooltip" data-placement="bottom"
                    data-html="true" title="<b>Ficha promocional</b>">
                        <span> <i class="fas fa-print fa-3x"></i></span>
                    </a>
                    <button style="margin:5px" type="button" href="#" data-toggle="modal" data-target="#eliminarCuenta" class="btn btn-secondary letter" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Eliminar cuenta">
                            <span><i class="fas fa-trash-alt fa-3x"></i></span>
                    </button>
                    <hr style="background-color: #f9a826;">
                </div>
            </div>
        </div>
        <div class="col-xl-10">
        <div class="container-fluid" style="margin-top:100px" id="area">
            <div class="row" style="margin-left: 80px" id="banner">
                <img style="width: 1050px; border: #0E7248 20px solid;  margin-left: 100px; " src="img/banner.jpg" alt="" srcset="">
                <input type="text" style="display: none" id="id" value="<?php echo $_COOKIE["id"] ?>">
                <input type="text" style="display: none" id="latitute" value="<?php echo $_COOKIE["latitute"] ?>">
                <input type="text" style="display: none" id="longitude" value="<?php echo $_COOKIE["longitude"] ?>">
            </div>
            <div style="margin: 30px 0px 0px 10px;" class="accordion" id="accordionExample" style="font-family: 'Comic Neue', cursive;">
                <div class="card">
                    <div class="card-header" style="background-color: #f9a826;" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Information
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body" >
                            <div class="row" id="information" style="font-family: 'Comic Neue', cursive;">
                                <p>Name: EnterpriseName; Country: Honduras; Address:
                                    Distrito Central; Phone: 22012983; Email: enterprise@gmail.hn; Foundation: 00/00/2020</p>
                            </div>
                            
                            <div class="row">
                                <div class="container" style="text-align: center;">
                                    <hr style="background-color: #f9a826;">
                                    <i style="color: blue;" class="fab fa-facebook fa-3x"></i>
                                    <i style="color: rgb(87, 139, 235);" class="fab fa-twitter fa-3x"></i>
                                    <i style="color: black;" class="fab fa-instagram fa-3x"></i>
                                    <i style="color: red;" class="fab fa-pinterest fa-3x"></i>
                                    <hr style="background-color: #f9a826;">    
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button id="tituloComment" class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                New comments
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="row" id="comments" style="font-family: 'Comic Neue', cursive;">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Sales graphs for day
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body" >
                            <div class="shadow-lg">
                                <canvas class="canvas" id="graph1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Graph followers for month
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shadow-lg">
                                <div class="col-12" >
                                <canvas class="canvas" id="graph2"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Location
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                            <div id="map" class="map"></div>
                            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
                            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
                            crossorigin=""/>
                            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
                            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
                            crossorigin=""></script>
                            <script>
                            
                            lon= parseFloat(document.getElementById('longitude').value);
                            lat= parseFloat(document.getElementById('latitute').value);
                            console.log(lon);
                            console.log(lat);
                            var map = L.map('map').setView([14.1054876, -87.2066037], 15);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([lat,lon]).addTo(map)
                                .bindPopup('Main location')
                                .openPopup();
                            </script>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree" style="font-family: 'Comic Neue', cursive;">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                About you
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body"><h4 id="about">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque ducimus laborum suscipit in recusandae modi earum repudiandae, unde aspernatur et. Ullam consequatur odio excepturi facere iure cum assumenda temporibus eveniet.</h4>
                        </div>
                    </div>
                </div>

            </div>
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
                        ¿Estás seguro que deseas eliminar tu cuenta empresarial en FIND?<br> 
                        ¡Te extrañaremos!
                    </div>
                    <div class="modal-footer" >
                    <div id="loadingEliminar" style="display: none; color: #0e7248;"class="spinner-border" role="status">
                        <span  class="sr-only">Loading...</span>
                    </div>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <a onclick="eliminarEmpresa()" style="cursor: pointer" class="btn btn-outline-primary" >Yes</a>
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

    <a class="back-to-top"><img src="img/top.png" alt="" srcset=""></span></a>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/controlador.js"></script>
</body>
</html>