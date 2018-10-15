<?php

/**
 * Function to query information based on 
 * a multiple user input parameters
 *
 */

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		unset($sql);
//FIRST NAME
		if ($_POST['selected_text_fna'] == "Equal") {
    			$sql[] = " first_name LIKE '%" . $_POST['fname'] . "%' ";
		}
		else if ($_POST['selected_text_fna'] == "Not Equal") {
    			$sql[] = " first_name NOT LIKE '%" . $_POST['fname'] . "%' ";
		}
		else if ($_POST['selected_text_fna'] == "Greater Than") {
    			$sql[] = " first_name > '" . $_POST['fname'] . "' ";
		}
		else if ($_POST['selected_text_fna'] == "Less Than") {
    			$sql[] = " first_name < '" . $_POST['fname'] . "' ";
		}
//LAST NAME
		if ($_POST['selected_text_lna'] == "Equal") {
    			$sql[] = " last_name LIKE '%" . $_POST['lname'] . "%' ";
		}
		else if ($_POST['selected_text_lna'] == "Not Equal") {
    			$sql[] = " last_name NOT LIKE '%" . $_POST['lname'] . "%' ";
		}
		else if ($_POST['selected_text_lna'] == "Greater Than") {
    			$sql[] = " last_name > '" . $_POST['lname'] . "' ";
		}
		else if ($_POST['selected_text_lna'] == "Less Than") {
    			$sql[] = " last_name < '" . $_POST['lname'] . "' ";
		}
//DOB
		if ($_POST['selected_text_dob'] == "Equal") {
    			$sql[] = " DOB LIKE '%" . $_POST['dob'] . "%' ";
		}
		else if ($_POST['selected_text_dob'] == "Not Equal") {
    			$sql[] = " DOB NOT LIKE '%" . $_POST['dob'] . "%' ";
		}
		else if ($_POST['selected_text_dob'] == "Greater Than") {
    			$sql[] = " DOB > '" . $_POST['dob'] . "' ";
		}
		else if ($_POST['selected_text_dob'] == "Less Than") {
    			$sql[] = " DOB < '" . $_POST['dob'] . "' ";
		}
//ADDRESS
		if ($_POST['selected_text_add'] == "Equal") {
    			$sql[] = " address LIKE '%" . $_POST['address'] . "%' ";
		}
		else if ($_POST['selected_text_add'] == "Not Equal") {
    			$sql[] = " address NOT LIKE '%" . $_POST['address'] . "%' ";
		}
		else if ($_POST['selected_text_add'] == "Greater Than") {
    			$sql[] = " address > '" . $_POST['address'] . "' ";
		}
		else if ($_POST['selected_text_add'] == "Less Than") {
    			$sql[] = " address < '" . $_POST['address'] . "' ";
		}
//CITY
		if ($_POST['selected_text_cit'] == "Equal") {
    			$sql[] = " city LIKE '%" . $_POST['city'] . "%' ";
		}
		else if ($_POST['selected_text_cit'] == "Not Equal") {
    			$sql[] = " city NOT LIKE '%" . $_POST['city'] . "%' ";
		}
		else if ($_POST['selected_text_cit'] == "Greater Than") {
    			$sql[] = " city > '" . $_POST['city'] . "' ";
		}
		else if ($_POST['selected_text_cit'] == "Less Than") {
    			$sql[] = " city < '" . $_POST['city'] . "' ";
		}
//COUNTY
		if ($_POST['selected_text_cou'] == "Equal") {
    			$sql[] = " county LIKE '%" . $_POST['county'] . "%' ";
		}
		else if ($_POST['selected_text_cou'] == "Not Equal") {
    			$sql[] = " county NOT LIKE '%" . $_POST['county'] . "%' ";
		}
		else if ($_POST['selected_text_cou'] == "Greater Than") {
    			$sql[] = " county > '" . $_POST['county'] . "' ";
		}
		else if ($_POST['selected_text_cou'] == "Less Than") {
    			$sql[] = " county < '" . $_POST['county'] . "' ";
		}
