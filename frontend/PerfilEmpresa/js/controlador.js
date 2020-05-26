var imgProducto;
var imgSucursal;
var imgPromocion;
var estrellas = '';

var idEmpresa =document.getElementById('id').value;
axios({
    url:'../../backend/api/empresas.php?idEmpresa='+idEmpresa,
    method: 'GET',
    dataType: 'json'
}).then((res)=>{
        document.getElementById('banner').innerHTML= ` <img style="width: 1050px; border: #0E7248 20px solid; height:350px;  margin-left: 50px; " src="${res.data.urlBanner}" alt="" srcset="">`;
        document.getElementById('welcome').innerHTML=`<h1 class="display-4 letter" style="color: #f9a826;">${res.data.nameEnterprise}</h1>`;
        document.getElementById('logo').innerHTML=`<img class="img-fluid img-thumbnail rounded-circle" style=" margin-top: 30px;  margin-left: 40px; height: 300px; width: 350px;" src="${res.data.urlProfileImage}" alt="" srcset="">`;
        document.getElementById('information').innerHTML= `<h4>   <b>Name:</b> ${res.data.nameEnterprise}; <b>Country:</b> ${res.data.country}; <b>Address:</b>
        ${res.data.addressEnterprise}; <b>Phone:</b> ${res.data.phoneNumberEnterprise}; <b>Email:</b> ${res.data.emailEnterprise}; <b>Foundation:</b> ${res.data.fundationDate}</h4>`;
        document.getElementById('about').innerHTML= res.data.descriptionEnterprise;

        axios({
            url:'../../backend/api/promociones.php',
            method: 'GET',
            dataType: 'json'
        }).then((res)=>{
            for(let i in res.data){
                if(res.data[i].idEnterprise==idEmpresa){
                    for(let j in res.data[i].comentarios){
                        axios({
                            url:'../../backend/api/usuarios.php',
                            method: 'GET',
                            dataType: 'json'
                        }).then((usuario)=>{
                            for(let k in usuario.data){
                                
                                if(k == res.data[i].comentarios[j].idUsuario){
                                        document.getElementById('comments').innerHTML+=`
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                        <div class="card mx-1" style="margin-top:10px; width: 310px; border-color:white; font-size:20px">
                                        <div class="card-body">
                                        <h5 class="card-title"><img class="rounded-circle img-thumbnail" src="../PerfilUsuario/${usuario.data[k].urlProfileImage}" style="width: 60px; height: 60px;" ><b> ${usuario.data[k].name} ${usuario.data[k].lastName}</b></h5>
                                        <hr>
                                        <p class="card-text">Producto: ${res.data[i].products}<br>Comentario: ${res.data[i].comentarios[j].comentario}</p>
                                        <hr>
                                        </div>
                                        </div>
                                        </div>`
                                    }
                        }
                    
                    }).catch((error)=>{
                        console.error(error);
                    });
                }
                
                }
            }
        }
        ).catch((error)=>{
            console.error(error);
        });

    }
).catch((error)=>{
    console.error(error);
});

function registroSucursales(){
    document.getElementById('area').innerHTML= ''
    document.getElementById('area').innerHTML= `
    <div class="col-12">
    <div class="card mb-3 form-group" style="max-width: 640px; margin:auto; font-family: 'Comic Neue', cursive;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <i style="margin: 40px; color:#0b633e" class="fas fa-store fa-10x"></i>
            <div class="card cardP" style="margin:auto; border-color:white;">
            <h2 style="text-align: center;">Register all your branches so that your clients can find you.</h2>
            </div>
            </div>
            <div class="col-md-8">
            <div class="card-body" style=" text-align: center; ">
                <div >Name</div>
                <input type="text" id="nameSucursal" name="" placeholder="Name">
                <div >Email</div>
                <input type="email" onkeyup="validarEmail(this)" id="emailSucursal" name="" placeholder="Email">
                <div >Address</div>
                <input type="text" id="addressSucursal" name="addressCompany" placeholder="Adress">
                <div >* Neither more nor less than 8 digits.</div>
                <input type="text" onkeyup="validarPhone(this)" id="phoneSucursal" name="phone-sucursal" placeholder="XXXX-XXXX">
                <div >Latitude and longitude</div>
                <input type="text" name="latitute" onkeyup="validarLatitud(this)" id="latitudeSucursal" placeholder="[±0-90.000]">
                <input type="text" name="longitude" onkeyup="validarLongitud(this)"  id="longitudeSucursal" placeholder="[±0-180.000]">
                <div class="advice">Upload a profile picture</div>
                <input type="file" onchange="subirImgSucursal()" name="urlProfileImageSucursal" id="urlProfileImageSucursal"></br>
                <button type="button" style="margin: 4px 0px 10px;" onclick="agregarSucursales()" class="btn btn-outline-primary">Save</button><br> 
                <div id="loading" style="display: none;"class="spinner-border" role="status">
                <span  class="sr-only">Loading...</span>
                </div>
                <div id="msjErrorSucursal" style="display: none; color: red;">Error, one or more fields are empty, please check.</div>
                <div id="msjActualizadoSucursal" style="display: none; color: green;">Your data has been updated successfully! <i class="fas fa-check-circle"></i></div>
            </div>
            </div>
        </div>
    </div>
    `
}

