let addTextButton = document.getElementById("add-text");
addTextButton.addEventListener('click', addText)
let i = 0
function addText() {
   let addText = document.getElementById('protocol__section-heading-text' + i);
   let textClone = addText.cloneNode(true);
   textClone.id = "protocol__section-heading-text" + ++i;
   addText.parentNode.appendChild(textClone);
   $("#protocol__section-heading-text" + i).find('input,textarea,select').val('');

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
   console.log(addProduct)
   let productClone = addProduct.cloneNode(true);
   productClone.id = "protocol__section-product-cont" + ++j;
   addProduct.parentNode.appendChild(productClone);
   $("#protocol__section-product-cont" + j).find('input,textarea,select,img').val('');


    $("#protocol__section-product-cont" + j).find('img').attr("src",'http://new-feature/web_sayt/img/protocol-img.svg');

   $("#protocol__section-product-cont" + j).find('input').attr('id', 'img-file' + j);
   $("#protocol__section-product-cont" + j).find('label').attr('for', 'img-file' + j);


}

let addLinkButton = document.getElementById("add-link");
addLinkButton.addEventListener('click', addLink)
let k = 0
function addLink() {
   let addLink = document.getElementById('protocol__section-link-cont' + k);
   let linkClone = addLink.cloneNode(true);
   linkClone.id = "protocol__section-link-cont" + ++k;
   addLink.parentNode.appendChild(linkClone);
   $("#protocol__section-link-cont" + k).find('input,textarea,select').val('');

}
