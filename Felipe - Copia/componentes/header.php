<header class="header-principal">
    <nav class="container">
        <div class="logo">
            <a href="<?= url("index.php") ?>">
                <img class="imgba" src="<?= url("assets/imagens/logo.png") ?>" alt="" width="32" height="32">
                <h1>Equações</h1>
            </a>
        </div>

        <ul>
            <?php if (isset($_SESSION['usuario'])) : ?>
                <ul>
                    <li><a href="<?= url("index.php") ?>">Início</a></li>
                    <li><a href="<?= url("exercicios.php") ?>">Exercicíos</a></li>
                    <li><a href="<?= url("ranking.php") ?>">Ranking</a></li>
                    <li><a href="<?= url("contato.php") ?>">Contato</a></li>
                </ul>

                <li><a href="<?= url("perfil.php") ?>" class="btn"><span>Meu perfil</span> <i class="fas fa-user-circle"></i></a></li>
                <li> <label for="form-desconectar"><a role="button" class="btn">Sair</a></label> </li>
            <?php else : ?>
                <li><a href="login.php" class="btn">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<form action="<?= url("php/login.php") ?>" method="post" class="unstyled" hidden>
    <input type="hidden" name="operacao" value="desconectar">
    <input type="submit" id="form-desconectar">
</form>