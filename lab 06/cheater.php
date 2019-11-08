<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
			if (empty($_POST['Name']) or empty($_POST['ID'])
			or empty($_POST['course']) or empty($_POST['cardnumber'])
			or empty($_POST['cc'])){
				
		?>

		<!-- Ex 4 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (preg_match("^[a-zA-Z]+((?:\\s|-)?[a-zA-Z]*)*$^", $_POST['Name']) == FALSE) { 
		?>

		<!-- Ex 5 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (!preg_match("^[0-9]{16}^", $_POST['cardnumber'])
		or ($_POST['cc'] == "visa" and !preg_match("^4[0-9]{15}^", $_POST['cardnumber']))
		or ($_POST['cc'] == "mastercard" and !preg_match("^5[0-9]{15}^", $_POST['cardnumber']))) {
			
		?>
<!-- 
		Ex 5 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		 

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?php 
			$name = $_POST["Name"];
			$id = $_POST["ID"];
			$course = $_POST["course"];
			$grade = $_POST["grade"];
			$cardnumber = $_POST["cardnumber"];
			$cc = $_POST["cc"];
		?>

		<ul> 
			<li>Name: <?= $name ?></li>
			<li>ID: <?= $id ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?php processCheckbox($course); ?></li>
			<li>Grade: <?= $grade ?></li>
			<li>Credit: <?= "$cardnumber ($cc)" ?></li>
		</ul>
		
		<!-- Ex 3 :  -->
			<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			$fileputstring = "$name;$id;$cardnumber;$cc";
			file_put_contents($filename, $fileputstring);
			$filegetstring = file_get_contents($filename);
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
				<?php print "$filegetstring"; ?>
		
		<?php
		 }
		?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				print implode(", ", $names);
			}
		?>
		
	</body>
</html>
