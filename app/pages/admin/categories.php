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

    <div class="form-floating">
      <input value="<?= old_value("category", $row["category"])?>" type="text" name="category" class="form-control mb-2" id="floatingInput" placeholder="category">
      <label for="floatingInput">Category</label>
    </div>
    <?php if(!empty($errors["category"])):?>
      <div class="text-danger"><?=$errors["category"]?></div>
    <?php endif;?>


    <div class="form-floating">
      <select name="role" class="form-select my-3">
        <option <?= old_select("disabled", "0", $row["disabled"]) ?> value="0">Yes</option>
        <option <?= old_select("disabled", "1", $row["disabled"]) ?> value="1">No</option>
      </select>
      <label for="floatingInput">Active</label>
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
      <div class="form-control mb-2"><?=old_value("category", $row["category"])?></div>
    </div>
    <?php if(!empty($errors["category"])):?>
      <div class="text-danger"><?=$errors["category"]?></div>
    <?php endif;?>


    <div class="form-floating">
    <div class="form-control mb-2"><?=old_value("slug", $row["slug"])?></div>
    </div>

    <?php if(!empty($errors["slug"])):?>
      <div class="text-danger"><?=$errors["slug"]?></div>
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