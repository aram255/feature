// For Sign
$(".lg-sg-overflow").click(function () {
   $("body").addClass("open")
});
let click = document.querySelector('body');
click.onclick = function (event) {
   let targetE = event.target
   if (targetE.className === "modal fade") {
      click.classList.remove("open")
   } else if (targetE.className === 'x') {
      click.classList.remove("open")
   }
};

function customerPayment() {
   let personCustomerPaymentsDrop = document.getElementsByClassName('person-customer__payments-methods-dropdown')[0]
   personCustomerPaymentsDrop.classList.toggle('d-none');
}