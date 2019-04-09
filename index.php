<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">

		<meta name="viewport" content="width=1280">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="theme-color" content="#fff">

		<title>Главная</title>

		<link rel="stylesheet" href="app/css/appUI.css">
		<link rel="stylesheet" href="app/css/app.css">
		<link rel="stylesheet" href="app/css/responsive.css">

		<link rel="shortcut icon" href="img/ico/favicon.ico">
	</head>
	<body>
		<?php include 'lib/class.graph.php';?>

		<form action="/" method="get" class="aboutForm mainPage">
			<header class="formHeader">
				<h2 class="formTitle">Создать граф</h2>
			</header>
			<div class="formBody">
				<div class="row">
					<div class="col col12">
						<div class="formGroup">
							<input type="number" min="1" class="field" placeholder="Имя" name="count" value="<?=!empty($_GET['count']) ? $_GET['count'] : '1';?>">
						</div>
					</div>
				</div>
			</div>
			<footer class="formFooter">
				<input type="submit" class="but butDefault butMd" value="Создать">
			</footer>
		</form>
<?php if (!empty($_GET['count'])) {
	$graph = new Graph($_GET['count']);
	if ($graph) {
		$graph->сreateOptions();
		?>

		<main class="main">

			<section id="tree" class="tabs tree">

				<div id="treeDescription" class="treeDescription"></div>

				<div class="treeBoxBody">
					<?include 'include/official/graph.php';?>
				</div>
			</section>

		</main>
	<?php } else {
		echo 'Не могу создать граф';
	}
}
?>
		<!-- Основа -->


		<?
// Подвал
include_once 'include/footer.php';
?>

		<script src="app/js/lib/jquery-2.2.4.min.js"></script>

		<script src="app/js/lib/svg/svg.min.js"></script>
		<script src="app/js/lib/svg/svg.path.js"></script>

		<script src="app/js/plugins/bootstrap.min.js"></script>
		<script src="app/js/plugins/jquery.maskedinput.min.js"></script>

		<script src="app/js/app.js"></script>
		<script src="http://rawgit.com/EightMedia/hammer.js/1.1.3/hammer.js"></script>
		<script src="app/js/сommunicationTree.js"></script>
		<script src="app/js/main.js"></script>
	</body>
</html>
