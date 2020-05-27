var idEmpresa =document.getElementById('id').value;
var promociones;
    axios({
        url:'../../backend/api/promociones.php',
        method:'get',
        dataType:'json'
    }).then((res)=>{
        console.log(res.data);
        promociones= res.data;
        for(let llave in res.data){
            if(res.data[llave].idEnterprise==idEmpresa){
                document.getElementById('idProductQr').innerHTML+=
                `<option value="${llave}">${res.data[llave].products}</option>`
        }
    }
    }).catch((error)=>{
        console.error(error);
    });

function generarInfo(){
    document.getElementById('space').style.display='inline';
    document.getElementById('msj').style.display='none';

    for(let llave in promociones){
        if(document.getElementById('idProductQr').value==llave){
            document.getElementById('imgProduct').innerHTML=`<img src="${promociones[llave].urlProductPromoImage}" style="width: 280px; height: 300px">`
            document.getElementById('name').innerHTML=`<b>${promociones[llave].products}</b>`
            document.getElementById('discount').innerHTML= `<h4  style="color: red; font-size: 100px; text-align: center;">-${promociones[llave].Discount}</h4>` ;
            document.getElementById('category').innerHTML=`<h4 style="text-align: center;">Category: ${promociones[llave].selectCategory}</h4>`;
            document.getElementById('priceProduct').innerHTML=`<h4 style="text-align: center;">Precio normal: <s>$${promociones[llave].priceProduct}</s></h4>`;
            document.getElementById('discountPromo').innerHTML=`<h4 style="text-align: center;">Precio con descuento: <b>$${promociones[llave].discountPromo}</b></h4>`;
            document.getElementById('sucursal').innerHTML=`<h4 style="text-align: center;">Sucursales:<br> <li>${promociones[llave].sucursal}</li> </h4>`;
            update_qrcode();
        }
    }
}


function imprimir(){
    print();
}