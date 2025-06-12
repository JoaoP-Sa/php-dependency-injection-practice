<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="src/css/bootstrap.min.css" />
	<link rel="stylesheet" href="src/css/all.min.css" />
	<link rel="stylesheet" href="src/css/style.css" />
	<title>Início</title>
</head>

<body>
	<?php include 'components/header.php'; ?>

	<?php include 'components/aside.php'; ?>

	<main>
		<section>
			<div class="row pt-2 pb-3">
				<div class="col-md-12">
					<h2>Painel de Controle</h2>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h3 class="text-center">Em Construção <i class="fa-solid fa-hammer"></i></h3>
				</div>
			</div>
		</section>
	</main>
	
	<script src="src/js/jquery.min.js"></script>
	<script src="src/js/bootstrap.bundle.min.js"></script>
	<script>
		$("#menuBtn").on("click", function() {
			$(".sidebar").toggleClass("toggled");
			$("main").toggleClass("sidebar-toggled");
		});
	</script>
</body>

</html>