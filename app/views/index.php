<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/js/currencyConvert.js"></script>
</head>
<body>
<script>
    const ratesString = '<?=json_encode($rates)?>';
    const rates = JSON.parse(ratesString);
</script>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
                <form style="margin-top: 10px;">
                    <label for="value">Значение ($)</label>
                    <input class="form-control bind" type="number" min="0" step="0.01" value="0" name="value">
                    <label for="currency">Валюта</label>
                    <select name="currency" class="form-control bind">
                        <?php foreach($currencies as $key => $item): ?>
                            <option value="<?=$key?>"><?=$item?></option>
                        <?php endforeach; ?>
                    </select>
                   <br>
                </form>
                <div class="alert alert-dark" id="result" role="alert">
                    0.00
                </div>
            </div>
        </div>
    </div>
</body>
</html>
