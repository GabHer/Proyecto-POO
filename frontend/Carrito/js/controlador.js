var promociones;
var nameE;
var idPromocion;
cantProductosCarrito();
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

/* Generando promociones en su respectiva categoría */
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

/* Detalle de cada promoción */
function detalles(i){
    idPromocion = i;
    document.getElementById('msjEstrellas').style.display= 'none';
    document.getElementById('msjComentarios').style.display='none';
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
        <a onclick="agregarCarrito('${i}')"><i id="iconoPlus${i}" style="color:black;" class="fas fa-plus-circle fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to shopping cart""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-comment"><i class="fas fa-comments fa-3x efect comment data-toggle="tooltip" data-placement="top" data-html="true" title="Add coments""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-qualify"><i class="fas fa-star star fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Qualify promotion""></i></a>  
        <a onclick="guardarPromocionFav('${i}')"><i id="iconoHeart${i}" style="color:red;" class="fas fa-heart fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to favorites""></i></a>  
    </div>
    <div id="msjAgregar" style="display: none; color:#0e7248; margin:auto; ">Agregando a carrito...</div>
    <hr>
    <div class="row" style="margin-left:5px">Puntuaciones</div>
    <div class="text-center star" id="estrellas"></div><hr>
    <div class="row" style="margin-left:5px">Comments</div>
    <div id="areaComents"></div>
    </div>
    <hr>
    `;
    calcEstrellas();
}

/* Función que calcula en promedio las estrellas dependiendo de las puntuaciones almacenadas */
function calcEstrellas(){
    axios({
        url:'../../backend/api/promociones.php?idPromocion='+idPromocion,
        method:'get',
        dataType:'json'
    }).then((res)=>{
            promo = res.data;
            let contador=0;
            let suma=0;
            for(let k in promo.puntuacion){
                    contador++;
                    suma += parseInt(promo.puntuacion[k].calificacion);
            }
            // console.log(suma);
            // console.log(contador);
            let total= Math.ceil(suma/contador);
            generarEstrellas(total);
            // console.log(total);

            if(suma==0){
                document.getElementById('msjEstrellas').style.display= 'inline';
            }
    }).catch((error)=>{
            console.error(error);
    });
    
}

/* Función que guarda las promociones marcadas como favoritas */
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

/* Función que guarda el comentario realizado por el usuario en la promoción respectiva*/
function guardarComentario(){
    document.getElementById('loading').style.display='inline';
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
        document.getElementById('loading').style.display='none';
        $("#modal-comment").modal("hide");
        document.getElementById('comment').value="";
        document.getElementById('areaComents').innerHTML="";
        actualizarComentarios();
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para visualizar los comentarios en el detalle de la promoción */
function actualizarComentarios(){
    document.getElementById('loadingComment').style.display='inline';
    document.getElementById('msjComentarios').style.display='none';
    axios({
        url:'../../backend/api/comentarios.php?idPromocion=' + idPromocion,
        method:'get',
        dataType:'json',
    }).then((res)=>{
        if(res.data==null){
            document.getElementById('loadingComment').style.display='none';
            document.getElementById('msjComentarios').style.display='inline';
        }
        for(let i in res.data){
            console.log(res.data);
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
                <div class="col-md-7">
                    <div class="card-body">
                    <h6 style="margin:0px;" class="card-title"><b>${resp.data.name} ${resp.data.lastName}</b></h6>
                    <p class="card-text">${res.data[i].comentario}</p>
                    </div>
                </div>
                <div class="col-md-1">
                    <i onclick="eliminarComentario('${i}')" style="m-auto; cursor:pointer; color:red" class="far fa-times-circle"></i>
                </div>
                </div>
            </div>
            <hr>`
            document.getElementById('loadingComment').style.display='none';
        }
        ).catch((error1)=>{
            console.error(error1);
        });
        }}).catch((error2)=>{
            console.error(error2);
        });
}


