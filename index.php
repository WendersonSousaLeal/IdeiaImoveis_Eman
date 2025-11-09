<?php
// Simulação de busca no banco de dados
$imoveis = [
    [
        'id' => 1,
        'titulo' => 'Casa com 3 quartos no Jardim Paulista',
        'endereco' => 'Rua Augusta, 123 - São Paulo, SP',
        'preco' => 450000,
        'tipo' => 'casa',
        'transacao' => 'venda',
        'quartos' => 3,
        'banheiros' => 2,
        'area' => 120,
        'proprietario' => 'Maria Silva',
        'telefone' => '(11) 99999-1111',
        'email' => 'maria.silva@email.com',
        'descricao' => 'Excelente casa com amplo espaço, jardim e garagem para 2 carros.'
    ],
    [
        'id' => 2,
        'titulo' => 'Apartamento 2 quartos para alugar',
        'endereco' => 'Av. Paulista, 456 - São Paulo, SP',
        'preco' => 1800,
        'tipo' => 'apartamento',
        'transacao' => 'aluguel',
        'quartos' => 2,
        'banheiros' => 1,
        'area' => 65,
        'proprietario' => 'João Santos',
        'telefone' => '(11) 99999-2222',
        'email' => 'joao.santos@email.com',
        'descricao' => 'Apartamento bem localizado, próximo ao metrô e com ótima vista.'
    ]
];

// Filtros da busca
$cidade = $_GET['cidade'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$transacao = $_GET['transacao'] ?? '';

// Aplicar filtros
$resultados = array_filter($imoveis, function($imovel) use ($cidade, $tipo, $transacao) {
    $match = true;
    
    if ($cidade && stripos($imovel['endereco'], $cidade) === false) {
        $match = false;
    }
    
    if ($tipo && $imovel['tipo'] !== $tipo) {
        $match = false;
    }
    
    if ($transacao && $imovel['transacao'] !== $transacao) {
        $match = false;
    }
    
    return $match;
});

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Busca - CasaDireta</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .results-container {
            max-width: 1200px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        
        .results-header {
            margin-bottom: 30px;
        }
        
        .results-count {
            color: #666;
            margin-bottom: 20px;
        }
        
        .imoveis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .imovel-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .imovel-card:hover {
            transform: translateY(-5px);
        }
        
        .imovel-image {
            height: 200px;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }
        
        .imovel-info {
            padding: 20px;
        }
        
        .imovel-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c5530;
            margin-bottom: 10px;
        }
        
        .imovel-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .imovel-address {
            color: #666;
            margin-bottom: 15px;
        }
        
        .imovel-details {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            color: #666;
        }
        
        .proprietario-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        
        .contact-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .contact-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
        }
        
        .whatsapp-btn {
            background: #25D366;
            color: white;
        }
        
        .email-btn {
            background: #2c5530;
            color: white;
        }
        
        .back-btn {
            display: inline-block;
            background: #666;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <h1 class="logo">CasaDireta</h1>
                <ul class="nav-menu">
                    <li><a href="index.html">Início</a></li>
                    <li><a href="index.html#como-funciona">Como Funciona</a></li>
                    <li><a href="index.html#para-proprietarios">Para Proprietários</a></li>
                    <li><a href="login.html" class="login-btn">Entrar</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="results-container">
        <a href="index.html" class="back-btn">← Voltar</a>
        
        <div class="results-header">
            <h1>Imóveis Encontrados</h1>
            <div class="results-count">
                <?php echo count($resultados); ?> imóveis encontrados
                <?php 
                if ($cidade) echo " em " . htmlspecialchars($cidade);
                if ($tipo) echo " - " . ucfirst($tipo);
                if ($transacao) echo " para " . ($transacao === 'venda' ? 'comprar' : 'alugar');
                ?>
            </div>
        </div>

        <?php if (empty($resultados)): ?>
            <div style="text-align: center; padding: 50px;">
                <h3>Nenhum imóvel encontrado com os filtros selecionados.</h3>
                <p>Tente ajustar os critérios da sua busca.</p>
            </div>
        <?php else: ?>
            <div class="imoveis-grid">
                <?php foreach ($resultados as $imovel): ?>
                    <div class="imovel-card">
                        <div class="imovel-image">
                            [Foto do Imóvel]
                        </div>
                        <div class="imovel-info">
                            <div class="imovel-price">
                                R$ <?php echo number_format($imovel['preco'], 0, ',', '.'); ?>
                                <?php if ($imovel['transacao'] === 'aluguel'): ?>
                                    /mês
                                <?php endif; ?>
                            </div>
                            <h3 class="imovel-title"><?php echo htmlspecialchars($imovel['titulo']); ?></h3>
                            <p class="imovel-address"><?php echo htmlspecialchars($imovel['endereco']); ?></p>
                            
                            <div class="imovel-details">
                                <span><?php echo $imovel['quartos']; ?> quartos</span>
                                <span><?php echo $imovel['banheiros']; ?> banheiros</span>
                                <span><?php echo $imovel['area']; ?> m²</span>
                            </div>
                            
                            <p><?php echo htmlspecialchars($imovel['descricao']); ?></p>
                            
                            <div class="proprietario-info">
                                <strong>Proprietário:</strong> <?php echo htmlspecialchars($imovel['proprietario']); ?>
                            </div>
                            
                            <div class="contact-buttons">
                                <a href="https://wa.me/55<?php echo preg_replace('/[^0-9]/', '', $imovel['telefone']); ?>?text=Olá, encontrei seu imóvel no CasaDireta e gostaria de mais informações" 
                                   class="contact-btn whatsapp-btn" target="_blank">
                                    WhatsApp
                                </a>
                                <a href="mailto:<?php echo htmlspecialchars($imovel['email']); ?>?subject=Interesse no imóvel - CasaDireta" 
                                   class="contact-btn email-btn">
                                    Email
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>