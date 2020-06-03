<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIND Register enterprise</title>
  <link rel="shortcut icon" href="img/carreta.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet"> 

</head>

<body style="background-image: url(img/back.jpg); background-repeat: no-repeat; background-size: cover; ">
  <div style="background-color:#0b633e93;width: 100%;height: 100%;">
  <header>
    <nav>
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <img src="img/LogoFind.png" style="width: 150px">
        <a class="btn btn-outline-primary ml-auto" href="../PerfilEmpresa/index.php">Regresar Perfil</a>
      </div>
    </nav>
  </header>

  
  <div class="form wrapper fadeInDown" style="font-family: 'Comic Neue', cursive;">
    <h1 style="text-align: center; margin-top: 100px; color:  #f9a826;" class="display-4">We will grow together!</h1>
    <hr class="hr mx-5">
    <div id="formContent">
    <input style="display: none" type="text" id="id" value="<?php echo $_COOKIE["id"] ?>">
      <div class="fadeIn first">
        <h1>Sign In</h1>
      </div>
      <form id="formCompany">
        <input type="text" id="nameEnterprise" onkeyup="validarLlenado(this)" name="nameEnterprise" placeholder="Name of the enterprise">
        <div class="advice">Descripción</div>
        <textarea  name="descriptionEnterprise" onkeyup="validarLlenado(this)" class="second" id="descriptionEnterprise" cols="40" rows="5"></textarea>
        <div class="advice">Foundation date</div>
        <input type="date" id="fundationDate" onkeyup="validarLlenado(this)" name="fundationDate" placeholder="Foundation date">
        <div class="advice">Email</div>
        <input type="text" id="emailEnterprise" onkeyup="validarEmail(this)" name="emailEnterprise" placeholder="enterprise@enterprise.com">
        <div class="advice">* Must contain more than 8 characters, at least 1 digit and at least one uppercase letter.</div>
        <input type="password" id="passwordEnterprise" onkeyup="validarPassword(this)" name="passwordEnterprise" placeholder="Password">
        <div class="advice2">Postal Code. Enter no more or less 3 digits.</div>
        <input type="text" id="postalCode" onkeyup="validarPostal(this)" name="postalCode" placeholder="Postal Code">
        <select name="country" class="second" id="country">
          <option value="">Seleccione su pais</option>
          <option value="Alemania">Alemania</option>
          <option value="Argentina">Argentina</option>
          <option value="Australia">Australia</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bélgica">Bélgica</option>
          <option value="Belice">Belice</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Brasil">Brasil</option>
          <option value="Canadá">Canadá</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Colombia">Colombia</option>
          <option value="Corea">Corea</option>
          <option value="Corea">Corea del Norte</option>
          <option value="Costa">Costa Rica</option>
          <option value="Cuba">Cuba</option>
          <option value="Ecuador">Ecuador</option>
          <option value="El">El Salvador</option>
          <option value="España">España</option>
          <option value="Estados">Estados Unidos</option>
          <option value="Francia">Francia</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Holanda">Holanda</option>
          <option selected value="Honduras">Honduras</option>
          <option value="Hong">Hong Kong</option>
          <option value="Israel">Israel</option>
          <option value="Italia">Italia</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Japón">Japón</option>
          <option value="Jordania">Jordania</option>
          <option value="México">México</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Nueva">Nueva Zelanda</option>
          <option value="Panamá">Panamá</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Perú">Perú</option>
          <option value="Portugal">Portugal</option>
          <option value="Puerto">Puerto Rico</option>
          <option value="Reino">Reino Unido</option>
          <option value="Rusia">Rusia</option>
          <option value="Suecia">Suecia</option>
          <option value="Suiza">Suiza</option>
          <option value="Uruguay">Uruguay</option>
          <option value="Venezuela">Venezuela</option>
        </select>
        <input type="text" id="state" onkeyup="validarLlenado(this)" name="state" placeholder="State or deparment">
        <input type="text" id="addressEnterprise" onkeyup="validarLlenado(this)" name="addressEnterprise" placeholder="Adress">
        <div class="advice2">Phone. * Neither more nor less than 8 digits.</div>
        <input type="text" id="phoneNumberEnterprise" onkeyup="validarPhone(this)" name="phoneNumberEnterprise" placeholder="XXXX-XXXX">
        <div class="advice2">Latitude and longitude</div>
        <input type="text" name="latitute" onkeyup="validarLatitud(this)" id="latitute" placeholder="[±0-90.000]">
        <input type="text" name="longitude" onkeyup="validarLongitud(this)" id="longitude" placeholder="[±0-180.000]">
        <div style="margin-top: 20px;" class="custom-file">
          <input type="file" class="custom-file-input" onchange="subirImagen()" name="urlProfileImage" id="urlProfileImage" required>
          <label class="custom-file-label" for="customFile" id="file-label1"></label>
        </div>
        <div class="advice" >Upload a profile picture</div></br>
        <div class="custom-file">
          <input type="file" class="custom-file-input" onchange="subirBanner()" name="urlBanner" id="urlBanner" required>
          <label class="custom-file-label" for="customFile" id="file-label2"></label>
        </div>
        <div class="advice">Upload a banner</div></br>
        <button type="button" onclick="actualizar();" id="btn-actualizar" class="btn-save-changes">Actualizar</button><br>
        <div id="loading" style="display: none;"class="spinner-grow" role="status">
          <span  class="sr-only">Loading...</span>
        </div>
        <input id="key" type="hidden">
        <div id="msjError" style="display: none; color: red;">Error, one or more fields are empty, please check.</div>
        <div id="msjActualizado" style="display: none; color: green;">Your data has been updated successfully! <i class="fas fa-check-circle"></i></div>  
        <a href="../PerfilEmpresa/index.php" style="color: #0e7248">Regresar a mi perfil</a>
      </div>
   

    <footer class="pt-4 my-md-5 pt-md-5">
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
  </div>
    <a class="back-to-top"><img src="img/top.png" alt="" srcset=""></span></a>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/controladorEditar.js"></script>
  </div>
  </div>
</body>
</html>