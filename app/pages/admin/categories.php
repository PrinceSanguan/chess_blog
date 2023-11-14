<?php if($action == "add"):?>

<div class="col-md-6 mx-auto">
  <form method="post" enctype="multipart/form-data">

    <h1 class="h3 mb-3 fw-normal">Create Category</h1>

   

    <div class="form-floating">
      <input value="<?= old_value("category") ?>" type="text" name="category" class="form-control mb-2" id="floatingInput" placeholder="Category">
      <label for="floatingInput">Category</label>
    </div>
    <?php if (!empty($errors["category"])):?>
      <div class="text-danger"><?=$errors["category"]?></div>
    <?php endif;?>

    <div class="form-floating">
      <select name="disabled" class="form-select my-3">
        <option value="0">Yes</option>
        <option value="1">No</option>
      </select>
      <label for="floatingInput">Active</label>
    </div>

    <a href="<?=ROOT?>/admin/categories">
      <button class="mt-4 btn btn-primary py-2" type="button">Back</button>
    </a>
    <button class="mt-4 btn btn-primary py-2 float-end" type="submit">Create</button>
  </form>
</div>

<?php elseif($action == "edit"):?>

<div class="col-md-6 mx-auto">
  <form method="post" enctype="multipart/form-data">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Edit Category</h1>

    <?php if(!empty($row)):?>

    <?php if(!empty($errors)):?>
      <div class="alert alert-danger">Please fix the error below</div>
    <?php endif;?>

    <div class="my-2">
        <label class="d-block">
          <img class="mx-auto d-block image-preview-edit" src="<?=get_image($row['image'])?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
          <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
        </label>
        <?php if(!empty($errors['image'])):?>
          <div class="text-danger"><?=$errors['image']?></div>
        <?php endif;?>

        <script>
          
          function display_image_edit(file)
          {
            document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
          }
        </script>
    </div>

    <div class="form-floating">
      <input value="<?= old_value("username", $row["username"])?>" type="text" name="username" class="form-control mb-2" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <?php if(!empty($errors["username"])):?>
      <div class="text-danger"><?=$errors["username"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <input value="<?= old_value("email", $row["email"])?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <?php if(!empty($errors["email"])):?>
      <div class="text-danger"><?=$errors["email"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <select name="role" class="form-select my-3">
        <option <?= old_select("role", "user", $row["role"]) ?> value="user">User</option>
        <option <?= old_select("role", "admin", $row["role"]) ?> value="admin">Admin</option>
      </select>
      <label for="floatingInput">Role</label>
    </div>
    <?php if (!empty($errors["role"])):?>
      <div class="text-danger"><?=$errors["role"]?></div>
    <?php endif;?>




    <div class="form-floating">
      <input value="<?= old_value("password") ?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password (Leave empty to keep old one)</label>
    </div>
    <?php if(!empty($errors["password"])):?>
      <div class="text-danger"><?=$errors["password"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <input value="<?= old_value("retype_password") ?>" name="retype_password" type="password" class="form-control" id="floatingPassword" placeholder="Retype Password">
      <label for="floatingPassword">Retype Password</label>
    </div>

    <a href="<?=ROOT?>/admin/categories">
      <button class="mt-4 btn btn-primary py-2" type="button">Back</button>
    </a>
      <button class="mt-4 btn btn-primary py-2 float-end" type="submit">Save</button>
    <?php else:?>

      <div class="alert alert-danger text-center">Record not found!</div>

    <?php endif;?>
  </form>
</div>


<?php elseif($action == "delete"):?>

<div class="col-md-6 mx-auto">
  <form method="post">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Delete Category</h1>

    <?php if(!empty($row)):?>

    <?php if(!empty($errors)):?>
      <div class="alert alert-danger">Please fix the error below</div>
    <?php endif;?>

    <div class="form-floating">
      <div class="form-control mb-2"><?=old_value("username", $row["username"])?></div>
    </div>
    <?php if(!empty($errors["username"])):?>
      <div class="text-danger"><?=$errors["username"]?></div>
    <?php endif;?>


    <div class="form-floating">
    <div class="form-control mb-2"><?=old_value("email", $row["email"])?></div>
    </div>

    <?php if(!empty($errors["email"])):?>
      <div class="text-danger"><?=$errors["email"]?></div>
    <?php endif;?>

    <a href="<?=ROOT?>/admin/categories">
      <button class="mt-4 btn btn-primary py-2" type="button">Back</button>
    </a>
      <button class="mt-4 btn btn-danger py-2 float-end" type="submit">Delete</button>
    <?php else:?>

      <div class="alert alert-danger text-center">Record not found!</div>

    <?php endif;?>
  </form>
</div>

<?php else:?>

<h4>
  Categories 
  <a href="<?=ROOT?>/admin/categories/add">
    <button class="btn btn-primary">Add New</button>
  </a>
</h4>

<div class="table-responsive">
  <table class="table">

    <tr>
      <th>#</th>
      <th>Category</th>
      <th>Slug</th>
      <th>Disabled</th>
      <th>Action</th>
    </tr>

    <?php
      $limit = 10;
      $offset = ($PAGE["page_number"] - 1) * $limit;


      $query = "select * from categories order by id desc limit $limit offset $offset";
      $rows = query($query);

    ?>


  
    <?php if(!empty($rows)):?>
      <?php foreach($rows as $row):?>
    <tr>
      <td><?=$row["id"]?></td>
      <td><?=esc($row["category"])?></td>
      <td><?=$row["slug"]?></td>
      <td><?=$row["disabled"]?></td>

      <td>
      <a href="<?= ROOT ?>/admin/categories/edit/<?= $row["id"] ?>">
        <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>
      </a>

        <a href="<?=ROOT?>/admin/categories/delete/<?=$row["id"]?>">
          <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
        </a>
      </td>
    </tr>
      <?php endforeach;?>
    <?php endif;?>
  </table>

      <div class="col-md-12 mb-4">
        <a href="<?=$PAGE['first_link']?>">
          <button class="btn btn-primary">First Page</button>
        </a>

        <a href="<?=$PAGE['prev_link']?>">
          <button class="btn btn-primary">Prev Page</button>
          </a>

        <a href="<?=$PAGE['next_link']?>">
        <button class="btn btn-primary float-end">Next Page</button>
        </a>
      </div>

</div>

<?php endif;?>