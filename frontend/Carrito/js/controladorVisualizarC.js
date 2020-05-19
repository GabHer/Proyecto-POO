
var promociones;
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
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="card-deck" style="margin-top:50px; padding:0px">
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
                    
                    </div>`
                }
            }
        }
    }
    }).catch((errorEmp)=>{
        console.error(errorEmp);
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