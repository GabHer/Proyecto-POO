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
    <link rel="shortcut icon" href="img/carreta.png">
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet"> 

    <title></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f9a826!important;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="img/LogoFind.png" style="width: 150px">
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <form class="form-inline my-lg-0 ml-auto">
        <a class="btn btn-outline-primary ml-auto" href="../PerfilEmpresa/index.php"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
        <a type="button" style="color: white;" onclick="imprimir();" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Print product">
            <span> <i class="fas fa-print fa-3x"></i></span></a> 
        </form>
      </div>
    </nav>

    <div class="container jumbotron shadow" style="font-family: 'Comic Neue', cursive;">
    <input type="text" style="display: none" id="id" value="<?php echo $_COOKIE["id"] ?>">
        <div style= "text-align:center; font-family: 'Comic Neue', cursive;" class="m-auto">
            <h3 id="msj" style="color: #0e7248"><b>Seleccione un producto para generar la ficha</b></h3>
            <select onchange="generarInfo();" style="background-color: white" name="idProductQr" id="idProductQr" >
            <option value="">Select</option>
        </select><br>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6 col-md-3 col-12">
            <div style="margin-top: 30px" id="imgProduct"></div>
            <div style="margin-left: 25px" id="qr"></div>
            </div>
            <div class="col-lg-8 col-xs-8 col-md-8 col-12">
            <div id="space" style="margin-left: 100px; margin-top:30px; display:none">
                <div id="discount"><h4  style="color: red; font-size: 100px; text-align: center;"></h4></div>
                <h3 style="margin-left: 50px;" id="name"><b>Description</b></h3>
                <p style="text-align: justify; margin-left: 50px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio saepe dicta eius pariatur fugiat eum nemo nesciunt sequi consequuntur maiores iste aspernatur aperiam, distinctio accusamus modi deserunt facilis? Error fugiat eum sed eius officia illum saepe necessitatibus, magni itaque totam iure dolores sit dolore doloremque et voluptates minima nobis molestias aliquam in! Dolorum distinctio necessitatibus quo, voluptatem illo consequatur natus!</p>
                <div style="text-align: center;"><img src="" alt="" srcset=""></div>
                <div id="category"><h4 style="text-align: center;">Category: </h4></div>
                <div id="priceProduct"><h4 style="text-align: center;">Precio normal: $<s></s></h4></div>
                <div id="discountPromo"><h4 style="text-align: center;">Precio con descuento: </h4></div>
                <div id="sucursal"><h4 style="text-align: center;">Sucursales:<br> <li></li> </h4></div>
            </div>
            </div>
        </div>
    </div>


    </div>
    
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/qrcode.js"></script>
    <script src="js/controladorFicha.js"></script>
    
</body>
</html>