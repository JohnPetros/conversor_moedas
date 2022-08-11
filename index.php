<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // RECEBER O VALOR E AS MOEDAS
    $convertFrom = $_POST['convertFrom'];
    $convertTo = $_POST['convertTo'];
    $value = trim($_POST['value']);

    // DEFINIR SE É UM VALOR VÁLIDO
    $isValidateValue = validateValue($value);
    
    if ($isValidateValue) {
        $value = floatval($value);
        // DEFINIR QUAL MOEDA SERÁ CONVERTIDA
        switch ($convertFrom) {
            case "dolar":
                convertDolar($value, $convertTo);
                break;
            case "real":
                convertReal($value, $convertTo);
                break;
            case "euro":
                convertEuro($value, $convertTo);
                break;
            case "yen":
                convertYen($value, $convertTo);
        }
    }
}

function validateValue($value)
{
    global $errorMessage;
    // O CAMPO NÃO PODE ESTAR VAZIO
    if (empty($value)) {
        $errorMessage = 'Preencha o campo!';
        return false;
    }
    // O VALOR SÓ PODE CONTER NÚMEROS
    if (preg_match("/[a-z]/i", $value)) {
        $errorMessage = "digite apenas números!";
        return false;
    }
    // SE O VALOR FOI ESCRITO COM VÍRGULA, SUBSTITUIR ELA POR UM PONTO
    if (strpos($value, ',')) {
        $value = str_replace(",", ".", $value);    
    }
    return true;
}

function convertDolar($value, $convertTo)
{
    global $result, $symbol;
    switch ($convertTo) {
        case "dolar":
            $result = $value;
            $symbol = "$";
            break;
        case "real":
            $result = $value * 5.16;
            $symbol = "R$";
            break;
        case "euro":
            $result = $value * 0.98;
            $symbol = "€";
            break;
        case "yen":
            $result = $value * 135;
            $symbol = "¥";
            break;
        case "bitcoin":
            $result = $value * 0.000043;
            $symbol = "₿";
    }
}

function convertReal($value, $convertTo)
{
    global $result, $symbol;
    switch ($convertTo) {
        case "dolar":
            $result = $value * 0.19;
            $symbol = "$";
            break;
        case "real":
            $result = $value;
            $symbol = "R$";
            break;
        case "euro":
            $result = $value * 0.19;
            $symbol = "€";
            break;
        case "yen":
            $result = $value * 26.13;
            $symbol = "¥";
            break;
        case "bitcoin":
            $result = $value * 0.0000084;
            $symbol = "₿";
    }
}

function convertEuro($value, $convertTo)
{
    global $result, $symbol;
    switch ($convertTo) {
        case "dolar":
            $result = $value * 1.02;
            $symbol = "$";
            break;
        case "real":
            $result = $value * 5.26;
            $symbol = "R$";
            break;
        case "euro":
            $result = $value;
            $symbol = "€";
            break;
        case "yen":
            $result = $value * 137.47;
            $symbol = "¥";
    }
}

function convertYen($value, $convertTo)
{
    global $result, $symbol;
    switch ($convertTo) {
        case "dolar":
            $result = $value * 0.0074;
            $symbol = "$";
            break;
        case "real":
            $result = $value * 0.038;
            $symbol = "R$";
            break;
        case "euro":
            $result = $value * 0.0073;
            $symbol = "€";
            break;
        case "yen":
            $result = $value;
            $symbol = "¥";
            break;
        case "bitcoin":
            $result = $value * 0.00000032;
            $symbol = "₿";
    }
}

function convertBitcoin($value, $convertTo)
{
    global $result, $symbol;
    switch ($convertTo) {
        case "dolar":
            $result = $value * 23162.90;
            $symbol = "$";
            break;
        case "real":
            $result = $value * 119619.31;
            $symbol = "R$";
            break;
        case "euro":
            $result = $value * 22752.80;
            $symbol = "€";
            break;
        case "yen":
            $result = $value * 3126759.87;
            $symbol = "¥";
            break;
        case "bitcoin":
            $result = $value;
            $symbol = "₿";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="favicon_io/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="coin"></div>
        <h1 class="title">Conversor de Moeda</h1>
        <div class="coin"></div>
    </header>
    <main class="container">
        <form class="convertor" method="post">
            <p>de:</p>
            <div class="convert">
                <select name="convertFrom" class="currencySelection" id="">
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertFrom'] == 'dollar') echo 'selected'; ?> value="dolar">USD</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertFrom'] == 'real') echo 'selected'; ?> value="real">BRL</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertFrom'] == 'euro') echo 'selected'; ?> value="euro">EUR</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertFrom'] == 'yen') echo 'selected'; ?> value="yen">JPY</option>
                </select>
                <input type="text" name="value" class="value" autofocus>
            </div>
            <p>para:</p>
            <div class="convert">
                <select name="convertTo" class="currencySelection" id="">
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertTo'] == 'dolar') echo 'selected'; ?> value="dolar">USD</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertTo'] == 'real') echo 'selected'; ?> value="real">BRL</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertTo'] == 'euro') echo 'selected'; ?> value="euro">EUR</option>
                    <option <?php if (isset($_POST['convertFrom']) && $_POST['convertTo'] == 'yen') echo 'selected'; ?> value="yen">JPY</option>
                </select>

                <input type="text"
                 class="currencyConverted"
                readonly value="<?php  // VERIFICAR SE HOUVE RESULTADO
                                    if (
                                        isset($_POST['convertFrom']) &&
                                        isset($_POST['convertTo']) &&
                                        isset($result)) {
                                    // DEFINIR VALOR COM 2 DECIMAIS
                                    echo $symbol . number_format($result, 2,",",".");
                                } elseif (
                                        isset($_POST['convertFrom']) &&
                                        isset($_POST['convertTo'])
                                    ) {
                                    // MOSTRAR MENSAGEM DE ERRO
                                    echo $errorMessage;
                                }  ?>">
            </div>
            <button class="convertButton">Converter</button>
        </form>
    </main>
</body>

</html>