<?php

require 'proses/functions.php';

session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login/login.php");
	exit;
}

if (isset($_POST['add_to_cart'])) {

	$product_name = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$product_image = $_POST['product_image'];
	$product_quantity = 1;

	$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

	if (mysqli_num_rows($select_cart) > 0) {
		echo "<script>alert('Barang telah ada di keranjang');</script>";
	} else {
		$insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
		echo "<script>alert('Barang berhasil di tambahkan');</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		.sidedish .box-container {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
			gap: 1.5rem;
		}
		.sidedish .box-container .box {
			text-align: center;
			border: var(--border);
			padding: 2rem;
		}
		
		.sidedish .box-container .box .icons a {
			height: 5rem;
			width: 5rem;
			line-height: 5rem;
			font-size: 2rem;
			border: var(--border);
			color: #fff;
			margin: 0.3rem;
		}
		
		.sidedish .box-container .box .icons a:hover {
			background: var(--main-color);
		}
		
		.sidedish .box-container .box .image {
			padding: 2.5rem 0;
		}
		
		.sidedish .box-container .box .image img {
			height: 25rem;
		}
		
		.sidedish .box-container .box .content h3 {
			color: #fff;
			font-size: 2.5rem;
		}
		
		.sidedish .box-container .box .content .stars {
			padding: 1.5rem;
		}
		
		.sidedish .box-container .box .content .stars i {
			font-size: 1.7rem;
			color: var(--main-color);
		}
		
		.sidedish .box-container .box .content .price {
			color: #fff;
			font-size: 2.5rem;
		}
		
		.sidedish .box-container .box .content .price span {
			font-size: 1.5rem;
			text-decoration: line-through;
			font-weight: lighter;
		}

		.heading{
			text-align: center;
			color:#fff;
			text-transform: uppercase;
			padding-bottom: 3.5rem;
			font-size: 4rem;
			margin-top: 30px;
			margin-bottom: -30px;
		}

		.heading span{
			color:var(--main-color);
			text-transform: uppercase;
		}

		.sub-heading{
			text-align: center;
			color:#fff;
			text-transform: uppercase;
			padding-bottom: 1.5rem;
			font-size: 2.3rem;
		}

		.sub-heading span{
			color:var(--main-color);
			text-transform: uppercase;
		}
		
	</style>
	<title>Coffee Shop</title>

	<!-- font awesome cdn link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/style.css">
	
	<link rel="stylesheet" href="sidedish.css">

</head>

<body>

	<!-- header section starts  -->

	<header class="header">

		<a href="#" class="logo">
			<img src="images/logo.png" alt="">
		</a>

		<nav class="navbar">
			<a href="#home">home</a>
			<a href="#about">about</a>
			<a href="#menu">menu</a>
			<a href="#sidedish">sidedish</a>
			<a href="#review">review</a>
			<a href="#contact">contact</a>
			<a href="#blogs">blogs</a>
			<a href="login/logout.php">Log Out</a>
		</nav>

		<div class="icons">
			<div class="fas fa-search" id="search-btn"></div>
			<div class="fas fa-shopping-cart" id="cart-btn">
				<?php

				$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
				$row_count = mysqli_num_rows($select_rows);

				?>

				<a href="cart.php" class="cart_row">
					<span>
						<?php echo $row_count; ?>
					</span>
				</a>
			</div>
			<div class="fas fa-bars" id="menu-btn"></div>
			<div class="cart">

			</div>
		</div>

		<div class="search-form">
			<input type="search" id="search-box" placeholder="search here...">
			<label for="search-box" class="fas fa-search"></label>
		</div>
	</header>

	<!-- header section ends -->

	<!--home section starts-->
	<section class="home" id="home">
		<div class="content">
			<h3>Jadilah seperti secangkir kopi pagi ini</h3>
			<p>Meskipun sendiri, tetapi tetap memberi inspirasi serta ketenangan tiada henti.</p>
			<a href="#menu" class="btn">Pesan Sekarang!</a>
		</div>
	</section>
	<!--home section ends-->
	<!-- about section starts -->
	<section class="about" id="about">
		<h1 class="heading"><span>tentang</span> kita</h1>
		<div class="row">
			<div class="image">
				<img src="images/about-img.jpeg" alt="">
			</div>
			<div class="content">
				<h3>Apa yang membuat kopi kita spesial?</h3>
				<p>Selamat Datang di Perjalanan Rasa: Di sini, kami mengungkap rahasia cangkir kopi yang spesial. Bersama, kita akan menjelajahi aroma, cita rasa, dan cerita yang melahirkan kopi istimewa.</p>
				<p>Bersama kami, nikmati setiap cangkir kopi yang membawa Anda berkeliling dunia dalam setiap tegukan. Selamat menikmati perjalanan rasa unik!</p>
				<a href="#menu" class="btn">Sampai Jumpa</a>
			</div>
		</div>
	</section>
	<!-- about section ends -->
	<!--  menu section starts -->
	<section class="menu" id="menu">
		<h1 class="heading"><span>Kopi</span> Mantap</h1>

		<form action="" method="post" class="search-form">
			<input type="text" name="searchTerm" placeholder="Cari menu...">
			<input type="submit" name="search" value="Cari">
		</form>

		<div class="box-container">
			<?php
			if (isset($_POST['search'])) {
				$searchTerm = $_POST['searchTerm'];

				// Lakukan pencarian
				$select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE `name` LIKE '%$searchTerm%'");
			} else {
				// Tampilkan semua produk jika tidak ada pencarian
				$select_products = mysqli_query($conn, "SELECT * FROM `products`");
			}

			if (mysqli_num_rows($select_products) > 0) {
				while ($fetch_product = mysqli_fetch_assoc($select_products)) {
			?>

					<form action="" method="post">
						<div class="box">
							<img src="images/<?php echo $fetch_product['image']; ?>" alt="">
							<h3><?php echo $fetch_product['name']; ?></h3>
							<div class="price">Rp<?php echo $fetch_product['price']; ?>/-</div>
							<input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
							<input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
							<input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
							<input type="submit" class="btn" value="add to cart" name="add_to_cart">
						</div>
					</form>

			<?php
				}
			} else {
				echo "<script>alert('Menu tidak tersedia'); window.location.href='index.php';</script>";
			}
			?>
		</div>
	</section>
	<!--  menu section ends -->
	<!-- Sidedish section starts -->
	<h1 class="heading">Side <span> Dish </span></h1>
	<section class="sidedish" id="sidedish">
		<h2 class="sub-heading">Kopi <span> Bubuk </span></h2>
		<div class="box-container">
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/product-1.png" alt="">
				</div>
				<div class="content">
					<h3>Nicaraguan Coffee</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 73.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/product-2.png" alt="">
				</div>
				<div class="content">
					<h3>Colombian Coffee</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 60.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/product-3.png" alt="">
				</div>
				<div class="content">
					<h3>Peru Coffee</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 66.00</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sidedish" id="sidedish">
		<h2 class="sub-heading">Bre<span>ad</span></h2>
		<div class="box-container">
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/bread-1.jpg" alt="">
				</div>
				<div class="content">
					<h3>Choux Paste</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 45.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/bread-2.png" alt="">
				</div>
				<div class="content">
					<h3>Dombolone</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 38.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/bread-3.jpg" alt="">
				</div>
				<div class="content">
					<h3>Choco Lava</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 43.00</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sidedish" id="sidedish">
		<h2 class="sub-heading">Ice <span>Cream</span></h2>
		<div class="box-container">
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/icecream-1.jpg" alt="">
				</div>
				<div class="content">
					<h3>Diamond Delights</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 50.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/icecream-2.jpg" alt="">
				</div>
				<div class="content">
					<h3>Château Chocolat</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 32.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/icecream-3.jpg" alt="">
				</div>
				<div class="content">
					<h3>Luxe Scoops</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 40.00</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sidedish" id="sidedish">
		<h2 class="sub-heading">cock<span>tail</span></h2>
		<div class="box-container">
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/cocktail-1.jpg" alt="">
				</div>
				<div class="content">
					<h3>Aristocrat's Libation</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 795.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/cocktail-2.jpg" alt="">
				</div>
				<div class="content">
					<h3>Crystal Chalice</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 635.000</div>
				</div>
			</div>
			<div class="box">
				<div class="icons">
					<a href="#" class="fas fa-shopping-cart"></a>
					<a href="#" class="fas fa-heart"></a>
					<a href="#" class="fas fa-eye"></a>
				</div>
				<div class="image">
					<img src="images/cocktail-3.jpg" alt="">
				</div>
				<div class="content">
					<h3>Royal Elixir</h3>
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
					</div>
					<div class="price">Rp 665.000</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Sidedish section ends -->
	<!-- review section starts -->
	<section class="review" id="review">
		<h1 class="heading"><span> Review </span> Pembeli</h1>
		<div class="box-container">
			<div class="box">
				<img src="images/quote-img.png" alt="" class="quote">
				<p>"Rasa kopi mereka benar-benar menggetarkan selera Anda. Saya tak pernah menemukan yang lebih enak!"</p>
				<img src="images/pic-1.png" class="user" alt="">
				<h3>Daidalos Arnold</h3>
				<div class="stars">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star-half-alt"></i>
				</div>

			</div>
			<div class="box">
				<img src="images/quote-img.png" alt="" class="quote">
				<p>"Ketika datang ke kopi berkualitas, toko ini adalah pilihan nomor satu saya. Aroma dan rasa yang tidak terkalahkan!"</p>
				<img src="images/pic-2.png" class="user" alt="">
				<h3>Adelina Marlen</h3>
				<div class="stars">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star-half-alt"></i>
				</div>

			</div>
			<div class="box">
				<img src="images/quote-img.png" alt="" class="quote">
				<p>"Setiap tegukan kopi di sini adalah petualangan rasa yang luar biasa, tak ada yang seperti ini!"</p>
				<img src="images/pic-3.png" class="user" alt="">
				<h3>Lambert Ronald</h3>
				<div class="stars">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star-half-alt"></i>
				</div>

			</div>
		</div>
	</section>
	<!-- review section ends -->

	<!-- contact section srarts -->
	<section class="contact" id="contact">
		<h1 class="heading">Kontak <span> Kita</span></h1>
		<div class="row">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d415.91962347700354!2d112.77212593498646!3d-7.363244925399715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMjEnNDYuNiJTIDExMsKwNDYnMTkuNiJF!5e0!3m2!1sen!2sid!4v1683110904349!5m2!1sen!2sid" allowfullscreen="" loading="lazy" frameborder="0"></iframe>
			<form action="">
				<h3>Jangan lupa untuk kembali</h3>
				<div class="inputBox">
					<span class="fas fa-user"></span>
					<input type="text" placeholder="Nama">
				</div>
				<div class="inputBox">
					<span class="fas fa-envelope"></span>
					<input type="email" placeholder="Email">
				</div>
				<div class="inputBox">
					<span class="fas fa-phone"></span>
					<input type="number" placeholder="Nomer">
				</div>
				<input type="submit" value="Kontak Sekarang" class="btn">
			</form>

		</div>
		</div>
	</section>
	<!-- contact section sends -->

	<!-- blog section starts -->
	<section class="blogs" id="blogs">

		<h1 class="heading"> <span> Blog </span> Kita </h1>

		<div class="box-container">
			<div class="box">
				<div class="image">
					<img src="images/blog-1.jpeg" alt="">
				</div>
				<div class="content">
					<a href="#" class="title">tasty and refreshing coffee</a>
					<span>by Dusk / 3rd May, 2023</span>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
					<a href="#" class="btn">read more</a>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<img src="images/blog-2.jpeg" alt="">
				</div>
				<div class="content">
					<a href="#" class="title">tasty and refreshing coffee</a>
					<span>by Ishak / 29th April, 2023</span>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
					<a href="#" class="btn">read more</a>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<img src="images/blog-3.jpeg" alt="">
				</div>
				<div class="content">
					<a href="#" class="title">tasty and refreshing coffee</a>
					<span>by Zen / 3rd May, 2023</span>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
					<a href="#" class="btn">read more</a>
				</div>
			</div>
		</div>

	</section>
	<!-- blog section ends -->

	<!-- footer section starts -->

	<section class="footer">

		<div class="share">
			<a href="#" class="fab fa-facebook-f"></a>
			<a href="#" class="fab fa-twitter"></a>
			<a href="#" class="fab fa-instagram"></a>
			<a href="#" class="fab fa-linkedin"></a>
			<a href="#" class="fab fa-pinterest"></a>
		</div>

		<div class="links">
			<a href="#">home</a>
			<a href="#">about</a>
			<a href="#">menu</a>
			<a href="#">sidedish</a>
			<a href="#">review</a>
			<a href="#">contact</a>
			<a href="#">blogs</a>
		</div>
	</section>
	<!-- footer section ends -->

</body>

</html>

<!-- sampah -->