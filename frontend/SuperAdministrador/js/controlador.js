usuarios=[{
    imgPerfil:"img/perfil-mujer.jpg",
    name:"Elizabeth Molina",
    birthday:"23-09-1990",
    address:"Col. Morazán",
    phone:"9898-2012",
    email:"elizabethm@gmail.com",
    contrasenia:"contrasenia12",
    card:"0010-2891-2791-8921",
},{
    imgPerfil:"img/perfil-hombre.jpg",
    name:"Santiago Reyes",
    birthday:"20-03-1980",
    address:"Col. San Francisco",
    phone:"9679-0293",
    email:"santiagor@gmail.com",
    contrasenia:"contrasenia12",
    card:"0010-2432-2902-8932",
},{
    imgPerfil:"img/perfil-hombre-2.jpg",
    name:"Carlos Girón",
    birthday:"13-11-1985",
    address:"Col. Villa Real",
    phone:"9432-4782",
    email:"carlosg@gmail.com",
    contrasenia:"contrasenia12",
    card:"0010-3131-2711-2935",
}];

perfilesEmpresas = [{
    img: "img/lacost.jpg",
    nombre: "Lacost",
    direccion: "Tegucigalpa",
    telefono: "2203-9281",
    email: "lacost@gmail.com",
    description:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ullam."
  }, {
    img: "img/dell.png",
    nombre: "DELL",
    direccion: "Tegucigalpa",
    telefono: "2205-9541",
    email: "dell@gmail.com",
    description:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ullam."

  }, {
    img: "img/whirlpool.png",
    nombre: "Whirlpool",
    direccion: "Tegucigalpa",
    telefono: "2003-1221",
    email: "whirlpool@gmail.com",
    description:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ullam."

  }, {
    img: "img/HM.jpg",
    nombre: "HM",
    direccion: "Tegucigalpa",
    telefono: "2206-0001",
    email: "HM@gmail.com",
    description:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ullam."

  },
  {
    img: "img/diunsa.png",
    nombre: "Diunsa",
    direccion: "Tegucigalpa",
    telefono: "2232-0201",
    email: "diunsa@gmail.com",
    description:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ullam."

  }];

  function verEmpresas() {
    document.getElementById('area').innerHTML = ''
    for (i = 0; i < perfilesEmpresas.length; i++) {
      document.getElementById('area').innerHTML += `
      <div class="col-xl-3 col-lg-4 col-mol-6 col-12">
      <div class="row row-cols-1 row-cols-md-2" >
      <div class="col mb-4">
        <div class="card" style="font-family: 'Comic Neue', cursive; border-color:white;">
          <img style="height:150px; width: 230px;" src="${perfilesEmpresas[i].img}" class="card-img-top" alt="...">
          <hr>
          <div class="card-body">
          <h5 class="card-title"><b>${perfilesEmpresas[i].nombre}</b></h5>
          <p class="card-text">Address: ${perfilesEmpresas[i].direccion}<br>Phone: ${perfilesEmpresas[i].telefono}<br>Email: ${perfilesEmpresas[i].email}</p>
          <p class="card-text">Description: ${perfilesEmpresas[i].description}</p>
          <hr>
          </div>
        </div>
      </div>
      </div>
      </div>
          `
    }
  }


  function verUsuarios(){
    document.getElementById('area').innerHTML = ''
    for (i = 0; i < usuarios.length; i++) {
      document.getElementById('area').innerHTML += `
      <div class="col-xl-3 col-lg-4 col-mol-6 col-12">
      <div class="row row-cols-1 row-cols-md-2" >
      <div class="col mb-4">
        <div class="card" style="font-family: 'Comic Neue', cursive; border-color:white;">
          <img style="height:150px; width: 180px;" src="${usuarios[i].imgPerfil}" class="card-img-top" alt="...">
          <hr>
          <div class="card-body">
          <h5 class="card-title"><b>${usuarios[i].name}</b></h5>
          <p class="card-text">Address: ${usuarios[i].address}<br>Phone: ${usuarios[i].phone}<br>Email: ${usuarios[i].email}</p>
          <p >Card: ${usuarios[i].card}</p>
          <hr>
          </div>
        </div>
      </div>
      </div>
      </div>
          `
  }
}