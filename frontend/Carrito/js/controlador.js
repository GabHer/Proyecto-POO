var promociones;
var nameE;
var idPromocion;
axios({
        url:'../../backend/api/promociones.php',
        method:'get',
        dataType:'json'
}).then((res)=>{
        console.log(res.data);
        promociones = res.data;
}).catch((error)=>{
        console.error(error);
});

function generateProduct(type){
    document.getElementById('area').innerHTML= "";
    document.getElementById('titulo').innerHTML= type;
        axios({
            url:'../../backend/api/empresas.php',
            method:'get',
            dataType:'json'
        }).then((emp)=>{
            console.log(emp.data);
            for(let j in emp.data){
                for(let i in promociones){
                    if(promociones[i].selectCategory == type){
                    if(j == promociones[i].idEnterprise){
                    nameE = emp.data[j].nameEnterprise;
                    document.getElementById('area').innerHTML+=`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 cardP">
                    <div class="card-deck" onclick="detalles('${i}')" style="margin-top:50px; padding:0px">
                    <div class="card mx-1">
                    <div class="card-img-top" style="color:#f9a826; background-size: cover; background-repeat: no-repeat; background-image: url(${promociones[i].urlProductPromoImage}); height: 300px;">
                        <div><span style="background-color: rgb(0, 0, 0,0.60); font-size: 40px"> -${promociones[i].Discount}</span></div>
                    </div>
                    <div class="card-body">
                    <h5><b>${promociones[i].products}</b></h5>
                    <h5><b>Price: $${promociones[i].discountPromo} | </b><del>$${promociones[i].priceProduct}</del></h5>
                    <h6><b>${emp.data[j].nameEnterprise}</b></h6>
                    <p class="card-text">${promociones[i].descriptionPromo}</p>
                    </div>
                    </div>
                    <div class="card-t">
                    <li style="color:white; font-size: 30px">
                    See details</li>
                    </div>
                    </div>`
                    }
                }
            }
        }
        
    }).catch((errorEmp)=>{
        console.error(errorEmp);
    });
}


function detalles(i){
    idPromocion = i;
    actualizarComentarios();
    $("#modal-detalles").modal("show");
    document.getElementById("tituloDetalle").innerHTML= `<h5 class="modal-title" style="color: #0e7248;" ><b>${promociones[i].products}</b></h5>`;
    document.getElementById("detalles").innerHTML= `
    <div class="modal-body">
    <img style="width:290px;" src="${promociones[i].urlProductPromoImage}">
    <h5 style="margin-top:10px;"><b>-${promociones[i].Discount} | Price: $${promociones[i].discountPromo} | </b><del>$${promociones[i].priceProduct}</del></h5>
    <h6><b>${nameE}</b></h6>
    <p class="card-text">${promociones[i].descriptionPromo}</p>
    <hr>
    <div style="text-align: center;">
        <a href="http://"><i class="fas fa-plus-circle fa-3x efect agg  data-toggle="tooltip" data-placement="top" data-html="true" title="Add to shopping cart""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-comment"><i class="fas fa-comments fa-3x efect comment data-toggle="tooltip" data-placement="top" data-html="true" title="Add coments""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-qualify"><i class="fas fa-star star fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Qualify promotion""></i></a>  
        <a onclick="guardarPromocionFav('${i}')"><i id="iconoHeart${i}" style="color:red;" class="fas fa-heart fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to favorites""></i></a>  
    </div>
    <hr>
    <div class="row" style="margin-left:5px">Puntuaciones</div><hr>
    <div class="row" style="margin-left:5px">Comments</div>
    <div id="areaComents"></div>
    </div>
    <hr>
    `;
}

function guardarPromocionFav(idPromocion){
    var promocion;
    axios({
        url:'../../backend/api/promociones.php?idPromocion='+idPromocion,
        method: 'GET',
        dataType: 'json'
        }).then((res)=>{
        document.getElementById(`iconoHeart${idPromocion}`).style.color = 'gray';
        promocion={
            idEnterprise: res.data.idEnterprise,
            products: res.data.products,
            selectCategory:res.data.selectCategory,
            priceProduct: res.data.priceProduct,
            descriptionPromo: res.data.descriptionPromo,
            Discount: res.data.Discount,
            discountPromo: res.data.discountPromo,
            startPromo: res.data.startPromo,
            finishPromo: res.data.finishPromo,
            sucursal:res.data.sucursal,
            urlProductPromoImage: res.data.urlProductPromoImage}
        
        axios({
            url:'../../backend/api/promocionesFavoritas.php?idUsuario='+document.getElementById('idUsuario').value,
            method: 'post',
            dataType: 'json',
            data: promocion
        }).then((resp)=>{
            console.log(resp.data);
        }).catch((error1)=>{
            console.error(error1);
        });
        }).catch((error2)=>{
            console.error(error2);
        });


}

function guardarComentario(){
    console.log(idPromocion);
    console.log(document.getElementById('idUsuario').value);

    let comentario={
        idUsuario: document.getElementById('idUsuario').value,
        comment: document.getElementById('comment').value
    }

    axios({
        url:'../../backend/api/comentarios.php?idPromocion=' + idPromocion,
        method:'post',
        dataType:'json',
        data: comentario
    }).then((res)=>{
        console.log(res.data);
        $("#modal-comment").modal("hide");
        document.getElementById('comment').value="";
        document.getElementById('areaComents').innerHTML="";
        actualizarComentarios();
    }).catch((error)=>{
        console.error(error);
    });
}

function actualizarComentarios(){
    axios({
        url:'../../backend/api/comentarios.php?idPromocion=' + idPromocion,
        method:'get',
        dataType:'json',
    }).then((res)=>{
        for(let i in res.data){
            axios({
                url:'../../backend/api/usuarios.php?idUsuario=' + res.data[i].idUsuario,
                method:'get',
                dataType:'json',
            }).then((resp)=>{
            document.getElementById('areaComents').innerHTML+=`
                <div class="card mb-3" style="max-width: 540px; border-color:white;">
                <div class="row no-gutters">
                <div class="col-md-4">
                    <img style="width: 70px; height:70px; margin-top:10px; " src="../PerfilUsuario/${resp.data.urlProfileImage}" class="card-img rounded-circle img-thumbnail" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h6 style="margin:0px;" class="card-title"><b>${resp.data.name} ${resp.data.lastName}</b></h6>
                    <p class="card-text">${res.data[i].comentario}</p>
                    </div>
                </div>
                </div>
            </div>
            <hr>`}
        ).catch((error1)=>{
            console.error(error1);
        });
        }}).catch((error2)=>{
            console.error(error2);
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