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
addProductButton.addEventListener('click', addProduct)
let j = 0;


function addProduct() {
   let addProduct = document.getElementById('protocol__section-product-cont' + j);
   let productClone = addProduct.cloneNode(true);
   productClone.id = "protocol__section-product-cont" + ++j;
   addProduct.parentNode.appendChild(productClone);
   $("#protocol__section-product-cont" + j).find('input,textarea,select').val('');

// $('.img-file').attr('id',(Math.floor(Math.random() * (9999))))

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
