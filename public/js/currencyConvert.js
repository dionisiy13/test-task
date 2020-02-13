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

        if (currentValue < 0) {
            currentValue *= -1;
            $("[name='value']").val(currentValue);
        }

        let result = parseFloat(rates[currency] * currentValue).toFixed(2);

        $("#result").html(result);
    }
});