<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];

    if (!empty($id) && is_numeric($id)) {
        $conn = new mysqli('localhost', 'root', '', 'estoque');

        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados.']));
        }

        $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item excluído com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir o item.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
}
?>