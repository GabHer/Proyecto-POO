function verEmpresas() {
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
      <div class="card " style="font-family: 'Comic Neue', cursive; margin-top:5px; border-color: white">
      <img style="height:150px; width: 240px; border-radius: 10px 10px 0px 0px;" src="../PerfilEmpresa/${res.data[llave].urlProfileImage}" class="card-img-top" alt="...">
      <div class="card-body ">
      <h5 class="card-title"><b>${res.data[llave].nameEnterprise}</b></h5>
      <hr>
      <p class="card-text">Dirección: ${res.data[llave].addressEnterprise}<br>Telefono: ${res.data[llave].phoneNumberEnterprise}<br>Email: ${res.data[llave].emailEnterprise}</p>
      <h6><b>Plan Adquirido: $29/mo</b></h6>
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

function verUsuarios(){
    document.getElementById('area').innerHTML = ''
    axios({
      url:'../../backend/api/usuarios.php',
      method: 'GET',
      dataType: 'json'
    }).then((res)=>{
    console.log(res.data);
    document.getElementById('area').innerHTML = ''
    for(let llave in res.data){
      document.getElementById('area').innerHTML += `
      <div class="col-xl-3 col-lg-4 col-mol-6 col-12">
      <div class="row row-cols-1 row-cols-md-2" >
      <div class="col mb-4">
        <div class="card" style="font-family: 'Comic Neue', cursive; border-color:white;">
          <img style="height:150px; width: 180px;" src="../PerfilUsuario/${res.data[llave].urlProfileImage}" class="card-img-top" alt="...">
          <hr>
          <div class="card-body">
          <h5 class="card-title"><b>${res.data[llave].name} ${res.data[llave].lastName}</b></h5>
          <p class="card-text">Address: ${res.data[llave].address}<br>Phone: ${res.data[llave].phone}<br>Email: ${res.data[llave].email}</p>
          <p >Card: ${res.data[llave].creditNumber}</p>
          <hr>
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

function edit(){
  document.getElementById('area').innerHTML = '';
  document.getElementById('area').innerHTML = `
  <div class="card " style="width: auto; margin: auto auto">
  <div class="card-body tex-center">
    <h6 style="color: #0e7248">Introduzca su nueva contraseña</h6><br>
    <input class="form-control" id="passwordSuperAdmin" type="password" ><br>
    <button style="width: auto; margin: 20px" type="button" onclick="actualizar();" class="btn btn-secondary">Actualizar contraseña</button>
    <div class="text-center" id="msjActualizado" style="display: none; color: green;"><i class="fas fa-check-circle"></i></div>
  </div>
</div>
  `
}

function actualizar(){
  let password={
    email:"superAdmin@find.com",
    password:document.getElementById('passwordSuperAdmin').value
  }

  axios({
    url:'../../backend/api/superAdmin.php?idSuperAdmin='+document.getElementById('id').value,
    method: 'put',
    dataType: 'json',
    data: password
  }).then((res)=>{
  console.log(res.data);
  document.getElementById('msjActualizado').style.display='inline';

  }).catch((error)=>{
    console.error(error);
  });
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})