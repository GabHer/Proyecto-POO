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
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" href="img/carreta.png">
    <title>Administrator</title>

</head>

<body style="font-family: 'Comic Neue', cursive;" >
    <header>
        <nav>
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom shadow-sm"
                style="background-color: #f9a826;">
                <img src="img/LogoFind.png" style="width: 150px">
                <a class="btn btn-outline-primary ml-auto" href="../../backend/class/logout.php">Cerrar sesión</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-6 col-md-3 col-12" style="margin-top: 180px;">
                <div class="container" style="text-align: center;">
                    <h1 class="display-4" style="color: #f9a826;">Super administrator</h1>
                    <hr style="background-color: #f9a826;">
                    <button type="button" onclick="edit()" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                        data-html="true" title="<b>Edit profile</b>">
                        <span> <i class="far fa-address-card fa-3x"></i></span>
                    </button>
                    <button type="button" onclick="verUsuarios();" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                        data-html="true" title="<b>Registered users</b>">
                        <span> <i class="fas fa-users fa-3x"></i></span>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="verEmpresas();" data-toggle="tooltip" data-placement="bottom"
                        data-html="true" title="<b>Registered enterprise</b>">
                        <span><i class="far fa-building fa-3x"></i></span>
                    </button>
                    <input style="display: none" type="text" id="id" value="<?php echo $_COOKIE["id"]?>">
                    
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 100px; margin-left: 20px;" id="area">
            <div class="accordion" id="accordionExample">
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
                        <div class="card-body">
                            <div class="row">
                            <span><i class="fas fa-thumbtack"></i></span>Misión: Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse autem eum nobis asperiores quibusdam tenetur, totam ducimus et dolor, similique dicta eaque suscipit, voluptate pariatur minima. Eaque itaque id deserunt!<br>
                            <span><i class="fas fa-thumbtack"></i></span>Procedimientos: Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            <span><i class="fas fa-thumbtack"></i></span>Reglas:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            <span><i class="fas fa-thumbtack"></i></span>Politicas:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            <span><i class="fas fa-thumbtack"></i></span>Objetivos:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            <span><i class="fas fa-thumbtack"></i></span>Metas:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Plans
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body" >
                            <span><i class="fas fa-thumbtack"></i></span>Plan 1: Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse autem eum nobis asperiores quibusdam tenetur, totam ducimus et dolor, similique dicta eaque suscipit, voluptate pariatur minima. Eaque itaque id deserunt!<br>
                            <span><i class="fas fa-thumbtack"></i></span>Plan 2: Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                            <span><i class="fas fa-thumbtack"></i></span>Plan 3:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Reminders
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body" >
                        <span><i class="fas fa-thumbtack"></i></span>1: Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse autem eum nobis asperiores quibusdam tenetur, totam ducimus et dolor, similique dicta eaque suscipit, voluptate pariatur minima. Eaque itaque id deserunt!<br>
                        <span><i class="fas fa-thumbtack"></i></span>2: Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
                        <span><i class="fas fa-thumbtack"></i></span>3:Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ducimus atque quas aspernatur quo dolor nam autem earum natus eveniet maiores fugiat, eos ab ratione ea eaque at, hic numquam.<br>
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
    <script src="js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/controlador.js"></script>
</body>

</html>