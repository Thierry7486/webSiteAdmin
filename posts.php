<?php
require("./inc/library.php");
// La connexion à ma db
try {
	$db = new PDO('mysql:host=localhost;dbname=CMSPhp', 'root', 'root');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Oups PDO error: " . $e->getMessage();
}

$page = (isset($_GET['page']) && $_GET['page'] != 0) ? ($_GET['page'] - 1) : 0;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 2;
$search = isset($_GET['search']) ? "WHERE title LIKE '%" . $_GET['search'] . "%' OR text LIKE '%" . $_GET['search'] . "%'" : "";
// L'affichage de ma table le R ;)



$query = "SELECT * FROM posts $search ORDER BY `id` ASC LIMIT " . ($page * $limit) . ", $limit";
$serv = $db->prepare($query);
$serv->execute();
$result = $serv->fetchAll(PDO::FETCH_ASSOC);
// print_r_pre($result);

//$nb_articles = $db->query("SELECT COUNT (id) FROM posts")->fetch();
$sql = "SELECT COUNT(id) FROM posts $search";
$res = $db->query($sql);
$nb_articles = $res->fetchColumn();
$nb_pages = ceil($nb_articles/$limit);


?>

<!doctype html>
<html lang="en">

<head>
	<?php include("./parts/head.php") ?>
	<title>Welcome to the posts !</title>
</head>

<body>
	<!-- NavBar -->
	<?php include("./parts/navbar.php") ?>
	<!-- End NavBar -->
	<div class="container">
		<div class="row mt-3">
			<form class="d-flex col-6 col-md-4">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
				<button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
			</form>
		</div>
		<h2 class="mt-3 text-center text-info">Here is my Listing</h2>
		<div class="row row-carte justify-content-center">


			<?php
			foreach ($result as $k => $v) {
			?>
				<div class="card carte align-items-center text-center col-3 mx-3 my-3">

					<img src="./images/<?= (!empty($v['image'])) ? $v['image'] : "default.jpg" ?>" class="card-img-top w-75 my-2" />

					<h5 class="card-title"><?= (!empty($v['title'])) ? $v['title'] : "Sans titre" ?></h5>
					<p class="card-text description"><?= (!empty($v['text'])) ? $v['text'] : "Pas de description" ?></p>
					<a href="#" class="btn btn-primary mb-2">Read article</a>
				</div>
			<?php
			}
			?>
		</div>
		<nav aria-label="Page navigation example mt-3">
			<ul class="pagination justify-content-center mt-3">
				<?php if (isset($_GET['page']) && $page > 0) { ?>
					<li class="page-item">
						<a class="page-link" href="listing.php?page=<?= $page ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
				<?php }
				if (isset($_GET['page']) && $page > 1) {
				?>
					<li class="page-item"><a class="page-link" href="listing.php?page=<?= $page - 1 ?>">Page <?= $page - 1 ?></a></li>
				<?php }
				if (isset($_GET['page']) && $page > 0) {
				?>
					<li class="page-item"><a class="page-link" href="listing.php?page=<?= $page  ?>">Page <?= $page ?></a></li>
				<?php } ?>
				<li class="page-item active"><a href="#" class="btn btn-primary">Page <?= $page + 1 ?></a></li>
				<?php if (isset($page) && ($page < ($nb_articles / $limit) - 1)) { ?>
					<li class="page-item"><a class="page-link" href="listing.php?page=<?= $page + 2 ?>">Page <?= $page + 2 ?></a></li>
				<?php }
				if (isset($page) && ($page < ($nb_articles / $limit) - 2)) { ?>
					<li class="page-item"><a class="page-link" href="listing.php?page=<?= $page + 3 ?>">Page <?= $page + 3 ?></a></li>
				<?php }
				if (isset($page) && ($page < ($nb_articles / $limit) - 1)) { ?>
					<li class="page-item">
						<a class="page-link" href="listing.php?page=<?= $page + 2 ?>" aria-label="Previous">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</nav>


	</div>
	<!-- Footer -->
	<?php include("./parts/footer.php") ?>
	<!-- End Footer -->

</body>

</html>