function agregarSucursales(){
    $("#loading").show();
    list=[
    validarCampoVacio('nameSucursal'),
    validarCampoVacio('emailSucursal'),
    validarCampoVacio('addressSucursal'),
    validarCampoVacio('phoneSucursal'),
    validarCampoVacio('latitudeSucursal'),
    validarCampoVacio('longitudeSucursal'),
    validarCampoVacio('urlProfileImageSucursal')];

    let sucursal={
        nameSucursal: document.getElementById('nameSucursal').value,
        emailSucursal: document.getElementById('emailSucursal').value,
        addressSucursal: document.getElementById('addressSucursal').value,
        phoneSucursal: document.getElementById('phoneSucursal').value,
        latitudeSucursal: document.getElementById('latitudeSucursal').value,
        longitudeSucursal: document.getElementById('longitudeSucursal').value,
        urlProfileImageSucursal: `img/${imgSucursal}`
    }

    var contador=0;
    for(let i=0; i<list.length; i++){
        if(list[i]==true){
            contador= contador+1;
        }
    }
    
        if(contador == 7){
            axios({
                url:'../../backend/api/sucursales.php?idEmpresa='+idEmpresa,
                method:'post',
                data: sucursal,
                dataType:'json'
            }).then((res)=>{
                console.log(res);
                $("#loading").hide();
                document.getElementById('msjActualizadoSucursal').style.display = 'block';
                document.getElementById('nameSucursal').value= null;
                document.getElementById('emailSucursal').value= null;
                document.getElementById('addressSucursal').value= null;
                document.getElementById('phoneSucursal').value= null;
                document.getElementById('latitudeSucursal').value= null;
                document.getElementById('longitudeSucursal').value= null;
                document.getElementById('urlProfileImageSucursal').value= null;
            }).catch((error)=>{
                console.error(error);
            });
        }else{
            document.getElementById('msjErrorSucursal').style.display = 'block';
        }

}

function registroProductos(){
    document.getElementById('area').innerHTML= ''
    document.getElementById('area').innerHTML= `
    <div class="col-12">
    <div class="card mb-3 form-group" style="max-width: 640px; margin:auto; font-family: 'Comic Neue', cursive;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <i style="margin: 40px; color:#0b633e"class="fas fa-cart-arrow-down fa-10x"></i>
            <div class="card cardP" style="margin:auto; border-color:white;">
            <h2 style="text-align: center;">Register all the products that your company offers.</h2>
            </div>
            </div>
            <div class="col-md-8">
            <div class="card-body" style=" text-align: center; ">
                <div >Name product</div>
                <input type="text" id="nameProduct" name="nameProduct" placeholder="Name">
                <div >Price</div>
                <input type="text" id="priceProduct" onkeyup="validarOnlyNum(this)" name="" placeholder="$ price">
                <div >Description</div>
                <textarea style="padding:6px" name="descriptionProduct" id="descriptionProduct" cols="25" rows="4"></textarea>
                <div class="advice">Choose image</div>
                <input style="background-color: white" onchange="subirImgProducto()"  type="file" name="urlProductImage" id="urlProductImage"></br>
                <button style="margin: 4px 0px 10px;" type="button" onclick="guardarProductos()" class="btn btn-outline-primary">Add product</button></br>   
                <div id="loading" style="display: none;"class="spinner-border" role="status">
                <span  class="sr-only">Loading...</span>
                </div>
                <div id="msjErrorProducto" style="display: none; color: red;">Error, one or more fields are empty, please check.</div>
                <div id="msjActualizadoProducto" style="display: none; color: green;">Your data has been updated successfully! <i class="fas fa-check-circle"></i></div>
            </div>
            </div>
        </div>
    </div>
    `
}

