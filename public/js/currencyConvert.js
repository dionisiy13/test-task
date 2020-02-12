$(document).ready(function() {

    $(".bind").keyup(function() {
        calculate();
    });
    $(".bind").change(function() {
        calculate();
    });

    function calculate()
    {
        let currentValue = $("[name='value']").val();
        let currency = $("[name='currency']").val();

        let result = parseFloat(rates[currency] * currentValue).toFixed(2);

        $("#result").html(result);
    }
});