<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_POST['aluno'];
    $curso = $_POST['curso'];

    require("conexao.php");

    $inserir = "INSERT INTO matricula (nome,curso) VALUES ('$nome','$curso')";

    if (mysqli_query($conexao, $inserir)) {

        echo "
        <script>

        alert('Cadastro Realizado com sucesso!');
        window.location.href = 'cadastro.php';
        
        </script>";
        exit();
    } else {
        echo "
        <script>

        alert('Erro ao cadastrar:" . mysqli_error($conexao) . "';
        window.history.back();
        
        </script>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <title>Cadastro de Curso</title>
</head>

<body>
    <nav class="navbar lg:navbar-expand bg-1 fg-2">
        <div class="container-fluid">
            <a class="navbar-brand fs-lg" href="index.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-folder-fill pe-2" viewBox="0 0 16 16">
                    <path
                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3m-8.322.12q.322-.119.684-.12h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981z" />
                </svg>
                Cadastro Acadêmico
            </a>
            <button class="btn-icon navbar-toggler" type="button" data-bs-toggle="drawer"
                data-bs-target="#navbarNavMenu" aria-controls="navbarNavMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" aria-hidden="true"></span>
            </button>
            <dialog class="drawer drawer-end" tabindex="-1" id="navbarNavMenu" aria-labelledby="navbarNavMenuLabel">
                <div class="drawer-header">
                    <h5 class="drawer-title" id="navbarNavMenuLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
                </div>
                <div class="drawer-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.php">Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="atualizarCurso.php">Editar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lendoDados.php">Visualizar</a>
                        </li>

                    </ul>
                </div>
            </dialog>
        </div>
    </nav>
    <section class="container-fluid w-100">
        <h2 class="pt-6">Cadastro de Aluno</h2>
        <form method="post" action="" class="container w-100 pt-10">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control mv-50" name="aluno">
            </div>
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <input type="text" class="form-control" name="curso">
            </div>
            <button type="reset" class="btn-solid theme-primary">Limpar</button>
            <button type="submit" class="btn-solid theme-primary">Cadastrar</button>
        </form>
    </section>
</body>

</html>