function guardarProductos(){
    $("#loading").show();
    list=[
    validarCampoVacio('nameProduct'),
    validarCampoVacio('priceProduct'),
    validarCampoVacio('descriptionProduct'),
    validarCampoVacio('urlProductImage')];
    let producto ={
        nameProduct:document.getElementById('nameProduct').value,
        priceProduct:document.getElementById('priceProduct').value,
        descriptionProduct:document.getElementById('descriptionProduct').value,
        urlProductImage: `img/${imgProducto}`
    }

    var contador=0;
    for(let i=0; i<list.length; i++){
        if(list[i]==true){
            contador= contador+1;
        }
    }
    
        if(contador == 4){
            axios({
                url:'../../backend/api/productos.php?idEmpresa='+idEmpresa,
                method:'post',
                data: producto,
                dataType:'json'
            }).then((res)=>{
                console.log(res);
                $("#loading").hide();
                document.getElementById('msjErrorProducto').style.display = 'none';
                document.getElementById('msjActualizadoProducto').style.display = 'block';
                document.getElementById('nameProduct').value= null;
                document.getElementById('priceProduct').value= null;
                document.getElementById('descriptionProduct').value= null;
                document.getElementById('urlProductImage').value= null;
            }).catch((error)=>{
                console.error(error);
            });
        }else{
            document.getElementById('msjErrorProducto').style.display = 'block';
            $("#loading").hide();
                document.getElementById('msjActualizadoProducto').style.display = 'none';
        }
}

function registroPromociones(){
    document.getElementById('area').innerHTML= '';
    axios({
        url:'../../backend/api/productos.php?idEmpresa='+idEmpresa,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        for(let llave in res.data){
        document.getElementById('products').innerHTML+=
        `<option value="${llave}">${res.data[llave].nameProduct}</option>`
        
    }
    }).catch((error)=>{
        console.error(error);
        $("#loading").hide();
    });

    axios({
        url:'../../backend/api/sucursales.php?idEmpresa='+idEmpresa,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        for(let llave in res.data){
        document.getElementById('sucursal').innerHTML+=`
        <label><input name="sucursal" value="${res.data[llave].nameSucursal}" type="checkbox">${res.data[llave].nameSucursal}</label>`
    }
    }).catch((error)=>{
        console.error(error);
        $("#loading").hide();
    });
    document.getElementById('area').innerHTML= `
    <div class="col-12">
    <div class="card mb-3 form-group" style="text-align:center; max-width: 640px; margin:auto; font-family: 'Comic Neue', cursive;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <i style="margin:40px; color:#0b633e" class="fas fa-parachute-box fa-10x"></i>
            <div class="card cardP" style="margin:auto; border-color:white;">
            <h2 style="text-align: center;">Register your promotional products to put them on sale!</h2>
            </div>
            </div>
            <div class="col-md-8">
            <div class="card-body" style=" text-align: center; ">
                <div>Select product</div>
                <select onchange="complete()" style="background-color: white" name="products" id="products">
                <option value="">Seleccione</option>
                </select>
                <div >Select category</div>
                <select id="selectCategoryPromo" style="background-color: white" name="selectCategoryPromo">
                    <option value="Technology">Technology</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Sports">Sports</option>
                    <option value="Home">Home</option>
                    <option value="Electrodomestics">Electrodomestics</option>
                    <option value="Accesories">Accesories</option>
                    <option value="Health">Health</option>
                    <option value="Education">Education</option>
                </select>
                <div >Price</div>
                <input type="text" id="priceProduct" name="" placeholder="$ price">
                <div >Description</div>
                <textarea style="padding:6px" name="descriptionPromo" id="descriptionPromo" cols="25" rows="4"></textarea>
                <div >Discount rate</div>
                <select onchange="calcPrice()" style="background-color: white" name="" id="Discount">
                    <option value="">Seleccione</option>
                    <option value="10%">10%</option>
                    <option value="25%">25%</option>
                    <option value="35%">35%</option>
                    <option value="40%">40%</option>
                    <option value="50%">50%</option>
                    <option value="60%">60%</option>
                    <option value="70%">70%</option>
                    <option value="80%">80%</option>
                    <option value="90%">90%</option>
                </select>
                <div >Price with discount</div>
                <input type="text" id="discountPromo" name="" placeholder="$ price with discount">
                <div >Date start</div>
                <input type="date" id="startPromo">
                <div >Date finish</div>
                <input type="date" id="finishPromo">
                <div >Sucursales </div>
                <div id="sucursal" class="card" style="width: 220px; margin:auto; padding:10px;">
                </div>
                <div style="margin: 10px">Choose image</div>
                <input type="file" onchange="subirImgPromocion()" name="urlProductPromoImage" id="urlProductPromoImage"><br>
                <div class="small-image-profile" style="width: 10px; height: 10px;" id="smallImage"></div><br>
                <button style="margin: 4px 0px 10px;" onclick="guardarPromociones()" type="button" class="btn btn-outline-primary">Add promotion</button><br>
                <div  id="loading" style="display: none;"class="spinner-border" role="status">
                <span  class="sr-only">Loading...</span>
                </div>
                <div id="msjErrorPromocion" style="display: none; color: red;">Error, one or more fields are empty, please check.</div>
                <div id="msjActualizadoPromocion" style="display: none; color: green;">Your data has been updated successfully! <i class="fas fa-check-circle"></i></div>
            </div>
            </div>
        </div>
        </div>   `
    }

