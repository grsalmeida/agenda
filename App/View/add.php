<!doctype html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
	<body>
		<script type="text/javascript">
			$(document).ready(function(){
 				$('.str_telefone').mask('(00) 0000-0000');
  				$('.str_celular').mask('(00) 00000-0000');
  			});
		</script>
		<div class="container">
			<nav aria-label="breadcrumb">
			<div class="row">
				<div class="col-md-12" style="padding-bottom: 30px;">

				</div>
			</div>
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item active" aria-current="page"><a href="/lista">Home</a></li>
			  </ol>
			</nav>
			<div class="row">
				<div class="col-md-12">
					<form id="register" action="/cadastrar" method="post">
					  	<div class="form-group">
						    <label for="nome">Nome</label>
						    <input type="text" class="form-control" id="str_nome" name="str_nome" placeholder="Nome e sobrenome">
						</div>
						<div class="form-group">
						    <label for="email">Email</label>
						    <input type="email" class="form-control" id="str_email" name="str_email" placeholder="email@example.com">
						</div>
						<div class="form-group">
						    <label for="telefone">Telefone fixo</label>
						    <input type="text" class="form-control" id="str_telefone" name="str_telefone" placeholder="41 9999-9999" data-mask="(00) 0000-0000" data-mask-clearifnotmatch="true" />
						</div>
						<div class="form-group">
						    <label for="celular">Celular</label>
						    <input type="text" class="form-control" id="str_celular" name="str_celular" placeholder="41 99999-9999" data-mask="(00) 0000-00000" data-mask-clearifnotmatch="true" />
						</div>				
						<div style="float: right;">
						 <button type="submit" class="btn btn-primary">salvar</button>
						 <button type="reset" class="btn btn-danger">cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="<?= self::asset("js/jquery.mask.min.js") ?>" type="text/javascript"></script>
	</body>
</html>