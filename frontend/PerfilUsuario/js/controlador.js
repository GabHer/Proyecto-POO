var id = document.getElementById('id').value;
/*Petición para generar los datos correspondientes del usuario */
axios({
  url:'../../backend/api/usuarios.php?idUsuario='+id,
  method: 'GET',
  dataType: 'json'
}).then((res)=>{
  document.getElementById('perfil').innerHTML = `<img class="img-fluid img-thumbnail rounded-circle" style="height: 300px; width: 300px;" src="${res.data.urlProfileImage}" alt="" srcset="">`
  document.getElementById('information').innerHTML = ` <h3><b>Name:</b> ${res.data.name}; <b>Lastname:</b> ${res.data.lastName};  <b>Birthday:</b> ${res.data.birthday}; <b>Country:</b> ${res.data.country};  <b>Address:</b> ${res.data.address};    <b>Phone:</b> ${res.data.phone};    <b>Email:</b> ${res.data.email};   <b>Card:</b> ${res.data.creditNumber}</h3>`;
  document.getElementById('user').innerHTML = `<h1  class="display-4 letter" style="color: #f9a826;"> ${res.data.name} ${res.data.lastName}</h1>`;
} ).catch((error)=>{
  console.error(error);
});

/*Función que genera todos los perfiles de empresas registradas*/
function verPerfilesEmpresas() {
  document.getElementById('area').innerHTML = '';
  axios({
    url:'../../backend/api/empresas.php',
    method: 'GET',
    dataType: 'json'
  }).then((res)=>{
  console.log(res.data);
  for(let llave in res.data){
    document.getElementById('area').innerHTML += `
    <div class="col-xl-3 col-lg-4 col-mol-6 col-12 cardE" style="border-radius: 10px;">
    <div class="row row-cols-1 row-cols-md-2" >
    <div class="col mb-4">
      <div class="card " style="font-family: 'Comic Neue', cursive; margin-top:5px">
      <img style="height:150px; width: 240px; border-radius: 10px 10px 0px 0px;" src="../PerfilEmpresa/${res.data[llave].urlProfileImage}" class="card-img-top" alt="...">
      <div class="card-body ">
      <h5 class="card-title"><b>${res.data[llave].nameEnterprise}</b></h5>
      <hr>
      <p class="card-text">Dirección: ${res.data[llave].addressEnterprise}<br>Telefono: ${res.data[llave].phoneNumberEnterprise}<br>Email: ${res.data[llave].emailEnterprise}</p>
      <div  class="text-center"><a onclick="agregarEmpresaFav('${llave}')"><i id="iconHeart${llave}" style="color:red;  display: inline;" class=" fas fa-heart heart fa-2x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to favorites""></i></a></div>
      <div class="text-center" id="loadingFav${llave}" style="display: none; color:#0b633e;">
          <span >Loading...</span>
      </div><br>
      <div id="msjIcon${llave}" class="text-center" style="display:none; color:#0b633e;"><b>¡Agregada a favoritas!</b><div>
      </div>
      </div>
    </div>
    </div>

      <ul style="color:white; font-size: 20px; text-align: center" onclick="productsEnterprise('${llave}')" class=" ml-auto">
      See Products</ul>
    </div>
        `
      }
  }).catch((error)=>{
    console.error(error);
  });
}

