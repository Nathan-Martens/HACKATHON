<?php 

	if(isset($_GET['mensagem'])){
		$mensagem = $_GET['mensagem'];
		$tipo =$_GET['tipo'];

		echo '
			<div class="alert alert-'.$tipo.'" role="alert">
				'.$mensagem.'
			</div';
	}

 ?>