var resImg;
function complete(){
    axios({
        url:'../../backend/api/productos.php?idEnterprise='+idEmpresa+'&idProducto='+ document.getElementById('products').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        document.getElementById('priceProduct').value= res.data.priceProduct;
        document.getElementById('descriptionPromo').value=res.data.descriptionProduct;
        verImagen(res.data.urlProductImage);
        resImg= res.data.urlProductImage;
    }).catch((error)=>{
        console.error(error);
    });
}

function verImagen(url){
    document.getElementById("smallImage").innerHTML=`
    <img style="width: 30px; height: 30px; margin-left: 180px;" src="../PerfilEmpresa/${url}">
    `;
}

function calcPrice(){
    let calc = parseFloat(document.getElementById('priceProduct').value) - (((parseFloat(document.getElementById('Discount').value))/100) * (document.getElementById('priceProduct').value));
    document.getElementById('discountPromo').value= calc;
}

function guardarPromociones(){
    var promocion;
    $("#loading").show();
    list=[
    validarCampoVacio('priceProduct'),
    validarCampoVacio('selectCategoryPromo'),
    validarCampoVacio('Discount'),
    validarCampoVacio('descriptionPromo'),
    validarCampoVacio('sucursal'),
    validarCampoVacio('discountPromo'),
    validarCampoVacio('startPromo'),
    validarCampoVacio('finishPromo')];

    let sucursalInput = document.querySelector('input[type="checkbox"][name="sucursal"]:checked');

    if(!validarCampoVacioPromo('urlProductPromoImage')){
        img= resImg;
    }else{
        img = `img/${imgPromocion}`;
    }

    axios({
        url:'../../backend/api/productos.php?idEnterprise='+idEmpresa+'&idProducto='+ document.getElementById('products').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        promocion={
            idEnterprise: idEmpresa,
            products: res.data.nameProduct,
            selectCategory:document.getElementById('selectCategoryPromo').value,
            priceProduct: document.getElementById('priceProduct').value,
            descriptionPromo: document.getElementById('descriptionPromo').value,
            Discount: document.getElementById('Discount').value,
            discountPromo: document.getElementById('discountPromo').value,
            startPromo: document.getElementById('startPromo').value,
            finishPromo: document.getElementById('finishPromo').value,
            sucursal:(sucursalInput==null)?'':sucursalInput.value,
            urlProductPromoImage: img}

            var contador=0;
        for(let i=0; i<list.length; i++){
            if(list[i]==true){
                contador= contador+1;
            }
        }
        
            if(contador == 8){
                axios({
                    url:'../../backend/api/promociones.php',
                    method:'post',
                    data: promocion,
                    dataType:'json'
                }).then((res)=>{
                    console.log(res);
                    $("#loading").hide();
                    document.getElementById('msjActualizadoPromocion').style.display = 'block';
                    document.getElementById('msjErrorPromocion').style.display = 'none';
                    document.getElementById('selectCategoryPromo').value= null;
                    document.getElementById('products').value= null;
                    document.getElementById('Discount').value= null;
                    document.getElementById('priceProduct').value= null;
                    document.getElementById('descriptionPromo').value= null;
                    document.getElementById('discountPromo').value= null;
                    document.getElementById('startPromo').value= null;
                    document.getElementById('finishPromo').value= null;
                    document.getElementById('urlProductPromoImage').value= null;
                    document.getElementById("smallImage").innerHTML="";
                }).catch((error)=>{
                    console.error(error);
                    $("#loading").hide();
                });
            }else{
                $("#loading").hide();
                document.getElementById('msjErrorPromocion').style.display = 'block';
                document.getElementById('msjActualizadoPromocion').style.display = 'none';
            }
    }).catch((error)=>{
        console.error(error);
    });

    
    
}

    var ctx = document.getElementById('graph1');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado','Domingo'],
            datasets: [{
                label: '# de Ventas por Día',
                data: [10, 23, 13, 27, 17, 33, 30],
                backgroundColor: '#0c5838c9',
                borderColor:' #0c5838c9',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
            
        }
    });

