<?php
session_start();

// Verifica se existe uma sessão ativa. Se não, redireciona para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /php/usuario/login.php");
    exit;
}

// Pegamos os dados da sessão para exibir no cabeçalho
$nome_usuario = $_SESSION['usuario_nome'];
$foto_usuario = $_SESSION['usuario_foto'] ?? 'default.png'; // Fallback caso não tenha foto
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital - Sistema de Gerenciamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 00-2-2H9a2 2 0 00-2 2v2m-4-4h6m-6 4h6m6-4h6m-6 4h6M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                </svg>
                <h1 class="text-2xl font-bold text-gray-800">Sistema Hospitalar</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <nav class="hidden md:flex space-x-4">
                    <a href="index.php" class="text-blue-600 font-bold transition duration-300">Home</a>
                </nav>

                <div class="flex items-center border-l pl-6 space-x-3">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800 leading-none"><?php echo $nome_usuario; ?></p>
                        <a href="/php/usuario/logout.php" class="text-xs text-red-500 hover:underline">Sair</a>
                    </div>
                    <img src="/php/storage/<?php echo $foto_usuario; ?>" 
                         alt="Perfil" 
                         class="h-10 w-10 rounded-full object-cover border-2 border-blue-500 shadow-sm">
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-6 py-8">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Bem-vindo ao Painel</h2>
            <p class="text-gray-600 mt-2">Olá, <?php echo explode(' ', $nome_usuario)[0]; ?>! Selecione uma opção abaixo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                <div class="bg-blue-600 p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-white text-xl font-bold mt-2">Médicos</h3>
                </div>
                <div class="p-6 flex flex-col space-y-3">
                    <a href="/php/medico/create-medico.php" class="block w-full text-center bg-blue-100 text-blue-700 font-semibold py-2 rounded hover:bg-blue-200 transition">
                        + Adicionar Médico
                    </a>
                    <a href="/php/medico/index.php" class="block w-full text-center border border-blue-600 text-blue-600 font-semibold py-2 rounded hover:bg-blue-600 hover:text-white transition">
                        Ver Lista
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                <div class="bg-teal-600 p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="text-white text-xl font-bold mt-2">Pacientes</h3>
                </div>
                <div class="p-6 flex flex-col space-y-3">
                    <a href="/php/paciente/create-paciente.php" class="block w-full text-center bg-teal-100 text-teal-700 font-semibold py-2 rounded hover:bg-teal-200 transition">
                        + Adicionar Paciente
                    </a>
                    <a href="/php/paciente/index.php" class="block w-full text-center border border-teal-600 text-teal-600 font-semibold py-2 rounded hover:bg-teal-600 hover:text-white transition">
                        Ver Lista
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                <div class="bg-purple-600 p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-white text-xl font-bold mt-2">Consultas</h3>
                </div>
                <div class="p-6 flex flex-col space-y-3">
                    <a href="/php/consulta/create-consulta.php" class="block w-full text-center bg-purple-100 text-purple-700 font-semibold py-2 rounded hover:bg-purple-200 transition">
                        + Nova Consulta
                    </a>
                    <a href="/php/consulta/index.php" class="block w-full text-center border border-purple-600 text-purple-600 font-semibold py-2 rounded hover:bg-purple-600 hover:text-white transition">
                        Ver Agenda
                    </a>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t mt-8">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500 text-sm">
            <p>&copy; 2025 - Sistema Hospitalar. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>