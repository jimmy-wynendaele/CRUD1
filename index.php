<?php 

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=colyseum', 'root', 'root');
		//foreach($bdd->query('SELECT * from clients') as $row) {
		//print_r($row);


	}
	 catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>colyseum</title>
	<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<table class="animated fadeInRightBig">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Type of show</th>
				</tr>
				
				
				<?php

					$spec = 'SELECT *, genre FROM clients JOIN genres g ON g.id=clients.id LIMIT 0,20';
					$req = $bdd->query($spec);
					while ($fetch = $req->fetch()){

				?>

				<tr>
					<td>
					<?php
						echo $fetch['firstName'];
					?>
					</td>
					<td>
					<?php
						echo $fetch['lastName'];
					?>
					</td>
					<td>
					<?php
						echo $fetch['genre'];
					?>
					</td>
				</tr>
					
			<?php

		}


	 ?>

	</table>

	<table class="animated fadeInLeftBig">
		
		<tr>
				<th>Client's firstname with id-card</th>
				<th>Client's lastname with id-card</th>
		</tr>

		<?php 

			$spec2 = "SELECT lastName, firstName FROM clients WHERE card='1'";
			$req2 = $bdd->query($spec2);
			while($fetch2 = $req2->fetch()){
		?>
				<tr>
					<td><?php echo $fetch2['firstName'] ?></td>
					<td><?php echo $fetch2['lastName'] ?></td>
				</tr>

		<?php
			}



		 ?>

	</table>

	<table class="animated fadeInRightBig">
		
		<tr>
				<th>Client's firstname,lastname starts with 'm'</th>
				<th>Client's lastname,lastname starts with 'm'</th>
		</tr>

		<?php 

			$spec3 = "SELECT lastName, firstName FROM clients WHERE lastName LIKE 'M%' OR firstName LIKE 'P%' ORDER BY lastName";
			$req3 = $bdd->query($spec3);
			while($fetch3 = $req3->fetch()){
		?>
				<tr>
					<td><?php echo $fetch3['firstName'] ?></td>
					<td><?php echo $fetch3['lastName'] ?></td>
				</tr>

		<?php
			}



		 ?>

	</table>

	<section class="clients">
		
		<?php 

			$spec4 = 'SELECT lastName,firstName,birthDate,card,cardNumber FROM clients';
			$req4 = $bdd->query($spec4);

			function cardCheck($clientCard){
					if($clientCard==0){
						return  'no card';
					}else{
						return  'has a card';
					}
			}

			function numberCheck($clientCard,$number){

					if($clientCard==0){
						return  'no card';
					}else{
						return  $number;
					}
			}


			while($fetch4 = $req4->fetch()){

			?>

			<div class="clientInfo">
				<?php
					echo "firstname: " . $fetch4['firstName'] . "<br>";
					echo "lastname: " . $fetch4['lastName'] . "<br>";
					echo "birthdate: " . $fetch4['birthDate'] . "<br>";
					echo "fidelity card: " . cardCheck($fetch4['card']) . "<br>";
					echo "card number: " . numberCheck($fetch4['card'],$fetch4['cardNumber']) . "<br>";
				?>
			</div>

		<?php

			}	
		 ?>




	</section>
</body>
</html>
	