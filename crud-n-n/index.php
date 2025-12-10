<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital - Sistema de Gerenciamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sistema Hospitalar</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>

                <li>Médicos:
                    <a href="/php/medico/create-medico.php">Adicionar</a> |
                    <a href="/php/medico/index.php">Listar</a>
                </li>

                <li>Pacientes:
                    <a href="/php/paciente/create-paciente.php">Adicionar</a> |
                    <a href="/php/paciente/index.php">Listar</a>
                </li>

                <li>Consultas:
                    <a href="/php/consulta/create-consulta.php">Adicionar</a> |
                    <a href="/php/consulta/index.php">Listar</a>
                </li>

            </ul>
        </nav>
    </header>

    <main>
        <h2>Bem-vindo ao Sistema Hospitalar</h2>
        <p>Utilize o menu acima para gerenciar médicos, pacientes e consultas.</p>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema Hospitalar</p>
    </footer>
</body>
</html>
