

let addTextButton = document.getElementById("add-text");
addTextButton.addEventListener('click', addText)

//let i = 0;

let i;

if(url_chek == "edit-protocol-practitioner-view")
{
    i = $('.headingg').length-1;
}


function addText() {


    if(url_chek == "add-edit-protocol-practitioner")
    {
        //  i =0;
        var numItems = $('.heading_apend').length

        if(numItems == 0)
        {

            i = $('.heading_apend').length-1;

        }else{
            i = $('.heading_apend').length-1;
        }
    }

   let addText = document.getElementById('protocol__section-heading-text' + i);
   let textClone = addText.cloneNode(true);
   textClone.id = "protocol__section-heading-text" + ++i;
   addText.parentNode.appendChild(textClone);
   $("#protocol__section-heading-text" + i).find('input,textarea,select').text(' ');

}

let addProductButton = document.getElementById("add-product");
addProductButton.addEventListener('click', addProduct);



function addProduct() {
    let j = $('#add-product').attr('data-id');
    let dataId = j;
   // console.log('2', j);
    // alert($('#add-product').attr('data-id'))
    $('#add-product').attr('data-id', ++dataId);
   let addProduct = document.getElementById('protocol__section-product-cont' + j);

   let productClone = addProduct.cloneNode(true);
   productClone.id = "protocol__section-product-cont" + ++j;
   addProduct.parentNode.appendChild(productClone);
   $("#protocol__section-product-cont" + j).find('input,textarea,select,img').attr('value', '');


    $("#protocol__section-product-cont" + j).find('img').attr("src",'https://40.freelancedeveloper.site/web_sayt/img/protocol-img/protocol-img/product-img2.svg');
    $("#protocol__section-product-cont" + j).find(".id_Product").attr('name', 'clone_id_product[]');

   $("#protocol__section-product-cont" + j).find('input').attr('id', 'img-file' + j);
   $("#protocol__section-product-cont" + j).find('label').attr('for', 'img-file' + j);


}



let addLinkButton = document.getElementById("add-link");
addLinkButton.addEventListener('click', addLink)

//let k = 0;

let k;

if(url_chek == "edit-protocol-practitioner-view")
{
     k = $('.linkk').length-1;
}

function addLink() {

    if(url_chek == "add-edit-protocol-practitioner")
    {
        var numItems = $('.link_apend').length

         if(numItems == 0)
        {
             k = 0;
        }else{
             k = $('.link_apend').length-1;
        }
    }


   let addLink = document.getElementById('protocol__section-link-cont' + k);
   let linkClone = addLink.cloneNode(true);
   linkClone.id = "protocol__section-link-cont" + ++k;
   addLink.parentNode.appendChild(linkClone);
   $("#protocol__section-link-cont" + k).find('input,textarea,select').attr('value', '');

}

let addAnotherButton = document.getElementById("add-text-another");
addAnotherButton.addEventListener('click', addTextAnother)


 //let c = 0

let c;

if(url_chek == "edit-protocol-practitioner-view")
{
    c = 0;
}
function addTextAnother() {

    if(url_chek == "add-edit-protocol-practitioner")
    {
        var numItems = $('.another_ap').length

        if(numItems == 0)
        {
            c = 0;
        }else{
            c = $('.another_ap').length-1;
        }
    }

    let main = document.getElementsByClassName('content-background-child')[0];
    let addTextAnother = document.getElementById('protocol__section-heading-text-another' + c);
    let textCloneAnother = addTextAnother.cloneNode(true);
    textCloneAnother.id = "protocol__section-heading-text-another" + ++c;
    main.appendChild(textCloneAnother);
    $("#protocol__section-heading-text-another" + c).find('input,textarea,select').attr('value', '');

}
