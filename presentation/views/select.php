<?php
    require_once "classes/presentation.class.php";
		session_start();
?>
<div class="container">
		<div class="selected-item">
			<p>Select Presentation :</p>
		</div>

		<select name="" id="cusSelectbox">
			<option value="Select">Select</option>
			<?php
					$key = $_SESSION['key'];
					$r = Presentation::getPresentations($key);

					$search_results = json_decode($r, true);
					if ($search_results === NULL) die('Error parsing json');
					//print_r($search_results);

					foreach ($search_results as $data) {
						$name = $data["name"];
						$id = $data["id"];
						echo '<option value="'.$id.'">'.$name.'</option>';
					}

			?>
		</select>


	</div>