<?php require_once('./includes/header.php'); ?>

<form action="" method="post" class="mb-4">
	<div class="row py-3">

	  <div class="col-md-3">
	    <input type="text" id="username" class="form-control" name="username" placeholder="Username" aria-describedby="username">
	  </div>
	  <div class="col-md-3">
	    <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" aria-describedby="email">
	  </div>
	  <div class="col-md-3">
	    <input type="password" id="password" class="form-control" name="password" placeholder="Password" aria-describedby="password">
	  </div>
	  <div class="col-md-3">
	    <input type="submit" class="btn btn-success w-100" value="Add User">
	  </div>
	</div>
</form>

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