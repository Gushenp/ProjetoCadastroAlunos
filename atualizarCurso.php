<?php

require("conexao.php");

if (isset($_POST['atualizar'])) {
    $idMatricula    = $_POST['idMatricula'];
    $nome           = $_POST['nome'];
    $curso          = $_POST['curso'];

    $atualizar = "UPDATE matricula SET nome = '$nome', curso = '$curso' WHERE idMatricula = '$idMatricula'";

    if (mysqli_query($conexao, $atualizar)) {
        echo "
        <script>
            alert('Dados atualizado com sucesso');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ai atualizar" . mysqli_error($conexao);
    }
}

$editaAluno = null;

if (isset($_GET['editar'])) {

    $idEditar = $_GET['editar'];

    $resultado = mysqli_query(
        $conexao,
        "SELECT * FROM matricula WHERE idMatricula = $idEditar"
    );

    $editaAluno = mysqli_fetch_assoc($resultado);
}

$alunos = mysqli_query(
    $conexao,
    "SELECT * FROM matricula"
);


if (isset($_GET['apagar'])) {
    $idMatricula = $_GET['apagar'];

    $deletar = "DELETE FROM matricula WHERE idMatricula = $idMatricula";

    if (mysqli_query($conexao, $deletar)) {
        echo "
        <script>
            alert('Dado excluido com sucesso!');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ao deletar." . mysqli_error($conexao);
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

    <title>Atualizar Alunos</title>
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
    <h2 class="ms-5 text-center mb-10">Atualizar Cadastro</h2>
    <div class="container-fluid d-flex justify-content-center">
        <div class="bg-3 rounded-6 d-flex justify-content-center p-5 pt-10">
            <table class="table table-striped ms-6 me-6 w-auto">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Curso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                        <tr>
                            <td><?= $aluno['idMatricula'] ?></td>
                            <td><?= $aluno['nome'] ?></td>
                            <td><?= $aluno['curso'] ?></td>
                            <td>
                                <a href="?editar=<?= $aluno["idMatricula"] ?>"><button type="button" class="btn-solid theme-primary">Editar</button></a>
                                <a href="?apagar=<?= $aluno["idMatricula"] ?>"><button type="button" class="btn-solid theme-danger">Apagar</button></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php if ($editaAluno): ?>
            <div class="ms-10 bg-3 p-5 rounded-9 centered">
                <h3>Editar Aluno</h3><br>

                <form method="POST">
                    <input type="hidden" name="idMatricula"
                        value="<?= $editaAluno['idMatricula'] ?>">

                    <label for="">Nome: </label><br>
                    <input type="text" class="form-control" name="nome"
                        value="<?= $editaAluno['nome'] ?>"><br>

                    <label for="">Curso: </label> <br>
                    <input type="text" class="form-control" name="curso"
                        value="<?= $editaAluno['curso'] ?>"><br>

                    <div class="text-center">
                        <button type="submit" name="atualizar" class="btn-solid theme-success">Atualizar</button>
                        <a href="atualizarCurso.php"><button type="button" class="btn-solid theme-danger">Cancelar</button></a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>