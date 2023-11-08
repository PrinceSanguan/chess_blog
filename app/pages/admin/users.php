<?php if($action == "add"):?>

  <form method="post">
    <a href="home">
      <img class="mb-4 shadow" src="<?=ROOT?>/assets/images/logo.png" alt="" width="300" height="57" style="object-fit: fill;">
    </a>
    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Create Account</h1>

    <?php if(!empty($errors)):?>
      <div class="alert alert-danger">Please fix the error below</div>
    <?php endif;?>

    <div class="form-floating">
      <input value="<?= old_value("username") ?>" type="text" name="username" class="form-control mb-2" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <?php if (!empty($errors["username"])):?>
      <div class="text-danger"><?=$errors["username"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <input value="<?= old_value("email") ?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <?php if (!empty($errors["email"])):?>
      <div class="text-danger"><?=$errors["email"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <input value="<?= old_value("password") ?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <?php if (!empty($errors["password"])):?>
      <div class="text-danger"><?=$errors["password"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <input value="<?= old_value("retype_password") ?>" name="retype_password" type="password" class="form-control" id="floatingPassword" placeholder="Retype Password">
      <label for="floatingPassword">Retype Password</label>
    </div>

    <div class="my-2">Already have an Account? <a href="<?=ROOT?>/login">Login here</a></div>

    <div class="form-check text-start my-3">
      <input <?= old_checked("terms")?> name="terms" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Accept Terms and Conditions
      </label>
    </div>
    <?php if (!empty($errors["terms"])):?>
      <div class="text-danger"><?=$errors["terms"]?></div>
    <?php endif;?>



    <button class="btn btn-primary w-100 py-2" type="submit">Create</button>
    <p class="mt-5 mb-3 text-body-secondary" style="text-align: center;">&copy; <?php echo date("Y")?></p>
  </form>

<?php elseif($action == "edit"):?>

<?php elseif($action == "delete"):?>

<?php else:?>

  <h4>Users <button class="btn btn-primary">Add New</button></h4>

  <div class="table-responsive">
    <table class="table">

      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Image</th>
        <th>Date</th>
        <th>Action</th>
      </tr>

      <?php

        $query = "select * from users order by id desc";
        $rows = query($query);

      ?>


    
      <?php if(!empty($rows)):?>
        <?php foreach($rows as $row):?>
      <tr>
        <td><?=$row["id"]?></td>
        <td><?=esc($row["username"])?></td>
        <td><?=$row["email"]?></td>
        <td><?=$row["role"]?></td>
        <td>Images</td>
        <td><?=date("jS M, Y",strtotime($row["date"]))?></td>
        <td>
          <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
        </td>
      </tr>
        <?php endforeach;?>
      <?php endif;?>
    </table>
  </div>

<?php endif;?>