/*Función para agregar empresas a favoritas*/
function agregarEmpresaFav(idEmpresa){
  var empresa;
  document.getElementById(`loadingFav${idEmpresa}`).style.display ='inline';
  document.getElementById(`iconHeart${idEmpresa}`).style.color = '#0b633e';
  axios({
    url:'../../backend/api/empresas.php',
    method: 'GET',
    dataType: 'json'
  }).then((res)=>{
  console.log(res.data);
      for(let i in res.data){
        if(i==idEmpresa){
          empresa ={
            nameEnterprise: res.data[i].nameEnterprise,
            descriptionEnterprise: res.data[i].descriptionEnterprise,
            fundationDate: res.data[i].fundationDate,
            emailEnterprise: res.data[i].emailEnterprise,
            passwordEnterprise: res.data[i].passwordEnterprise,
            postalCode: res.data[i].postalCode,
            country: res.data[i].country,
            state: res.data[i].state,
            addressEnterprise: res.data[i].addressEnterprise,
            phoneNumberEnterprise: res.data[i].phoneNumberEnterprise,
            latitute: res.data[i].latitute,
            longitude: res.data[i].longitude,
            urlProfileImage:res.data[i].urlProfileImage,
            urlBanner: res.data[i].urlBanner
          }
          axios({
            url:'../../backend/api/empresasFavoritas.php?idUsuario='+id,
            method: 'post',
            dataType: 'json',
            data: empresa
          }).then((resp)=>{
            console.log(resp.data);
            document.getElementById(`loadingFav${idEmpresa}`).style.display ='none';
            document.getElementById(`iconHeart${idEmpresa}`).style.display= 'none';
            document.getElementById(`msjIcon${idEmpresa}`).style.display= 'inline';
          }).catch((error1)=>{
            console.error(error1);
          });

        }
      }
      
  }).catch((error2)=>{
    console.error(error2);
  });

}

/*Función generar el area de favoritos*/
function favEmpresasPromo() {
  document.getElementById('area').innerHTML = '';
  document.getElementById('area').innerHTML = `
  <div class="container-fluid ">
  <div class="row">
  <div class="btn-group m-auto"  style="margin-left:50px;" role="group" aria-label="Basic example">
    <button onclick="favEmpresas()" type="button" class="btn btn-secondary">Empresas</button>
    <button onclick="favPromo()" type="button" class="btn btn-secondary">Promociones</button>
    <div id="loadingArea2" style="display: none;" class="spinner-border" role="status">
            <span  class="sr-only">Loading...</span>
    </div><br>
    </div>
    </div>
    <div class="row" style="margin-top: 60px;" id="area2">
  </div>
  </div>
  `;
}

/*Función para generar las empresas favoritas del usuario*/
function favEmpresas() {
  document.getElementById('area2').innerHTML = "";
  document.getElementById('loadingArea2').style.display= 'inline';
  axios({
    url:'../../backend/api/empresasFavoritas.php?idUsuario='+id,
    method: 'get',
    dataType: 'json',
  }).then((resp)=>{
    console.log(resp.data);
    for (let i in resp.data) {
    document.getElementById('loadingArea2').style.display= 'none';
      document.getElementById('area2').innerHTML += `
      <div class="col-xl-3 col-lg-4 col-mol-6 col-12">
      <div class="row row-cols-1 row-cols-md-2" >
      <div class="col mb-4">
        <div class="card" style="font-family: 'Comic Neue', cursive;">
          <img style="height:150px; width: 240px;" src="../PerfilEmpresa/${resp.data[i].urlProfileImage}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><b>${resp.data[i].nameEnterprise}</b></h5>
            <hr>
            <p class="card-text">Dirección: ${resp.data[i].addressEnterprise}<br>Telefono: ${resp.data[i].phoneNumberEnterprise}<br>Email: ${resp.data[i].emailEnterprise}</p>
          </div>
        </div>
      </div>
      </div>
      </div>
          `
    }

  }).catch((error)=>{
    console.error(error);
  });
}

