<?php
require_once 'menu.php';
require_once "classes/account.class.php";
 ?>
<div class="c_container">
    <?php include 'inc/error.php'; ?>
    <button type="button" class="btn-add btn" name="button">Gebruiker aanmaken</button>
    <table class="user-table" method="get">
        <tr>
            <th>Id</th>
            <th>Bedrijfs id</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>
        <?php
            $key = $_SESSION['key'];
            $r = Account::getUsers($key);

            $search_results = json_decode($r, true);
            if ($search_results === NULL) die('Error parsing json');
            $results = $search_results["data"];

            if (empty($results) ) {
              $message = "Er zijn geen gebruiker gevonden voor u bedrijf.";
              //Dump your POST variables
              $_SESSION['msg'] = $message;
              exit();
            } else {
              foreach ($results as $data) {
                  $id = $data["id"];
                  $c_id = $_SESSION['companyId'];
                  $name = $data["name"];
                  $email = $data["email"];
                  echo "<tr>";
                      echo '<td>'.$id.'</td>';
                      echo '<td>'.$c_id.'</th>';
                      echo '<td>'.$name.'</td>';
                      echo '<td>'.$email.'</td>';
                      echo "<td>";
                          echo '<button class="btn btn-edit" type="submit" name="edit" value="'.$id.'" >Bewerken</button>';
                      echo "</td>";
                      echo "<td>";
                          echo '<button class="btn btn-del" type="submit" name="id" value="'.$id.'" >Verwijderen</button>';
                      echo "</td>";
                  echo "</tr>";
              }
            }
        ?>
    </table>
    <button type="button" class="btn-add btn" name="button">Gebruiker aanmaken</button>
</div>

<div class="add-modal">
  <header>Aanmaken</header>
  <div class="content">
    <form action="createemployee.php" method="post" enctype="multipart/form-data">
      <div class='field'>
          <label for="username">Gebruikers naam<span class="required">*</span></label>
          <input required name="b_name" type='text' id="username" />
      </div>
      <div class='field'>
          <label for="email">Email Address<span class="required">*</span></label>
          <input required name="b_email" type='email' />
      </div>
      <div class='field'>
          <label for="password">Wachtwoord<span class="required">*</span></label>
          <input required name="b_password" type='password' />
      </div>
      <div class='field'>
          <label for="password">Herhaal wachtwoord<span class="required">*</span></label>
          <input required name="b_repeat_password" type='password' />
      </div>
      <div class='field'>
        <input type='submit' name="createframe" class='btn btn-primary' value="Aanmaken" />
      </div>
    </form>
  </div>
</div>

<div class='del-modal'>
    <header>Verwijderen</header>
    <div class='content'>
        <form action="deleteuser.php" method="POST">
            <p>Weet u zeker dat u dit account wil verwijderen.</p>

            <input class="in-awnser" name="idtodel" type="hidden" value="">

            <button class="btn btn-primary" type="submit" name="delno" >Annuleer</button>

            <button class="btn btn-danger " type="submit" name="delyes" >Verwijder</button>


        </form>

    </div>
</div>
<div class='edit-modal'>
    <header>Bijwerking</header>
    <div class='content'>
        <form action="edituser.php" method="POST">

            <input class="in-awnser" name="idtoedit" type="hidden" value="">
            <div class='field'>
				<label for="username">Gebruikers naam<span class="required">*</span></label>
				<input required name="b_edit_name" type='text' id="username" />
			</div>
			<div class='field'>
				<label for="email">Email Address<span class="required">*</span></label>
				<input required name="b_edit_email" type='email' />
			</div>
			<div class='field'>
				<label for="password">Wachtwoord<span class="required">*</span></label>
				<input required name="b_edit_password" type='password' />
			</div>
			<div class='field'>
				<label for="password">Herhaal wachtwoord<span class="required">*</span></label>
				<input required name="b_edit_repeat_password" type='password' />
			</div>
            <div class='field'>
				<input name="b_edit_submit" type='submit' class='btn btn-edit' value="Bijwerken" />
			</div>
            <p>Velden met een <span class="required">*</span> zijn verplicht.</p>
        </form>

    </div>
</div>
