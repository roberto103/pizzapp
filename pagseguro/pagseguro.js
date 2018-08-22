var installments = [];

$("input[name='cardNumber']").keyup(function(){
    getInstallments();
});

$("#select-installments").change(function(){
    console.log(installments[$(this).val()-1]);
    $("input[name='installmentValue']").val(installments[$(this).val()-1].installmentAmount);
});

function getInstallments(){
    
    var cardNumber = $("input[name='cardNumber']").val();
    
    //if creditcard number is finished, get installments
    if(cardNumber.length != 19){
        return;
    } 

    PagSeguroDirectPayment.getBrand({
        cardBin: cardNumber.replace(/ /g,''),
        success: function(json){
            console.log(json);
            var brand = json.brand.name;
            $("input[name='brand']").val(brand);
            
            var amount = parseFloat($("input[name='amount']").val());
            var shippingCoast = parseFloat($("input[name='shippingCoast']").val());
            
            //The maximum installment qty with no extra fees (You must configure it on your PagSeguro dashboard with same value)
            var max_installment_no_extra_fees = 2;

            PagSeguroDirectPayment.getInstallments({
                amount: amount + shippingCoast,
                brand: brand,
                maxInstallmentNoInterest: max_installment_no_extra_fees,
                success: function(response) {
                    
                    /*
                        Available installments options.
                        Here you have quantity and value options
                    */
                    console.log(response);
                    installments = response.installments[brand];
                    $("#select-installments").html("");
                    for(var installment of installments){
                        $("#select-installments").append("<option value='" + installment.quantity + "'>" + installment.quantity + " x R$ " + installment.installmentAmount + " - " + (installment.quantity <= max_installment_no_extra_fees? "Sem" : "Com")  + " Juros</option>");
                    }

                }, error: function(response) {
                    console.log(response);
                }, complete: function(response) {
                    //Called after sucess or error
                } 
            });
        }, error: function(json){
            console.log(json);
        }, complete: function(json){
            console.log(json);
        }
    });
}
    
$("button").click(function(){
    var param = {
        cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
        brand: $("input[name='brand']").val(),
        cvv: $("input[name='cardCVC']").val(),
        expirationMonth: $("input[name='cardExpiry']").val().split('/')[0],
        expirationYear: $("input[name='cardExpiry']").val().split('/')[1],
        success: function(json){
            var token = json.card.token;
            $("input[name='token']").val(token);
            console.log("Token: " + token);

            var senderHash = PagSeguroDirectPayment.getSenderHash();
            $("input[name='senderHash']").val(senderHash);
            $("form").submit();
        }, error: function(json){
            console.log(json);
        }, complete:function(json){
        }
    }

    PagSeguroDirectPayment.createCardToken(param);
});

jQuery(function($) {

    var shippingCoast = parseFloat($("input[name='shippingCoast']").val());
    var amount = parseFloat($("input[name='amount']").val());
    $("input[name='installmentValue']").val(amount + shippingCoast);

    PagSeguroDirectPayment.setSessionId('<?php echo $sessionCode;?>');

    PagSeguroDirectPayment.getPaymentMethods({
        success: function(json){

            console.log(json);
            getInstallments();

        }, error: function(json){
            console.log(json);
            var erro = "";
            for(i in json.errors){
                erro = erro + json.errors[i];
            }
            
            alert(erro);
        }, complete: function(json){
        }
    });
    });