/*Función para generar las promociones favoritas del usuario*/
function favPromo() {
  document.getElementById('area2').innerHTML = "";
  document.getElementById('loadingArea2').style.display= 'inline';
  axios({
    url:'../../backend/api/promocionesFavoritas.php?idUsuario='+id,
    method: 'get',
    dataType: 'json',
  }).then((res)=>{
    console.log(res.data);
    axios({
      url:'../../backend/api/empresas.php',
      method: 'GET',
      dataType: 'json'
    }).then((resp)=>{
    console.log(resp.data);
    for (let i in res.data) {
      for(let j in resp.data){
      if(j==res.data[i].idEnterprise){
          document.getElementById('loadingArea2').style.display= 'none';
          document.getElementById('area2').innerHTML += `
          <div class="col-xl-3 col-lg-4 col-mol-6 col-12">
          <div class="row row-cols-1 row-cols-md-2" >
          <div class="col mb-4">
            <div class="card" style="font-family: 'Comic Neue', cursive;">
              <img style="height:150px; width: 230px;" src="../PerfilEmpresa/${res.data[i].urlProductPromoImage}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><b>${res.data[i].products}</b></h5>
                <hr>
                <h6 class="card-title"><b>${resp.data[j].nameEnterprise}</b></h6>
                <p class="card-text">Categoría: ${res.data[i].selectCategory}<br>Precio: $${res.data[i].discountPromo}<br>Descripción: ${res.data[i].descriptionPromo}</p>
              </div>
            </div>
          </div>
          </div>
          </div>
              `
    }
  }
  }
  }).catch((error1)=>{
    console.error(error1);
  });
  }).catch((error2)=>{
    console.error(error2);
  });
}

/*Función que genera el mapa de promociones*/
function promEnGoogle() {
  document.getElementById('area').innerHTML = '';
  document.getElementById('area').innerHTML = `<div id="map" class="map">Encuentra las promociones más cerca de ti en GoogleMaps</div>`;
  var map = new ol.Map({
    target: 'map',
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      })
    ],
    view: new ol.View({
      center: ol.proj.fromLonLat([-87.2276534, 14.0571083]),
      zoom: 17
    })
  });

}

/*Función que genera los productos para visualizar por empresa*/
function productsEnterprise(indiceEnterprise){
  document.getElementById('modal-p').innerHTML="";
  document.getElementById('titulo').innerHTML= "";
  $('#modal-productsEnterprise').modal('show');
  axios({
    url:'../../backend/api/empresas.php?idEmpresa='+indiceEnterprise,
    method: 'GET',
    dataType: 'json'
  }).then((res)=>{
    document.getElementById('titulo').innerHTML= res.data.nameEnterprise;
  }).catch((error)=>{
    console.error(error);
  });
  axios({
    url:'../../backend/api/productos.php?idEmpresa='+indiceEnterprise,
    method: 'GET',
    dataType: 'json'
  }).then((res)=>{
  for (let llave in res.data) {
    document.getElementById('modal-p').innerHTML += `
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="../PerfilEmpresa/${res.data[llave].urlProductImage}" class="card-img" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 style="margin:0px;" class="card-title"><b>${res.data[llave].nameProduct}</b></h5>
          <p class="card-text">$ ${res.data[llave].priceProduct}<br>${res.data[llave].descriptionProduct}</p>
        </div>
      </div>
    </div>
  </div>
  <hr>`
  }}).catch((error)=>{
    console.error(error);
  });
}

/*Función para la opción de eliminar cuenta del usuario */
function eliminarUsuario(){
  document.getElementById('loadingEliminar').style.display='inline';
  axios({
    url:'../../backend/api/usuarios.php?idUsuario='+id,
    method: 'delete',
    dataType: 'json'
  }).then((res)=>{
    window.location.href= "../../backend/class/logout.php";
    console.log(res.data);
  }).catch((error)=>{
    console.error(error);
  });
}


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Código botón subir
jQuery('document').ready(function($){
  var subir = $('.back-to-top');
  subir.click(function(e){
      e.preventDefault();
      $('html, body').animate({scrollTop: 0}, 500);
  });
  subir.hide();
  $(window).scroll(function(){
      if( $(this).scrollTop() > 200 ) {
          subir.fadeIn();
      } else {
          subir.fadeOut();
      }
  });
  
});
// Termina código