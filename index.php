<?php require_once('./includes/header.php'); ?>
<?php

	// check if form submitted
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

	// get all users from database
	$sql = "SELECT * FROM users";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	$count = 1; // increment for each user - first column in table
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
  	<?php foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $user): ?>
    <tr>
      <th scope="row"><?php echo $count++; ?></th>
      <td><?php echo $user->username; ?></td>
      <td><?php echo $user->email ?></td>
      <td>
      	<form action="<?php echo htmlspecialchars('./update.php'); ?>" class="d-inline" method="post">
      		<input type="hidden" name="id" value="<?php echo $user->id; ?>">
      		<input type="submit" value="Update" name="update" class="btn btn-primary btn-sm">
      	</form>
      	<form action="<?php echo htmlspecialchars('./delete.php'); ?>" class="d-inline" method="post">
      		<input type="hidden" name="id" value="<?php echo $user->id; ?>">
      		<input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm">
      	</form>
      	
      </td>
    </tr>
  	<?php endforeach; ?>
  </tbody>
</table>

<?php require_once('./includes/footer.php'); ?>