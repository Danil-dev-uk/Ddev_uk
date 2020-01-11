	   <?php require "include/db_connect.php" ?>
		<?php
		$sql = $db->prepare("SELECT * FROM table_prducts WHERE product_id=".$_GET['id']);
		$sql->execute();
		$product = $sql->fetchAll();
		if(!($product)) {
			header('location: /index.php');
		}
		else {
			$sql = $db->prepare("SELECT * FROM table_prducts WHERE country_id=".$product[0]['country_id'] . " AND product_id != " . $product[0]['product_id'] . " LIMIT 4");
			$sql->execute();
			$similar = $sql->fetchAll();

			$sql = $db->prepare("SELECT * FROM products_image WHERE product_id=".$product[0]['product_id']);
			$sql->execute();
			$photos = $sql->fetchAll();
		}

		if( isset($_POST['name']) ) {
			setlocale(LC_ALL, 'Ukrainian');
			$today = date("Y-m-d H:i:s");
			$sql = $db->prepare("INSERT INTO customers VALUES (NULL,".$product[0]['product_id'].", '".$_POST['name']."','".$_POST['number']."','". $_POST['email']."','".$today."')");
			$result = $sql->execute();
			header("Location: /success.php");
		}
    	 ?>
		
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $product[0]['title']; ?></title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="owl/owl.carousel.min.css">
	<link rel="stylesheet" href="owl/owl.theme.default.min.css">
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
	                <a class="nav-link" href="catalog.php">Все туры</a>
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
		
		<div class="container-fluid color">
			<div class="owl-carousel">
				<?php foreach ($photos as $photo): ?>
				<div class="item" style="background-image: url(hotel/<?php echo $photo['pi_image']; ?>); background-size: cover; "></div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="container mt">
			<div class="row">
				
				<div class="col-6 txt">
					<h5><?php echo $product[0]['title']; ?></h5>
					<div class="row">
						<div class="col-5 mr sps">


							<p>Дата отправления : <span class="spc"> <br><?php echo (new DateTime($product[0]['date_vil']))->format('Y-m-d');?></span></p>


							<p>Ночей в туре : <span class="spc"><?php echo $product[0]['day_in']?></span></p>


							<p>Адрес отеля : <span class="spc"><?php echo $product[0]['adress_in']?></span></p>


							<p data-toggle="tooltip" data-placement="bottom" title="На одну персону"> <span class="spc">Цена :</span> <span class="pricespan"><?php echo $product[0]['price']?> UAH</span> </p>
							<div class="col-6 cnop">
					<a href="#" class="btn off buy">Оформить заказ</a>
					<a href="str_tov.php" class="btn teleg" data-toggle="tooltip" data-placement="bottom" title="Через Telegram">Связаться с нами</a>
				</div>

						</div>
						<div class="col-5 sps">


							<p>Чем добираться : <span class="spc"><?php echo $product[0]['aviaop']?></span></p>


							<p>Отель : <span class="spc"><?php echo $product[0]['hotel']?></span></p>


							<p>Доступ к океану : <span class="spc"><?php if($product[0]['ocean_in']==0) echo "Нет";else echo "Да";?>
							</span></p>

							
							<p>В наличии :  <span class="spc"><?php if($product[0]['nal']==0) echo "Нет";else echo "Да";?></span></p>

						</div>
					</div>
				</div>
				<div class="col-5 opis" data-toggle="tooltip" data-placement="top" title="Описание отеля">
					<p><?php echo $product[0]['opis']; ?></p>
				</div>
			</div>
			<div class="container may">
				<?php if($similar): ?>
				<h6>Возможно , вам это понравится :</h6>
				<div class="row">
					<?php foreach($similar as $row): ?>
					<div class="col-3">
	    				<div class="card">
	  						<img src="app_img/<?php echo $row['image'];?>" class="card-img-top" alt="...">
	  						<div class="card-body">
	    						<h5 class="card-title title_poh"><?php echo $row['hotel']; ?></h5>
	    						<p class="cena_poh"><?php echo $row['price']; ?></p>
		    					<a href="str_tov.php?id=<?php echo $row['product_id']?>"class=" poh justify-content-center">Узнать больше</a>	
	  						</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
			</div>





<div class="modal fade" id="cart">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form  id="buy" method="POST" action="">
					  <div class="form-group">
					    <label for="email">Email address</label>
					    <input required type="email" name="email" class="form-control" id="email" placeholder="mama@gmail.com">
					  </div>
					  <div class="form-group">
					  	<label for="name" >Ваше имя</label>
					   <input required type="name" name="name" class="form-control" id="name" placeholder="Антон....">
					  </div>
					  <div class="form-group">
					  	<label for="text" >Ваш номер</label>
					   <input required type="text" name="number" class="form-control" id="text" placeholder="+380...">
					  </div>


					 
					  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
		      </div>
		    </div>
		  </div>
	</div>



















	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/ss.js"></script>
    <script>
    	$(document).ready (function(){
    		$('[data-toggle=tooltip]').tooltip();

    	});
    	$('.buy').click(function(){
		$('#cart').modal();
		return false;
});
    </script>
</body>
</html>