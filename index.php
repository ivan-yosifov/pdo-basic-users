<?php require_once('./includes/header.php'); ?>
<?php
	if(isset($_POST['addUser'])){
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		$errors = false;

		$_SESSION['msg'] = array();

		// input validation - username
		if(empty($username)){
			array_push($_SESSION['msg'], [
				'class' => 'danger',
				'text' => 'Username is a required field'
			]);
			$errors = true;
		}else if(strlen($username) < 2){
			array_push($_SESSION['msg'], [
				'class' => 'danger',
				'text' => 'Username must be at least 2 characters long'
			]);
			$errors = true;
		}

		// input validation - email
		if(empty($email)){
			array_push($_SESSION['msg'], [
				'class' => 'danger',
				'text' => 'Email Address is a required field'
			]);
			$errors = true;
		}

		// input validation - password
		if(empty($password)){
			array_push($_SESSION['msg'], [
				'class' => 'danger',
				'text' => 'Password is a required field'
			]);
			$errors = true;
		}else if(strlen($password) < 6){
			array_push($_SESSION['msg'], [
				'class' => 'danger',
				'text' => 'Password must be at least 6 characters long'
			]);
			$errors = true;
		}

		// insert user into database
		if(!$errors){
			$sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $pdo->prepare($sql);

			$stmt->execute([
				':username' => $username,
				':email' => $email,
				':password' => $hashed_password
			]);

			// set message 
			array_push($_SESSION['msg'], [
				'class' => 'success',
				'text' => 'User was successfully added'
			]);

			// redirect to page so filds are cleared
			header('Location: index.php');
			exit();
		}
		
	}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mb-4">
	<div class="row py-3">

	  <div class="col-md-3">
	    <input type="text" id="username" class="form-control" name="username" placeholder="Username" aria-describedby="username" value="<?php if(isset($username)) echo $username; ?>">
	  </div>
	  <div class="col-md-3">
	    <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" aria-describedby="email" value="<?php if(isset($email)) echo $email; ?>">
	  </div>
	  <div class="col-md-3">
	    <input type="password" id="password" class="form-control" name="password" placeholder="Password" aria-describedby="password" value="<?php if(isset($password)) echo $password; ?>">
	  </div>
	  <div class="col-md-3">
	    <input type="submit" class="btn btn-success w-100" name="addUser" value="Add User">
	  </div>
	</div>
</form>

<?php if(isset($_SESSION['msg']) && count($_SESSION['msg']) != 0): ?>
<?php foreach($_SESSION['msg'] as $msg): ?>
<p class="alert alert-<?php echo $msg['class']; ?> py-2"><?php echo $msg['text']; ?></p>
<?php endforeach; ?>
<?php endif; ?>

<h2>All Users</h2>
<table class="table table-striped">
  <thead class="text-white bg-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>
      	<a href="./update.php" class="btn btn-warning btn-sm">Update</a>
      </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
  </tbody>
</table>

<?php require_once('./includes/footer.php'); ?>