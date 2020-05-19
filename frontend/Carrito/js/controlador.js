

var promociones;
var nameE;
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
        <a href="http://"><i class="fas fa-heart heart fa-3x efect data-toggle="tooltip" data-placement="top" data-html="true" title="Add to favorites""></i></a>  
    </div>
    <hr>
    <div class="row" style="margin-left:5px">Puntuaciones</div><hr>
    <div class="row" style="margin-left:5px">Comments</div><hr>
    </div>
    `;
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