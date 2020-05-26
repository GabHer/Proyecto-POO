var nameImg;
var banner;

function registrarEnterprise(){
    $("#loading").show();
    document.getElementById('msjError').style.display = 'none';
    list=[
    validarCampoVacio('nameEnterprise'),
    validarCampoVacio('descriptionEnterprise'),
    validarCampoVacio('fundationDate'),
    validarCampoVacio('emailEnterprise'),
    validarCampoVacio('passwordEnterprise'),
    validarCampoVacio('postalCode'),
    validarCampoVacio('country'),
    validarCampoVacio('state'),
    validarCampoVacio('addressEnterprise'),
    validarCampoVacio('phoneNumberEnterprise'),
    validarCampoVacio('latitute'),
    validarCampoVacio('longitude'),
    validarCampoVacio('urlProfileImage'),
    validarCampoVacio('urlBanner')];

    let empresa={
        nameEnterprise:document.getElementById('nameEnterprise').value,
        descriptionEnterprise:document.getElementById('descriptionEnterprise').value,
        fundationDate:document.getElementById('fundationDate').value,
        emailEnterprise:document.getElementById('emailEnterprise').value,
        passwordEnterprise:document.getElementById('passwordEnterprise').value,
        postalCode:document.getElementById('postalCode').value,
        country:document.getElementById('country').value,
        state:document.getElementById('state').value,
        addressEnterprise:document.getElementById('addressEnterprise').value,
        phoneNumberEnterprise:document.getElementById('phoneNumberEnterprise').value,
        latitute:document.getElementById('latitute').value,
        longitude:document.getElementById('longitude').value,
        urlProfileImage:`img/${nameImg}`,
        urlBanner: `img/${banner}`
    }
    

    var contador=0;
    for(let i=0; i<list.length; i++){
        if(list[i]==true){
            contador= contador+1;
        }
    }
    
        if(contador == 14){
            axios({
                url:'../../backend/api/empresas.php',
                method:'post',
                data: empresa,
                dataType:'json'
            }).then((res)=>{
                console.log(res);
                enviarEmail(document.getElementById('emailEnterprise').value, document.getElementById('nameEnterprise').value);
                document.getElementById('key').value= res.data.key;
                $("#loading").hide();
                window.location.href="../PerfilEmpresa/index.php";
            }).catch((error)=>{
                console.error(error);
            });
        }else{
            document.getElementById('msjError').style.display = 'block';
            $("#loading").hide();
        }
    
}

function editar(id){
    axios({
        url:'../../backend/api/empresas.php?idEmpresa='+id,
        method: 'GET',
        dataType: 'json'
    }).then((res)=>{
        console.log(res);
        document.getElementById('nameEnterprise').value= res.data.nameEnterprise;
        document.getElementById('descriptionEnterprise').value= res.data.descriptionEnterprise;
        document.getElementById('fundationDate').value= res.data.fundationDate;
        document.getElementById('emailEnterprise').value= res.data.emailEnterprise;
        document.getElementById('passwordEnterprise').value= res.data.passwordEnterprise;
        document.getElementById('postalCode').value= res.data.postalCode;
        document.getElementById('country').value= res.data.country;
        document.getElementById('state').value= res.data.state;
        document.getElementById('addressEnterprise').value= res.data.addressEnterprise;
        document.getElementById('phoneNumberEnterprise').value= res.data.phoneNumberEnterprise;
        document.getElementById('latitute').value= res.data.latitute;
        document.getElementById('longitude').value= res.data.longitude;
        document.getElementById('key').value = id;
        $("#btn-register").hide();
        $("#btn-actualizar").show();

    }).catch((error)=>{
        console.error(error);
    })
    ;
}

function actualizar(){
    $("#loading").show();
    let empresa={
        nameEnterprise:document.getElementById('nameEnterprise').value,
        descriptionEnterprise:document.getElementById('descriptionEnterprise').value,
        fundationDate:document.getElementById('fundationDate').value,
        emailEnterprise:document.getElementById('emailEnterprise').value,
        passwordEnterprise:document.getElementById('passwordEnterprise').value,
        postalCode:document.getElementById('postalCode').value,
        country:document.getElementById('country').value,
        state:document.getElementById('state').value,
        addressEnterprise:document.getElementById('addressEnterprise').value,
        phoneNumberEnterprise:document.getElementById('phoneNumberEnterprise').value,
        latitute:document.getElementById('latitute').value,
        longitude:document.getElementById('longitude').value,
        urlProfileImage:`img/${nameImg}`,
        urlBanner: `img/${banner}`
    }

    axios({
        url:'../../backend/api/empresas.php?idEmpresa='+document.getElementById('key').value,
        method:'put',
        data: empresa,
        dataType:'json'
    }).then((res)=>{
        console.log(res);
        $("#loading").hide();
        $("#msjActualizado").show();
    }).catch((error)=>{
        console.error(error);
    });
}


function enviarEmail(email, name){
    let params={
            email: email,
            name: name
    }
    axios({
        url:'../../backend/api/emailPHP/email.php',
        method: 'POST',
        dataType: 'json',
        data:params
    }).then((res)=>{
        console.log(res);
    }).catch((error)=>{
        console.error(error);
    })
    ;
}

function validarLatitud(latitute){
    let re= /^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/;
    if(re.test(latitute.value)){
        latitute.classList.remove('inError');
        latitute.classList.add('inSuccess');
    }else{
        latitute.classList.add('inError');
        latitute.classList.remove('inSuccess');
    }
}

function validarLongitud(longitude){
    let re= /^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/;
    if(re.test(longitude.value)){
        longitude.classList.remove('inError');
        longitude.classList.add('inSuccess');
    }else{
        longitude.classList.add('inError');
        longitude.classList.remove('inSuccess');
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

function validarLlenado(id){
    if((id.value)==""){
        id.classList.add('inError');
        id.classList.remove('inSuccess');
    }else{
        id.classList.remove('inError');
        id.classList.add('inSuccess');

    }
}

function subirImagen(){  
    if(document.getElementById("urlProfileImage").value!=""){
        var formData = new FormData();
        var files = $('#urlProfileImage')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: '../../backend/api/uploaderEmpresa.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                console.log("La imagen subida tiene el URL:"+res);
                updateFilenameImg();
            },
            error:function(error){
                console.error(error);
            }
        });
        
    }
    
}
function subirBanner(){  
    if(document.getElementById("urlBanner").value!=""){
        var formData = new FormData();
        var files = $('#urlBanner')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: '../../backend/api/uploaderEmpresa.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                console.log("La imagen subida tiene el URL:"+res);
                updateFilenameBanner();
            },
            error:function(error){
                console.error(error);
            }
        });
        
    }
    
}

// Funcion para extraer el nombre de la imagen
function updateFilenameImg(){
    path=document.getElementById('urlProfileImage').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        nameImg = path.substr(12); // modern browser
    document.getElementById('urlProfileImage').textContent = nameImg;
}
//--Fin

// Funcion para extraer el nombre del banner
function updateFilenameBanner(){
    path=document.getElementById('urlBanner').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        banner = path.substr(12); // modern browser
    document.getElementById('urlBanner').textContent = banner;
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