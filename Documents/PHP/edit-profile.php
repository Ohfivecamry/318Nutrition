<!-- ##################################################################################
#Script Name: Edit profile
#Description: User can update profile settings
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
ob_start();
session_start();
require_once "../../Database/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
?>

<?php

// Declaring Variables
$firstname = $lastname = $phone = $employee = $email = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

$id = $_SESSION["ACC_ID"];

$result = $link->query("SELECT * FROM `Accounts` WHERE ACC_ID ='$id'");

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <link rel="script" href="../JS/button-script.js">
  <link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Edit Profile</title>
</head>
<body>
<nav class="navbar">
    <div onclick="location.href='../../Documents/PHP/index.php';" style="cursor: pointer;" class="brand-title">318 Nutrition</div>
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="../../Documents/PHP/index.php">HOME</a></li>
        <li><a href="../PHP/about.php">ABOUT 318</a></li>
      <div class="dropdown">
        <li><a class="dropbtn" href="../../Documents/PHP/programs.php">PROGRAMS</a></li>
        <div class="dropdown-content">
      <!--<a href="#">Monthly Packages</a>-->
      <!--<a href="# ">Couples Nutrition</a>-->
      <!--<a href="#">Adolescent Nutrition</a>-->
      <!--<a href="#">Workshops/Seminars</a>-->
    </div>
    </div>
        <li><a href="../PHP/macro-calculator.php">MACRO CALCULATOR</a></li>
<?php
        if(isset($_SESSION["loggedin"]) == true)  
        {
          echo '<div class="dropdown">
                <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
                <div class="dropdown-content">
                <a href="../PHP/account-sign-out.php">Log Out</a>
                </div>
                </div>';
        }
        else 
        {
         echo '<li><a href="../PHP/admin-panel.php">MY PLAN</a></li>';
        }
?> 
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>   
      </ul>
    </div>
  </nav>


				<?php while ($row = $result->fetch_assoc()):?>

				<?php
				$employee = $row['Employee'];
				$firstname = $row['FName'];
				$lastname = $row['LName'];
				$phone = $row['Phone'];
				$email = $row['Email'];
        $plan = $row["NutritionPlan"];
				$_SESSION["temp"] = $row['ACC_ID'];
			
			endwhile; ?>

<?php
  if($_SESSION["Employee"] == 1)
  {
    echo '<div class="second-navbar">';
    echo '<div class="second-navbar-links">';
    echo '<ul>';
    echo '<li><a href="../PHP/login.php"><span class="fa fa-arrow-left" aria-hidden="true"><p>BACK</p></a></li>';
    echo '<li><a href="../../Documents/PHP/view-accounts.php"><span class="fa fa-users" aria-hidden="true"><p>VIEW ACCOUNTS</p></a></li>';
    echo '<li><a href="../PHP/view-journals.php"><span class="fa fa-book" aria-hidden="true"><p>VIEW JOURNALS</p></a></li>';
    echo '<li><a href="../../Documents/PHP/create-account.php"><span class="fa fa-user-plus" aria-hidden="true"><p>NEW ACCOUNTS</p></a></li>';
    echo '<li><a href="../../Documents/PHP/edit-profile.php"><span class="fa fa-user-edit" aria-hidden="true"><p>EDIT PROFILE</p></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
  }
  else
  {
    echo '<div class="second-navbar">';
    echo '<div class="second-navbar-links">';
    echo '<ul>';
    echo '<li><a href="../PHP/user-panel.php"><span class="fa fa-arrow-left" aria-hidden="true"><p>BACK</p></a></li>';
    echo '<li><a href="../../Documents/PHP/new-journal.php"><span class="fa fa-calendar-plus" aria-hidden="true"><p>NEW ENTRY</p></a></li>';
    echo '<li><a href="../PHP/view-journals.php"><span class="fa fa-book" aria-hidden="true"><p>VIEW JOURNALS</p></a></li>';
    echo '<li><a href="../../Documents/PHP/edit-profile.php"><span class="fa fa-user-edit" aria-hidden="true"><p>EDIT PROFILE</p></a></li>';
    echo '<li><a href="../../ProgramPlan/';
    echo $plan;
    echo '"><span class="fa fa-file-pdf" aria-hidden="true"><p>VIEW PLAN</p></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';

  }
  ?>
			</table>
			<div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="FName" class="form-control" placeholder="Not filled by user"<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="LName" class="form-control" placeholder="Not filled by user"<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
                <label>Phone #</label>
                <input type="tel" name="Phone" class="form-control" placeholder="Not filled by user" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="Email" placeholder="Not filled by user" class="form-control"  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <br>          
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Change">
                <input type="reset" class="btn btn-primary ml-2" value="Revert">
								<a href="../PHP/reset-password.php" class="btn btn-primary">Change Password</a>
            </div>
        </form>
				</div>		
		</body>

<footer>
  <div class="footer">
    <div class="button-format">
    <a href="../PHP/contact.php">CONTACT ME</a>
    </div>
    <br>
  <p>Copyright © 318 Nutrition<br></p>
</div>
</footer>

</html>
	<?php
	$result->free();
?>

<?php
if(isset($_POST['submit']))
{
		$tw = $_SESSION["temp"];
    $new_fname = $_POST['FName'];
		$new_lname = $_POST['LName'];
		$new_phone = $_POST['Phone'];
		$new_email = $_POST['Email'];
		$new_employee = $_POST['question'];
    $result = $link->query("UPDATE Accounts SET FName='$new_fname', LName='$new_lname', Phone='$new_phone', Email='$new_email' WHERE ACC_ID='$tw'");
    if ($_SESSION["Employee"] == true)
    {
      header("location: ../PHP/admin-panel.php");
      exit;
    }
    else if ($_SESSION["Employee"] == false)
    {
      header("location: ../PHP/user-panel.php");
      exit;
    }
}
?>








