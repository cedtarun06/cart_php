<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	
</head>
<body>
	<!-- <div id="header">
		<h1 id="logo">Logo</h1>
		<nav>
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div> -->
	
	<div id="main">
<?php
		
		include 'config.php';
		function display($products){
			foreach($products as $key => $values) {
					echo'<div id="product-'.$values['id'].'" class="product">
							<img src="images/'.$values['image'].'">
							<h3 class="title"><a href="#">'.$values['name'].'</a></h3>
							<span>Price: '.$values['price'].'</span>
							<a class="add-to-cart" href="?id='.$values['id'].'">Add To Cart</a>
						</div>';
			}
		}
		display($products);

		// this is used to check th ID 
		 if($_GET['id'] != 0){
        addProductTosession($products,$_GET['id']);
		
    }

    //Add product in the session
    function addProductTosession(&$products,$prId){
        foreach($products as $key => $values){
            if($prId == $values['id'] && !checkInSession($prId)){
                $_SESSION[$values['name']]=$values;
                break;
            }
        }
    }
    print_r($_SESSION);
    //This function is used to check if product is already in the session.
    function checkInSession($prId){
        foreach($_SESSION as $key => $values){
            if($prId==$values['id']){
                return true;
                break;
            }
        }
        return false;
    }

    //function to display the cart table
    function displayCart(){
        echo'<table id="productTable">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>';

        foreach($_SESSION as $key => $values){
            echo'<tr>
                    <td><img src="images/'.$values['image'].'"</td>
                    <td>'.$values['id'].'</td>
                    <td>'.$values['name'].'</td>
                    <td>'.$values['price'].'</td>
                    <td><input class="qty-field" type="number" value="1"><a class="quantity" > Update </a></a></td>
                    <td><a class="quantity" href="?remPrId='.$values['id'].'"> X </a></td>
                </t>';
        }
        echo '</table>';
        echo'<button type="submit">Clear Cart</button>';
    }

    if($_GET['remPrId'] != 0){
        removeProductFromCart($_GET['remPrId']);
    }

    //function to remove the product from cart
    function removeProductFromCart($removePrpductId){
        foreach($_SESSION as $key => $values){
            if($removePrpductId == $values['id']){
                unset($_SESSION[$key]);
                break;
            }
        }
    }
    //clear cart
    // function clearCart(){

    // }
    //update product quantity in the cart
    function updateCart($listToUpdate){
		$list = isset($_SESSION['lists'])?$_SESSION['lists']:array['products'];
		if(sizeof($lists)){
			foreach($lists as $key=>$list){
				if($list['id'] == $listToUpdate['id']){
					$lists[$key]['text'] = $listToUpdate['text'];
					$_SESSION['lists'] = $lists;
					return $list;
				}
			}	
		}	
	}
?>
		// <!-- <div id="products">
		// 	<div id="product-101" class="product">
		// 		<img src="images/football.png">
		// 		<h3 class="title"><a href="#">Product 101</a></h3>
		// 		<span>Price: $150.00</span>
		// 		<a class="add-to-cart" href="#">Add To Cart</a>
		// 	</div>
		// 	<div id="product-101" class="product">
		// 		<img src="images/tennis.png">
		// 		<h3 class="title"><a href="#">Product 102</a></h3>
		// 		<span>Price: $120.00</span>
		// 		<a class="add-to-cart" href="#">Add To Cart</a>
		// 	</div>
		// 	<div id="product-101" class="product">
		// 		<img src="images/basketball.png">
		// 		<h3 class="title"><a href="#">Product 103</a></h3>
		// 		<span>Price: $90.00</span>
		// 		<a class="add-to-cart" href="#">Add To Cart</a>
		// 	</div>
		// 	<div id="product-101" class="product">
		// 		<img src="images/table-tennis.png">
		// 		<h3 class="title"><a href="#">Product 104</a></h3>
		// 		<span>Price: $110.00</span>
		// 		<a class="add-to-cart" href="#">Add To Cart</a>
		// 	</div>
		// 	<div id="product-101" class="product">
		// 		<img src="images/soccer.png">
		// 		<h3 class="title"><a href="#">Product 105</a></h3>
		// 		<span>Price: $80.00</span>
		// 		<a class="add-to-cart" href="#">Add To Cart</a>
		// 	</div>
		// </div> -->
		
	</div>
	<!-- <div id="footer">
		<nav>
			<ul id="footer-links">
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Declaimers</a></li>
			</ul>
		</nav>
	</div> -->
	<?php
include 'footer.php';
?>
</body>
</html>