var ctx = document.getElementById('graph2');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: '# de Seguidores por Mes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: '#0c5838c9',
            borderColor:'#0c5838c9',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
        
    }
});

function impFichaProm(){
    document.getElementById('area').innerHTML='';
    document.getElementById('area').innerHTML=`
    <div style= "text-align:center; font-family: 'Comic Neue', cursive;" class="m-auto">
    <div >Choose product</div>
    <select onchange="abrirHtmlFicha()" style="background-color: white" name="idProductQr" id="idProductQr" >
    <option value="">Select</option>
    </select>
    </div>
    `;

    axios({
        url:'../../backend/api/productos.php?idEmpresa='+idEmpresa,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        for(let llave in res.data){
        document.getElementById('idProductQr').innerHTML+=
        `<option value="${llave}">${res.data[llave].nameProduct}</option>`
        
    }
    }).catch((error)=>{
        console.error(error);
    });

};

function abrirHtmlFicha(){
    window.location="ficha.html";
};

function imprimir(){
    print();
}

function eliminarEmpresa(){
    document.getElementById('loadingEliminar').style.display='inline';
    axios({
      url:'../../backend/api/empresas.php?idEmpresa='+idEmpresa,
      method: 'delete',
      dataType: 'json'
    }).then((res)=>{
      window.location.href= "../../backend/class/logoutEmpresa.php";
      console.log(res.data);
    }).catch((error)=>{
      console.error(error);
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
function validarCampoVacioPromo(id){
    if (document.getElementById(id).value == ''){
        return false;
    }else{ 
        return true;
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


function validarOnlyNum(num){
    let re =/^\d+$/;
    if(re.test(num.value)){
        num.classList.remove('inError');
        num.classList.add('inSuccess');
    }else{
        num.classList.add('inError');
        num.classList.remove('inSucces');
    }
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

// Funciones subir imagen promocion
function subirImgPromocion(){  
    if(document.getElementById("urlProductPromoImage").value!=""){
        var formData = new FormData();
        var files = $('#urlProductPromoImage')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: '../../backend/api/uploaderPromocion.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                console.log("La imagen subida tiene el URL:"+res);
                updateFileImgPromocion();
            },
            error:function(error){
                console.error(error);
            }
        });
        
    }
    
}

function updateFileImgPromocion(){
    path=document.getElementById('urlProductPromoImage').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        imgPromocion = path.substr(12); // modern browser
    document.getElementById('urlProductPromoImage').textContent = imgPromocion;
}
//--Fin

// Funciones imagen de sucursal
function subirImgSucursal(){  
    if(document.getElementById("urlProfileImageSucursal").value!=""){
        var formData = new FormData();
        var files = $('#urlProfileImageSucursal')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: '../../backend/api/uploaderEmpresa.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                console.log("La imagen subida tiene el URL:"+res);
                updateFileImgSucursal();
            },
            error:function(error){
                console.error(error);
            }
        });
    }
    
}
function updateFileImgSucursal(){
    path=document.getElementById('urlProfileImageSucursal').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        imgSucursal = path.substr(12); // modern browser
    document.getElementById('urlProfileImageSucursal').textContent = imgSucursal;
}
//--Fin

// Funciones imagen Producto
function subirImgProducto(){  
    if(document.getElementById("urlProductImage").value!=""){
        var formData = new FormData();
        var files = $('#urlProductImage')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: '../../backend/api/uploaderEmpresa.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                console.log("La imagen subida tiene el URL:"+res);
                updateFileImgProducto();
            },
            error:function(error){
                console.error(error);
            }
        });
        
    }
    
}

function updateFileImgProducto(){
    path=document.getElementById('urlProductImage').value;
    if (path.substr(0, 12) == "C:\\fakepath\\")
        imgProducto = path.substr(12); // modern browser
    document.getElementById('urlProductImage').textContent = imgProducto;
}
//--Fin

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