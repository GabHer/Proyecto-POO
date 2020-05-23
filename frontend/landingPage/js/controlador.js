function abrirModalCliente(){
    $('#tipoUsuario').modal('hide');
    $('#modal-ingresarCliente').modal('show');

}
function abrirModalEmpresa(){
    $('#tipoUsuario').modal('hide');
    $('#modal-ingresarEmpresa').modal('show');

}
function abrirModalSuperAdmin(){
    $('#tipoUsuario').modal('hide');
    $('#modal-ingresarSuperAdmin').modal('show');

}

function loginUsuario(){
    $("#loading").show();
    axios({
        url:"../../backend/api/loginUsuario.php",
        method:"post",
        responseType:"json",
        data:{
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        }
    }).then(res=>{
        console.log(res);
        $("#loading").hide();
        if(res.data.codigoResultado==1){
            $('#modal-ingresarCliente').modal('hide');
            document.getElementById('email').value ="";
            document.getElementById('password').value= "";
            window.location.href ="../PerfilUsuario/index.php";
        }
        else
            document.getElementById('errorUsuario').style.display='block'
            document.getElementById('errorUsuario').innerHTML =res.data.mensaje;
        
    }).catch(error=>{
        console.log(error);
    });
}

function loginEmpresa(){
    $("#loadingEmpresa").show();
    axios({
        url:"../../backend/api/loginEmpresa.php",
        method:"post",
        responseType:"json",
        data:{
            email: document.getElementById('emailEmpresa').value,
            password: document.getElementById('passwordEmpresa').value
        }
    }).then(res=>{
        console.log(res);
        $("#loadingEmpresa").hide();
        if(res.data.codigoResultado==1){
            $('#modal-ingresarEmpresa').modal('hide');
            document.getElementById('email').value ="";
            document.getElementById('password').value= "";
            window.location.href ="../PerfilEmpresa/index.php";
        }
        else
            document.getElementById('errorEmpresa').style.display='block'
            document.getElementById('errorEmpresa').innerHTML =res.data.mensaje;
        
    }).catch(error=>{
        console.log(error);
    });
}

function loginSuperAdmin(){
    $("#loadingSuperAdmin").show();
    axios({
        url:"../../backend/api/loginSuperAdmin.php",
        method:"post",
        responseType:"json",
        data:{
            email: document.getElementById('emailSuperAdmin').value,
            password: document.getElementById('passwordSuperAdmin').value
        }
    }).then(res=>{
        console.log(res);
        $("#loadingSuperAdmin").hide();
        if(res.data.codigoResultado==1){
            $('#modal-ingresarSuperAdmin').modal('hide');
            document.getElementById('email').value ="";
            document.getElementById('password').value= "";
            window.location.href ="../SuperAdministrador/index.php";
        }
        else
            document.getElementById('errorSuperAdmin').style.display='block'
            document.getElementById('errorSuperAdmin').innerHTML =res.data.mensaje;
        
    }).catch(error=>{
        console.log(error);
    });
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

function validarInputInicioSesion(){
    validarCampoVacio('email');
    validarCampoVacio('password');
}


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

