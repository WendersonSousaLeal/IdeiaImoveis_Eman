<?php
// Simulação de processamento do cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar dados do formulário
    $dados = [
        'nome' => $_POST['nome'] ?? '',
        'telefone' => $_POST['telefone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'cpf' => $_POST['cpf'] ?? '',
        'tipo_imovel' => $_POST['tipo_imovel'] ?? '',
        'transacao' => $_POST['transacao'] ?? '',
        'preco' => $_POST['preco'] ?? '',
        'area' => $_POST['area'] ?? '',
        'quartos' => $_POST['quartos'] ?? '',
        'banheiros' => $_POST['banheiros'] ?? '',
        'endereco' => $_POST['endereco'] ?? '',
        'descricao' => $_POST['descricao'] ?? ''
    ];
    
    // Aqui você normalmente salvaria no banco de dados
    // Por enquanto, vamos apenas simular o sucesso
    
    // Redirecionar para página de sucesso
    header('Location: cadastro_sucesso.html');
    exit;
} else {
    // Se não for POST, redireciona para o formulário
    header('Location: cadastro_proprietario.html');
    exit;
}
?>