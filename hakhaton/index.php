<?php 
	include_once('conexao.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Senac Res.Recursos</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
</head>
	<body>
		<div class="container mt-5" style="">
			<?php include_once("menssagens.php") ?>
			<div class="bg-light" style="box-shadow: lightgray 1px 1px 2px 1px; border-radius: 5px; width: 65%; margin: 0 auto;">
				<div style="text-align: center; width: 75%; margin: 0 auto;">
					<br>
					<form action="validar.php" method="POST">
						<div class="form-floating mb-3">
						  <input name="email" class="form-control" id="floatingInput" placeholder="email">
						  <label for="floatingInput">E-email:</label>
						</div>
						<div class="form-floating mb-3">
						  <input name="senha" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
						  <label for="inputPassword5" class="form-label">Senha:</label>
						</div>
						<div class="row mt-3">
							<div class="col-md-12">
								<button class="btn btn-outline-success">Acessar</button>
							</div>
							<p class="text-center text-muted mt-3">Não tem cadastro? <a href="cadastro.usuario.php">Crie sua conta!</a></p>
						</div>
					</form>
					<br>
				</div>
			</div>

		</div>

	</body>
</html>