//STATE
		if ($_POST['selected_text_sta'] == "Equal") {
    			$sql[] = " state LIKE '%" . $_POST['state'] . "%' ";
		}
		else if ($_POST['selected_text_sta'] == "Not Equal") {
    			$sql[] = " state NOT LIKE '%" . $_POST['state'] . "%' ";
		}
		else if ($_POST['selected_text_sta'] == "Greater Than") {
    			$sql[] = " state > '" . $_POST['state'] . "' ";
		}
		else if ($_POST['selected_text_sta'] == "Less Than") {
    			$sql[] = " state < '" . $_POST['state'] . "' ";
		}
//ZIP
		if ($_POST['selected_text_zip'] == "Equal") {
    			$sql[] = " zip = '" . $_POST['zip'] . "' ";
		}
		else if ($_POST['selected_text_zip'] == "Not Equal") {
    			$sql[] = " zip != '" . $_POST['zip'] . "' ";
		}
		else if ($_POST['selected_text_zip'] == "Greater Than") {
    			$sql[] = " zip > '" . $_POST['zip'] . "' ";
		}
		else if ($_POST['selected_text_zip'] == "Less Than") {
    			$sql[] = " zip < '" . $_POST['zip'] . "' ";
		}

		$query = "SELECT * FROM names INNER JOIN data on data.ID = names.ID";

		if (!empty($sql)) {
    			$query .= ' WHERE ' . implode(' AND ', $sql);
		}

		echo $query;


		$statement = $connection->prepare($query);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>DOB</th>
					<th>ID</th>
					<th>Address</th>
					<th>City</th>
					<th>County</th>
					<th>State</th>
					<th>Zip</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["DOB"]); ?></td>
				<td><?php echo escape($row["ID"]); ?></td>
				<td><?php echo escape($row["address"]); ?></td>
				<td><?php echo escape($row["city"]); ?></td>
				<td><?php echo escape($row["county"]); ?></td>
				<td><?php echo escape($row["state"]); ?></td>
				<td><?php echo escape($row["zip"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found.</blockquote>
	<?php } 
} ?> 

<h2>Filter Results</h2>

<form method="post">

	<label for="fname">First Name</label>
	<select id="cmbFna" name="Fna"     onchange="document.getElementById('selected_text_fna').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_fna" id="selected_text_fna" value="" />
	<input type="text" id="fname" name="fname">

	<label for="lname">Last Name</label>
	<select id="cmbLna" name="Lna"     onchange="document.getElementById('selected_text_lna').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_lna" id="selected_text_lna" value="" />
	<input type="text" id="lname" name="lname">

	<label for="dob">DOB</label>
	<select id="cmbDob" name="Dob"     onchange="document.getElementById('selected_text_dob').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_dob" id="selected_text_dob" value="" />
	<input type="text" id="dob" name="dob">

	<label for="address">Address</label>
  	<select id="cmbAdd" name="Add"     onchange="document.getElementById('selected_text_add').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_add" id="selected_text_add" value="" />
	<input type="text" id="address" name="address">

	<label for="city">City</label>
	<select id="cmbCit" name="Cit"     onchange="document.getElementById('selected_text_cit').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_cit" id="selected_text_cit" value="" />
	<input type="text" id="city" name="city">

	<label for="county">County</label>
	<select id="cmbCou" name="Cou"     onchange="document.getElementById('selected_text_cou').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_cou" id="selected_text_cou" value="" />
	<input type="text" id="county" name="county">

	<label for="state">State</label>
	<select id="cmbSta" name="Sta"     onchange="document.getElementById('selected_text_sta').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_sta" id="selected_text_sta" value="" />
	<input type="text" id="state" name="state">

	<label for="zip">Zip</label>
	<select id="cmbZip" name="Zip"     onchange="document.getElementById('selected_text_zip').value=this.options[this.selectedIndex].text">
     	<option value="0">Select Operator</option>
     	<option value="1">Equal</option>
     	<option value="2">Not Equal</option>
     	<option value="3">Greater Than</option>
	<option value="4">Less Than</option>
	</select>
	<input type="hidden" name="selected_text_zip" id="selected_text_zip" value="" />
	<input type="number" id="zip" name="zip">	
	<input type="submit" name="submit" value="Search">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>