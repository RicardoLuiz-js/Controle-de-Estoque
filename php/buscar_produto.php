<?php
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conecta ao banco de dados
    $conn = new mysqli('localhost', 'root', '', 'estoque');

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados.']));
    }

    // Busca os dados do produto
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
        echo json_encode($produto);
    } else {
        echo json_encode(['success' => false, 'message' => 'Produto não encontrado.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID do produto não fornecido.']);
}
?>