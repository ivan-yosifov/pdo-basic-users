<?php require_once('./includes/header.php'); ?>
<?php

// Get request not allowed
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	header('Location: index.php');
	exit();
}

// check for correct post values
if(isset($_POST['update']) && isset($_POST['id'])){
	// get user
	$id = $_POST['id'];
	$_SESSION['user_id'] = $id;
	$sql = "SELECT * FROM users WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id" => $id]);

	$user = $stmt->fetch(PDO::FETCH_OBJ);
	$username = $user->username;
	$email = $user->email;
}

// check if form submitted
if(isset($_POST['updateUser'])){

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
		$sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $pdo->prepare($sql);

		$stmt->execute([
			':username' => $username,
			':email' => $email,
			':password' => $hashed_password,
			':id' => $_SESSION['user_id']
		]);

		// set message 
		array_push($_SESSION['msg'], [
			'class' => 'success',
			'text' => 'User was successfully updated'
		]);

		unset($_SESSION['user_id']);
		
		// redirect to page so filds are cleared
		header('Location: index.php');
		exit();
	}
}

?>

<h2 class="mb-5">Update User</h2>

<?php if(isset($_SESSION['msg']) && count($_SESSION['msg']) != 0): ?>
<?php foreach($_SESSION['msg'] as $msg): ?>
<p class="alert alert-<?php echo $msg['class']; ?> py-2"><?php echo $msg['text']; ?></p>
<?php endforeach; ?>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="<?php if(isset($username)) echo $username; ?>">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php if(isset($email)) echo $email; ?>">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>  
  <button type="submit" class="btn btn-primary" name="updateUser">Update</button>
</form>

<?php require_once('./includes/footer.php'); ?>