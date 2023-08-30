<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora IMC</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_POST["altura"])) {

        $altura = $_POST["altura"];
        $alturaFormat = $altura / 100;

        $peso = $_POST["peso"];
        $imcValor = $peso / ($alturaFormat ** 2);

    }
    ?>
    <main class="container">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <h1>Calcule seu IMC</h1>
            <div class="input-box">
                <input type="number" name="altura" id="altura" placeholder="Altura (cm)" required>
            </div>
            <div class="input-box">
                <input type="number" name="peso" id="peso" placeholder="Peso (kg)" step="0.01" required>
            </div>
            <input type="submit" class="btn" value="Calcular">

            <?php
            function classificarIMC($imc)
            {
                $faixas = array(
                    array('faixa' => 18.5, 'classificacao' => 'Magreza'),
                    array('faixa' => 24.9, 'classificacao' => 'Saudável'),
                    array('faixa' => 29.9, 'classificacao' => 'Sobrepeso'),
                    array('faixa' => 34.9, 'classificacao' => 'Obesidade Grau I'),
                    array('faixa' => 39.9, 'classificacao' => 'Obesidade Grau II'),
                    array('faixa' => PHP_FLOAT_MAX, 'classificacao' => 'Obesidade Grau III')
                );

                foreach ($faixas as $faixa) {
                    if ($imc <= $faixa['faixa']) {
                        return $faixa['classificacao'];
                    }
                }

                return 'Classificação não encontrada';
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $classificacao = classificarIMC($imcValor);

                echo "<div class='resposta'><p>Atenção, seu IMC é <strong>" . number_format($imcValor, "2", ".") . "</strong>, e você está classificado como <strong>$classificacao</strong></p></div>";
            }
            ?>
        </form>
    </main>
</body>

</html>