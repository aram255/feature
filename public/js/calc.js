function Calc() {}

Calc.prototype.changeGold = function (event,type) {

    if(type == 'rso'){
        var goldInput = $('#rso_gold_input');
        var priceInput = $('#rso_price_input');
        var rate = $RSO_rate;
    }
    if(type == 'rs'){
        var goldInput = $('#rs_gold_input');
        var priceInput = $('#rs_price_input');
        var rate = $RS_rate;
    }

    // Float validation
    var gold = goldInput.val();

    if (event.which != 46 && (event.which != 190 || gold.indexOf('.') != -1) && (event.which < 48 || event.which > 57) && event.which != 8) {
        event.preventDefault();
        return
    }

    setTimeout(function() {
        var gold = goldInput.val();
        price = gold * rate;
        priceInput.val(price.toFixed(2));
    }, 1);
    
}

Calc.prototype.changePrice = function (event,type) {

    if(type == 'rso'){
        var goldInput = $('#rso_gold_input');
        var priceInput = $('#rso_price_input');
        var rate = $RSO_rate;
    }
    if(type == 'rs'){
        var goldInput = $('#rs_gold_input');
        var priceInput = $('#rs_price_input');
        var rate = $RS_rate;
    }

    // Float validation
    var price = priceInput.val();
    if (event.which != 46 && (event.which != 190 || price.indexOf('.') != -1) && (event.which < 48 || event.which > 57) && event.which != 8) {
        event.preventDefault();
        return
    }

    setTimeout(function() {
        var price = priceInput.val();
        gold = price / rate;
        goldInput.val(gold.toFixed(2));
    }, 1);
}

var Calc = new Calc();

function preOrder(type){
    if(type == 'rso'){
        var container = $('#rso_container');
        var goldInput = $('#rso_gold_input');
    }
    if(type == 'rs'){
        var container = $('#rs_container');
        var goldInput = $('#rs_gold_input');
    }

    //Disable submit
    button = container.find(':button')
    button.attr("disabled", true);
    
    $(container.find('.validationError')).each(function() {
        $(this).removeClass('validationError')
    });

    var error = 0;
    
    //Validate order
    if(goldInput.val() == '' || goldInput.val().length <1){
        goldInput.addClass('validationError')
        error = 1;
    }
    
    email = container.find('input[name ="email"]')
    
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if(email.val().length > 1){
        if(!emailReg.test(email.val())) {   
            email.addClass('validationError')
            error = 1
        }
    }else{
        email.addClass('validationError')
        error = 1
    }

    username = container.find('input[name ="rsn"]')
    if(username.val() == '' || username.val().length <1){
        username.addClass('validationError')
        error = 1;
    }
    
    if(error == 1){
        button.attr("disabled", false);
        return false;
    }

    // Order validate can pass to backend
    container.find('form').submit()
}

function order(){

    var container = $('.checkout__form');

    //Disable submit
    button = $('#submitOrder');
    button.attr("disabled", true);
    
    $(container.find('.validationError')).each(function() {
        $(this).removeClass('validationError')
    });

    var error = 0;
    
    //Validate order
    username = container.find('input[name ="rsn"]')
    if(username.val() == '' || username.val().length <1){
        username.addClass('validationError')
        error = 1;
    }
    
    if(!$('#customCheck1:checked').length){
        $('#customCheck1').focus()
        error = 1;
    }

    email = container.find('input[name ="email"]')
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if(email.val().length > 1){
        if(!emailReg.test(email.val())) {   
            email.addClass('validationError')
            error = 1
        }
    }else{
        email.addClass('validationError')
        error = 1
    }

    first_name = container.find('input[name ="first_name"]')
    if(first_name.val().length < 1){
        first_name.addClass('validationError')
        error = 1
    }

    last_name = container.find('input[name ="last_name"]')
    if(last_name.val().length < 1){
        last_name.addClass('validationError')
        error = 1
    }
    
    paymentType = container.find('input[name="payment"]:checked').val();
    if(paymentType != 'g2a' && paymentType != 'coinbase'){
        error = 1
    }
    
    if(!$('#agree:checked').length){
        $('#agree').focus()
        error = 1;
    }

    if(error == 1){
        button.attr("disabled", false);
        return false;
    }

    // Order validate can pass to backend
    container.submit()
}