/*Funcion para eliminar comentario*/
function eliminarComentario(idComentario){
    document.getElementById('areaComents').innerHTML="";
    axios({
        url:'../../backend/api/comentarios.php?idPromocion=' + idPromocion+ '&idComentario='+idComentario+'&idUsuario='+document.getElementById('idUsuario').value,
        method:'delete',
        dataType:'json',
    }).then((res)=>{
        console.log(res.data);
        actualizarComentarios();
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para agregar promoción al carrito de compra */
function agregarCarrito(idPromocion){
    document.getElementById('msjAgregar').style.display='inline';
    axios({
        url:'../../backend/api/promociones.php?idPromocion='+idPromocion,
        method: 'GET',
        dataType: 'json'
        }).then((res)=>{
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
            url:'../../backend/api/carrito.php?idUsuario='+document.getElementById('idUsuario').value,
            method: 'post',
            dataType: 'json',
            data: promocion
        }).then((resp)=>{
            document.getElementById('msjAgregar').style.display='none';
            document.getElementById(`iconoPlus${idPromocion}`).style.color = 'gray';
            cantProductosCarrito();
            console.log(resp.data);
        }).catch((error1)=>{
            console.error(error1);
        });
        }).catch((error2)=>{
            console.error(error2);
        });
}

/* Función para visualizar las promociones agregadas al carrito */
var name;
function mostrarPromocionesAgregadas(){
    document.getElementById('tabla-carrito').innerHTML="";
    document.getElementById('procesar').style.display='none';
    document.getElementById('msjCompras').style.display='none';
    document.getElementById('loadingCompras').style.display='inline';
    axios({
        url:'../../backend/api/usuarios.php?idUsuario=' + document.getElementById('idUsuario').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        document.getElementById('tituloCarrito').innerHTML=`<h5 class="modal-title" style="color: #0e7248;" ><b>${res.data.name} ${res.data.lastName}</b></h5>`;
        name= res.data.name;
    }).catch((error)=>{
        console.error(error);
    });

    axios({
        url:'../../backend/api/carrito.php?idUsuario=' + document.getElementById('idUsuario').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        if(res.data==null){
            document.getElementById('msjCompras').style.display='inline';
            document.getElementById('loadingCompras').style.display='none';
        }
        let contador=0;
        for(let i in res.data){
        contador++;
        document.getElementById('tabla-carrito').innerHTML+=`
        <tr class="text-center" id="${i}">
        <td>${contador}</td>
        <td><img style="width:40px; height:50px" src="${res.data[i].urlProductPromoImage}"></td>
        <td>${res.data[i].products}</td>
        <td>${res.data[i].discountPromo}</td>
        <td>
            <button style="cursor:pointer;" class="btn btn-danger btn-sm" onclick="eliminar('${i}')" type="button"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
        `;
    document.getElementById('loadingCompras').style.display='none';
    }
    }).catch((error)=>{
        console.error(error);
    });

}

/* Función para calcular la cantidad de promociones al carrito y visualizarlas en la navbar*/
function cantProductosCarrito(){
    axios({
        url:'../../backend/api/carrito.php?idUsuario=' + document.getElementById('idUsuario').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        let contador=0;
        for(let i in res.data){
            contador ++;
        }
        document.getElementById('numeroP').innerHTML = `<h5 style="color: #0e7248; background-color:#f9a823; padding:5px">Carrito: ${contador}</h5> `;
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para calcular el total de las promociones en el carrito*/
function procesarCompra(){
    document.getElementById('loadingCompras').style.display='inline';
    axios({
        url:'../../backend/api/carrito.php?idUsuario=' + document.getElementById('idUsuario').value,
        method:'get',
        dataType:'json'
    }).then((res)=>{
        if(res.data==null){
            document.getElementById('loadingCompras').style.display='none';
        }
        let contador1=0;
        let contador2=0;
        for(let i in res.data){
            contador1 += parseFloat(res.data[i].discountPromo);
            contador2 += parseFloat(res.data[i].priceProduct) - parseFloat(res.data[i].discountPromo);
        }
        document.getElementById('totalPagar').innerHTML = `<b>$ ${contador1}</b>`;
        document.getElementById('ahorro').innerHTML = `Lo ahorrado en esta compra es: <b>$ ${contador2}</b>`;
        document.getElementById('msjPagar').innerHTML= `<h6 style="color: #0e7248;">${name} su total a pagar es:</h6>`;
        document.getElementById('loadingCompras').style.display='none';
        document.getElementById('procesar').style.display='inline';
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para eliminar una promoción en el carrito */
function eliminar(id){
    $("#"+id).remove();
    axios({
        url:'../../backend/api/carrito.php?idUsuario=' + document.getElementById('idUsuario').value + '&idPromoCarrito=' +id,
        method:'delete',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        mostrarPromocionesAgregadas();
        cantProductosCarrito();
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para vaciar carrito*/
function vaciarCarrito(){
    document.getElementById('loadingCompras').style.display='inline';
    axios({
        url:'../../backend/api/carrito.php?idUser=' + document.getElementById('idUsuario').value,
        method:'delete',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        document.getElementById('loadingCompras').style.display='none';
        mostrarPromocionesAgregadas();
        cantProductosCarrito();
        
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para agregar calificación de estrellas en la respectiva promoción */
function calificarPromocion(){
    let calificacion= document.querySelector('input[type="radio"][name="star"]:checked')
    console.log((calificacion==null)?'':calificacion.value);
    let puntuacion={
        calificacion:(calificacion==null)?'':calificacion.value
    }

    axios({
        url:'../../backend/api/calificacion.php?idPromocion=' + idPromocion,
        method:'post',
        dataType:'json',
        data:puntuacion
    }).then((res)=>{
        console.log(res.data);
        generarEstrellas((calificacion==null)?'':calificacion.value);
        document.getElementById('msjEstrellas').style.display= 'none';
        
    }).catch((error)=>{
        console.error(error);
    });
}

/* Función para visualizar las estrellas en el detalle de la promoción*/
function generarEstrellas(cant){
    let estrellas = '';
            for (let k = 0; k < cant; k++) {
                estrellas+='<i class="fas fa-star"></i>';
            }
            for (let k = 0; k < 5-cant; k++) {
                estrellas+='<i class="far fa-star"></i>';
            }
    document.getElementById('estrellas').innerHTML= estrellas;
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


/* Función para buscar una promoción en el carrito*/
function autocompletado() {
    document.getElementById("area").innerHTML = '';
    var promo=[];
    for (let i in promociones){
        promo.push(promociones[i].products);
    }

    var pal = document.getElementById("inSearch").value;
    var tam = pal.length;
    for(indice in promo){
        var nombre = promo[indice];
        var str = nombre.substring(0,tam);
        if(pal.length <= nombre.length && pal.length != 0 && nombre.length != 0){
            if(pal.toLowerCase() == str.toLowerCase()){
                for(let i in promociones){
                    if(promociones[i].products == promo[indice]){
                    document.getElementById('area').innerHTML+=`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 cardP">
                    <div class="card-deck" onclick="detallesSearch('${i}')" style="margin-top:50px; padding:0px">
                    <div class="card mx-1">
                    <div class="card-img-top" style="color:#f9a826; background-size: cover; background-repeat: no-repeat; background-image: url(${promociones[i].urlProductPromoImage}); height: 300px;">
                        <div><span style="background-color: rgb(0, 0, 0,0.60); font-size: 40px"> -${promociones[i].Discount}</span></div>
                    </div>
                    <div class="card-body">
                    <h5><b>${promociones[i].products}</b></h5>
                    <h5><b>Price: $${promociones[i].discountPromo} | </b><del>$${promociones[i].priceProduct}</del></h5>
                    <h6>Category: <b>${promociones[i].selectCategory}</b></h6>
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
        }else{
            window.location.href="index.php";
        }
    }
}

function detallesSearch(i){
    idPromocion = i;
    document.getElementById('msjEstrellas').style.display= 'none';
    document.getElementById('msjComentarios').style.display='none';
    actualizarComentarios();
    $("#modal-detalles").modal("show");
    document.getElementById("tituloDetalle").innerHTML= `<h5 class="modal-title" style="color: #0e7248;" ><b>${promociones[i].products}</b></h5>`;
    document.getElementById("detalles").innerHTML= `
    <div class="modal-body">
    <img style="width:290px;" src="${promociones[i].urlProductPromoImage}">
    <h5 style="margin-top:10px;"><b>-${promociones[i].Discount} | Price: $${promociones[i].discountPromo} | </b><del>$${promociones[i].priceProduct}</del></h5>
    <p class="card-text">${promociones[i].descriptionPromo}</p>
    <hr>
    <div style="text-align: center;">
        <a onclick="agregarCarrito('${i}')"><i id="iconoPlus${i}" style="color:black;" class="fas fa-plus-circle fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to shopping cart""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-comment"><i class="fas fa-comments fa-3x efect comment data-toggle="tooltip" data-placement="top" data-html="true" title="Add coments""></i></a>  
        <a href="http://"data-toggle="modal" data-target="#modal-qualify"><i class="fas fa-star star fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Qualify promotion""></i></a>  
        <a onclick="guardarPromocionFav('${i}')"><i id="iconoHeart${i}" style="color:red;" class="fas fa-heart fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to favorites""></i></a>  
    </div>
    <div id="msjAgregar" style="display: none; color:#0e7248; margin:auto; ">Agregando a carrito...</div>
    <hr>
    <div class="row" style="margin-left:5px">Puntuaciones</div>
    <div class="text-center star" id="estrellas"></div><hr>
    <div class="row" style="margin-left:5px">Comments</div>
    
    <div id="areaComents"></div>
    </div>
    <hr>
    `;

    calcEstrellas();
}