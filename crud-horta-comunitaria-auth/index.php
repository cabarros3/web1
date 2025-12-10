<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Horta Comunitária</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento da Horta Comunitária</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="voluntario/index_voluntarios.php">Gerenciar Voluntários</a></li>
                    <li><a href="instituicao/index_instituicao.php">Gerenciar uma Instituição</a></li>
                    <li><a href="auth/logout.php">Logout (<?= $_SESSION['name'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="./auth/user-login.php">Login</a></li>
                    <li><a href="./auth/user-register.php">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Bem-vindo ao CRUD da Horta Comunitária</h2>
        <p>Utilize o menu acima para navegar pelo sistema.</p>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Horta Comunitária</p>
    </footer>
</body>
</html>
