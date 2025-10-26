<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>K-pop Competições</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">K-pop Competições</h1>

    <div class="grid grid-cols-1 gap-4">
        <!-- Grupos -->
        <a href="grupos/read_grupos.php" 
           class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded text-center transition-colors">
            Gerenciar Grupos
        </a>

        <!-- Músicas -->
        <a href="musicas/read_musicas.php" 
           class="block bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded text-center transition-colors">
            Gerenciar Músicas
        </a>

        <!-- Competições -->
        <a href="competicao/read_competicao.php" 
           class="block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded text-center transition-colors">
            Gerenciar Competições
        </a>

        <!-- Participações -->
        <a href="participacao/read_participacao.php" 
           class="block bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 rounded text-center transition-colors">
            Gerenciar Participações
        </a>
    </div>
</div>

</body>
</html>
