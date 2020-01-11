
 	<?php require "include/db_connect.php" ?>

	<?php 
		$sql = $db->prepare("SELECT * FROM countries");
		$sql->execute();
		$countries = $sql->fetchAll();
		 ?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Все туры</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/mn.css">
</head>
<body>
	<div class="container-fluid navsb">
        <div class="container">
            <ul class="nav justify-content-center">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Все туры</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Наши контакты</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Обратная связь</a>
              </li>
            </ul>
        </div>
    </div>
    <div class="container ">
	    <form action="" method="POST">
	   		<button name="sort" value="all" class="bubbly-button">Все</button>
		<?php foreach ($countries as $country) : ?>
	    	<button name="sort" value="<?php echo $country['country_id']; ?>" class="bubbly-button"> <?php echo $country['country_name'];  ?></button>
		<?php endforeach; ?>
		</form>
	</div>

 <section class="products">
    	<div class="container">
    		<div class="row">
 
		<?php
		if(!isset($_POST['sort']) || $_POST['sort'] == 'all') {
			$sql = " SELECT * FROM 	table_prducts";
		}else {
			$sql = " SELECT * FROM 	table_prducts WHERE country_id = " . $_POST['sort'];
		}
		$sql = $db->prepare($sql);
		$sql->execute();
		$products = $sql->fetchAll();
		if(!$products) {
			echo "<p class='sorry'> Извините , путёвок временно нет ... </p>";
		}else 
			Foreach ($products as $row):
    	 ?>
    			




				<div class="col-12 col-md-6 mt-5">
    				<div class="card">
  						<img src="app_img/<?php echo $row['image'];?>" class="card-img-top" alt="...">
  						<div class="card-body justify-content-center">
    						<h5 class="card-title"><?php  echo $row['title']; ?></h5>
    						<div class="row">
    							<p class="col-6">Дата вылета : <?php echo $row['date_vil'] ?></p>
    							
    							<p class="col-6">Дней в туре : <?php echo $row['day_in'] ?></p>
    							
    						</div>
    						<p class="card-text mt-2"><?php  echo $row['sopis']; ?></p>
    						<p class="cena"><?php echo $row['price']; ?><span> UAH</span></p>
	    					<a href="str_tov.php?id=<?php echo $row['product_id']?>"class="btn">Узнать больше</a>	
  						</div>
					</div>
				</div>
				<?php endforeach; ?>





			</div>
		</div>
	</section>
    
    














    	









































   




     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/ss.js"></script>
</body>
</html>