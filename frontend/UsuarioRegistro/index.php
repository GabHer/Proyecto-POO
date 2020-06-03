<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIND Register client</title>
  <link rel="shortcut icon" href="img/carreta.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet">
</head>

<body style="background-image: url(img/backF.jpg); background-repeat: no-repeat; background-size: cover;">
  <div style="background-color:#0b633e93;width: 100%;height: 100%;">
  <header>
    <nav>
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <img src="img/LogoFind.png" style="width: 150px">
        <a class="btn btn-outline-primary ml-auto" href="../PerfilUsuario/index.php">Regresar Perfil</a>
      </div>
    </nav> 
  </header>

  <div class="form wrapper fadeInDown" style="font-family: 'Comic Neue', cursive;">
    <div id="descripcion">
      <h1 style="text-align: center; margin-top: 100px;" class="display-4">Everything you want is here!</h1>
      <hr class=" mx-5">
    </div>
    <div id="formContent">
    <input style="display: none" type="text" id="id" value="<?php echo $_COOKIE["id"] ?>">
      <div><h1 style="color: white;">Sing In</h1></div>
      <form id="formUser">
        <input type="text" id="name" onkeyup="validarLlenado(this)"  name="name" placeholder="Name">
        <input type="text" id="lastName" onkeyup="validarLlenado(this)" name="lastName" placeholder="Last Name"><br>
        <div class="advice">Birthday</div>
        <input type="date" id="birthday" name="birthday" placeholder="Birthday">
        <select id="gender" name="gender" class="select-gender second">
          <option value="gender">Gender</option>
          <option value="Femenino">Female</option>
          <option value="Masculino">Male</option>
        </select>
        <div class="advice">Postal Code. Enter no more or less 3 digits.</div>
        <input type="text" id="postal" onkeyup="validarPostal(this)" name="postal" placeholder="Postal code">
        <select name="country" id="country">
          <option value="select">Select country</option>
          <option value="Argentina">Argentina</option>
          <option value="Brasil">Brasil</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Colombia">Colombia</option>
          <option value="Corea del Sur">Corea del Sur</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Dominica">Dominica</option>
          <option value="EUA">EUA</option>>
          <option value="El Salvador">El Salvador</option>
          <option value="Ecuador">Ecuador</option>
          <option value="España">España</option>
          <option value="Francia">Francia</option>
          <option value="Guatemala">Guatemala</option>>
          <option value="Holanda">Holanda</option>
          <option value="Honduras" selected>Honduras</option>
          <option value="Hong Kong">Hong Kong</option>>
          <option value="Inglaterra">Inglaterra</option>
          <option value="Italia">Italia</option>
          <option value="Japón">Japón</option>
          <option value="Luxenburgo">Luxenburgo</option>
          <option value="México">México</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Panamá">Panamá</option>
          <option value="Perú">Peru</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Portugal">Portugal</option>
          <option value="Rep. Dominicana">Rep. Dominicana</option>
          <option value="Rusia">Rusia</option>
          <option value="Singapur">Singapur</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Uruguay">Uruguay</option>
          <option value="Venezuela">Venezuela</option>
        </select>
        <input type="text" id="state" onkeyup="validarLlenado(this)" name="state" placeholder="State or deparment">
        <input type="text" id="address" onkeyup="validarLlenado(this)" name="address" placeholder="Address">
        <div class="advice">Phone. * Neither more nor less than 8 digits.</div>
        <input type="text" id="phone" onkeyup="validarPhone(this)" name="phone" placeholder="XXXX-XXXX">
        <div class="advice">Email</div>
        <input type="text" id="email" name="email" onkeyup="validarEmail(this)" placeholder="email">
        <div class="advice">* Must contain more than 8 characters, at least 1 digit and at least one uppercase letter.</div>
        <input type="password" id="password" onkeyup="validarPassword(this)" name="password" placeholder="Password" required></br>
        <h1>Credit / Debit Card</h1>
        <input type="text" id="nameOwner" onkeyup="validarLlenado(this)" name="nameOwner" placeholder="Owner">
        <div class="advice">Card credit / debit card number</div>
        <input type="text" id="creditNumber" onkeyup="validarCard()" name="creditNumber"  placeholder="XXXX-XXXX-XXXX-XXXX" required>
        <div class="advice">Expiration date</div>
        <input type="date" id="expirationDate" name="expirationDate" placeholder="Expiration date">
        <div class="advice">CVV, entre 3 y 4 digitos.</div>
        <input type="text" id="cvv" onkeyup="validarCvv(this)" class="fadeIn second" name="cvv" placeholder="CVV">
        <div class="advice" style="margin: 10px 0px 0px;">Upload a profile picture</div></br>
        <div class="custom-file">
          <input type="file" class="custom-file-input" onchange="subirImagen()" name="urlProfileImage" id="urlProfileImage">
          <label class="custom-file-label" for="customFile" id="file-label"></label>
        </div>
        <div class="small-image-profile"  id="smallImage">
        </div>
        <div style="padding-top: 15px;">Before registering, check that no field is incorrect!</div>
        <button id="btn-register" type="button" onclick="registrarUsuario()" class="fourth" value="Registrar">Registrar</button>
        <button id="btn-actualizar" type="button" onclick="actualizar()" class="fourth" style="display:none;">Actualizar</button>
        <div id="loading" style="display: none;"class="spinner-grow" role="status">
          <span  class="sr-only">Loading...</span>
        </div><br>
        <input id="key" type="hidden">
        <div id="msjError" style="display: none; color: red;">Error, one or more fields are empty, please check.</div>
        <div id="msjActualizado" style="display: none; color: green;">Your data has been updated successfully! <i class="fas fa-check-circle"></i></div>
        <a href="../PerfilUsuario/index.php" style="color: #0e7248">Regresar a mi perfil</a>
    </div>

    <footer class="pt-4 my-md-5 pt-md-5 ">
      <div class="row">
        <div class="col-12 col-md">
          <small class="d-block mb-3 text-muted">&copy; Copyright 2020 Find</small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Resource</a></li>
            <li><a class="text-muted" href="#">Resource name</a></li>
            <li><a class="text-muted" href="#">Another resource</a></li>
            <li><a class="text-muted" href="#">Final resource</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Team</a></li>
            <li><a class="text-muted" href="#">Locations</a></li>
            <li><a class="text-muted" href="#">Privacy</a></li>
            <li><a class="text-muted" href="#">Terms</a></li>
          </ul>
        </div>
      </div>
      <table id="tbl-logos">
        <tr>
          <td>
            <img src="img/facebook.png" alt="">
            <img src="img/twitter.png" alt="">
            <img src="img/instagram.png" alt="">
            <img src="img/pinterest.png" alt="">
          </td>
        </tr>
      </table>
    </footer>

    <a class="back-to-top"><img src="img/top.png" alt="" srcset=""></a>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/controladorEditar.js"></script>
  </div>
  
  </div>
</body>

</html>