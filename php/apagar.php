<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estoque";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar qual tabela deve ser apagada
if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];

    // Verificar se a tabela é válida
    if ($tabela == "utilizados") {
        // Query para apagar todos os dados da tabela
        $sql = "TRUNCATE TABLE $tabela";

        if ($conn->query($sql) === TRUE) {
            echo "Todos os dados da tabela " . ucfirst($tabela) . " foram apagados com sucesso.";
        } else {
            echo "Erro ao apagar dados: " . $conn->error;
        }
    } else {
        echo "Tabela inválida.";
    }
} else {
    echo "Nenhuma tabela especificada.";
}

// Fechar conexão
$conn->close();
?>