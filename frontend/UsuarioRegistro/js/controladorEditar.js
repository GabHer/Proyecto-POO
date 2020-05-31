var nameImg;
var profile;
var id= document.getElementById('id').value;
/*Petición para editar la cuenta de usuario*/
    axios({
        url:'../../backend/api/usuarios.php?idUsuario='+id,
        method: 'GET',
        dataType: 'json'
    }).then((res)=>{
        console.log(res);
        document.getElementById('name').value = res.data.name;
        document.getElementById('lastName').value = res.data.lastName;
        document.getElementById('birthday').value = res.data.birthday;
        document.getElementById('gender').value = res.data.gender;
        document.getElementById('postal').value = res.data.postal;
        document.getElementById('country').value = res.data.country;
        document.getElementById('state').value = res.data.state;
        document.getElementById('address').value = res.data.address;
        document.getElementById('phone').value = res.data.phone;
        document.getElementById('email').value = res.data.email;
        document.getElementById('nameOwner').value = res.data.nameOwner;
        document.getElementById('creditNumber').value = res.data.creditNumber;
        document.getElementById('expirationDate').value = res.data.expirationDate;
        document.getElementById('cvv').value = res.data.cvv;
        document.getElementById('key').value = id;
        verImagen(res.data.urlProfileImage);
        profile = res.data.urlProfileImage;
        $("#btn-register").hide();
        $("#btn-actualizar").show();
    }).catch((error)=>{
        console.error(error);
    });

/*Función para actualizar la cuenta del usuario */
function actualizar(){
    $("#loading").show();
    let img;
    list=[
        validarCampoVacio('name'),
        validarCampoVacio('lastName'),
        validarCampoVacio('birthday'),
        validarCampoVacio('gender'),
        validarCampoVacio('postal'),
        validarCampoVacio('country'),
        validarCampoVacio('state'),
        validarCampoVacio('address'),
        validarCampoVacio('phone'),
        validarCampoVacio('email'),
        validarCampoVacio('password'),
        validarCampoVacio('nameOwner'),
        validarCampoVacio('creditNumber'),
        validarCampoVacio('expirationDate'),
        validarCampoVacio('cvv')];

    if (!validarCampoVacioImg('urlProfileImage')){
        img=profile;
    }else{
        img= `img/${nameImg}`;
    }
    
    let persona= {
        name: document.getElementById('name').value,
        lastName:document.getElementById('lastName').value,
        birthday:document.getElementById('birthday').value,
        gender:document.getElementById('gender').value,
        postal: document.getElementById('postal').value,
        country: document.getElementById('country').value,
        state: document.getElementById('state').value,
        address: document.getElementById('address').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        nameOwner: document.getElementById('nameOwner').value,
        creditNumber: document.getElementById('creditNumber').value,
        expirationDate: document.getElementById('expirationDate').value,
        cvv: document.getElementById('cvv').value,
        urlProfileImage: img
    }

    var contador=0;
    for(let i=0; i<list.length; i++){
        if(list[i]==true){
            contador= contador+1;
        }
    }
    if(contador == 15){
    axios({
        url:'../../backend/api/usuarios.php?idUsuario='+document.getElementById('key').value,
        method:'put',
        data: persona,
        dataType:'json'
    }).then((res)=>{
        console.log(res);
        $("#loading").hide();
        document.getElementById('msjError').style.display = 'none';
        $("#msjActualizado").show();
    }).catch((error)=>{
        console.error(error);
    });
    }else{
    document.getElementById('msjError').style.display = 'block';
    $("#loading").hide();
}
}

function validarCard(){
    if(document.getElementById('creditNumber') != ''){
        validarCreditVisa(document.getElementById('creditNumber'));
    }else{
        validarCreditMastercard(document.getElementById('creditNumber'));
    }
}

function validarPassword(password){
    let re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if(re.test(password.value)){
        password.classList.remove('inError');
        password.classList.add('inSuccess');
    }else{
        password.classList.add('inError');
        password.classList.remove('inSuccess');
        
    }
    
}

function validarEmail(email){
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email.value)){
        email.classList.remove('inError');
        email.classList.add('inSuccess');
    }else{ 
        email.classList.remove('inSuccess');
        email.classList.add('inError'); 
    }
}

function validarPostal(postal){
    let re =/^[0-9]{3}$/;
    if(re.test(postal.value)){
        postal.classList.remove('inError');
        postal.classList.add('inSuccess');
    }else{
        postal.classList.add('inError');
        postal.classList.remove('inSuccess');
        
    }
}

function validarPhone(phone){
    let re =/^[1-9][0-9]{7}$/;
    if(re.test(phone.value)){
        phone.classList.remove('inError');
        phone.classList.add('inSuccess');
    }else{
        phone.classList.add('inError');
        phone.classList.remove('inSucces');
    }
}
function validarCreditVisa(credit){
    let re =/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/;
    if(re.test(credit.value)){
        credit.classList.remove('inError');
        credit.classList.add('inSuccess');
    }else{
        credit.classList.remove('inSuccess');
        credit.classList.add('inError');
        
    }
}
function validarCreditMastercard(credit){
    let re =/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/;
    if(re.test(credit.value)){
        credit.classList.remove('inError');
        credit.classList.add('inSuccess');
    }else{
        credit.classList.add('inError');
        credit.classList.remove('inSuccess');
    }
    
}
function validarCvv(cvv){
    let re =/^[0-9]{3,4}$/;
    if(re.test(cvv.value)){
        cvv.classList.remove('inError');
        cvv.classList.add('inSuccess');
    }else{
        cvv.classList.add('inError');
        cvv.classList.remove('inSuccess');
    }
}

function validarCampoVacio(id){
    if (document.getElementById(id).value == ''){
        document.getElementById(id).classList.remove('inSuccess');
        document.getElementById(id).classList.add('inError');
        return false;
    }else{ 
        document.getElementById(id).classList.remove('inError');
        document.getElementById(id).classList.add('inSuccess');
        return true;
    }
}

function validarCampoVacioImg(id){
    if (document.getElementById(id).value == ''){
        return false;
    }else{ 
        return true;
    }
}

function validarLlenado(id){
    if((id.value)==""){
        id.classList.add('inError');
        id.classList.remove('inSuccess');
    }else{
        id.classList.remove('inError');
        id.classList.add('inSuccess');

    }
}

function verImagen(url){
    document.getElementById("smallImage").innerHTML=`<img id="smallI" src="../PerfilUsuario/${url}">`;
    
}

function subirImagen(){  
    if(document.getElementById("urlProfileImage").value!=""){
        var formData = new FormData();
        var files = $('#urlProfileImage')[0].files[0];
        formData.append('file',files);
        axios({
            url: '../../backend/api/uploaderUsuario.php',
            method: 'POST',
            data: formData,
        }).then((res)=>{
            console.log(res);
            updateFilename();
        }).catch((error)=>{
            console.error(error);
        });
    }
    
}

// Funcion para extraer el nombre de la imagen
function updateFilename(){
    document.getElementById('smallImage').style.display= 'none'
    path=document.getElementById('urlProfileImage').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        nameImg = path.substr(12); // modern browser
    document.getElementById('urlProfileImage').textContent = nameImg;
    console.log(nameImg);
}
//--Fin

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