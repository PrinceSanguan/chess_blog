<?php
    include "../app/pages/includes/header.php";
  ?>

<div class="mx-auto col-md-10">

      <h3 class="mx-4">Chess Blog</h3>

      <!-- posting eto yun-->

      <div class="row mb-2 justify-content-center">

      <?php


        $slug = $url[1] ?? null;

        if($slug) {
          $query = "select posts.*,categories.category from posts join categories on posts.category_id where posts.slug = :slug limit 1";
          $row = query_row($query, ["slug"=>$slug]);
        }
        
        if(!empty($row)) {
      
           ?>
        <div class="col-md-12">
          <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
            <div class="col-12 d-lg-block">
                <img class="bd-placeholder-img w-100" width="100%" src="<?=get_image($row["image"])?>" style="object-fit: cover;" alt="">
              </div>
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?=esc($row["category"] ?? "Unknown")?></strong>
                <h3 class="mb-0"><?=esc($row["title"])?></h3>
                <div class="mb-1 text-body-secondary"><?=date("jS M, Y", strtotime($row["date"]))?></div>
                <p class="card-text mb-auto"><?=nl2br(add_root_to_images($row["content"]))?></p>
              </div>
          </div>
        </div>

          <?php
        }else {
          echo "No item Found!";
        }
        

      ?>
      
    </div>

  <?php
    include "../app/pages/includes/footer.php";
  ?>

