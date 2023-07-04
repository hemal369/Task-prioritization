<?php
include 'authenticate.php';
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        input[type=checkbox]:checked + label.strikethrough{
            text-decoration: line-through;
            }
        .button{
            position: fixed;
            bottom:0;
            right:0;
            padding:10px;
            margin:10px
        }
    </style>
    <title>Smart to do notes</title>
  </head>
  <body>
    <nav class="flex justify-content-center align-items-center navbar bg-body-tertiary">
        <h1>Smart to do Notes</h1>
    </nav>
    <section>
        <div class="row task__container mx-auto p-5 gap-5">
            <div class="col-sm col-sm col-sm">
                 <div class="card bg-danger" style="width:18rem">
                    <div class="card-header d-flex justify-content-center gap-2">
                        <h3>School</h3>
                    </div>
                    <div class="card-body">
                        <ul class="bg-danger">

                        <?php

                        $query = "select * from xyz where tag_name='school'";
                        $row = mysqli_query($conn, $query);
                        while ($roww = mysqli_fetch_assoc($row)) {
                          ?>

                                       <li class="list-group-item">
                                          <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                          <label class="strikethrough form-check-label" for="firstCheckbox"><?php echo $roww['title'] ?></label>
                                       </li>

                                  <?php
                        }

                        ?>
                                             
                          </ul>
                    </div>
                  </div>
            </div>
            <div class="col-sm col-sm col-sm">
                 <div class="card bg-danger" style="width:18rem">
                    <div class="card-header d-flex justify-content-center gap-2">
                        <h3>Work</h3>
                    </div>
                    <div class="card-body">
                        <ul class="bg-danger">

                        <?php

                        $query = "select * from xyz where tag_name='work'";
                        $row = mysqli_query($conn, $query);
                        while ($roww = mysqli_fetch_assoc($row)) {
                          ?>

                                       <li class="list-group-item">
                                          <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                          <label class="strikethrough form-check-label" for="firstCheckbox"><?php echo $roww['title'] ?></label>
                                       </li>

                                  <?php
                        }

                        ?>
                                             
                          </ul>
                    </div>
                  </div>
        </div>
        <div class="col-sm col-sm col-sm">
                 <div class="card bg-danger" style="width:18rem">
                    <div class="card-header d-flex justify-content-center gap-2">
                        <h3>Personel</h3>
                    </div>
                    <div class="card-body">
                        <ul class="bg-danger">

                        <?php

                        $query = "select * from xyz where tag_name='personel'";
                        $row = mysqli_query($conn, $query);
                        while ($roww = mysqli_fetch_assoc($row)) {
                          ?>

                                       <li class="list-group-item">
                                          <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                          <label class="strikethrough form-check-label" for="firstCheckbox"><?php echo $roww['title'] ?></label>
                                       </li>

                                  <?php
                        }

                        ?>
                                             
                          </ul>
                    </div>
                  </div>
                  <div class="col-sm col-sm col-sm">
                 <div class="card bg-danger" style="width:18rem">
                    <div class="card-header d-flex justify-content-center gap-2">
                        <h3>Office</h3>
                    </div>
                    <div class="card-body">
                        <ul class="bg-danger">

                        <?php 
                         
                         $query = "select * from xyz where tag_name='office'"; 
                         $row = mysqli_query($conn ,$query);  
                            while ($roww = mysqli_fetch_assoc($row)) {
                              ?>

                                   <li class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                      <label class="strikethrough form-check-label" for="firstCheckbox"><?php echo $roww['title'] ?></label>
                                   </li>

                              <?php
                            }

                        ?>
                                             
                          </ul>
                    </div>
                  </div>

                  <div class="col-sm col-sm col-sm">
                 <div class="card bg-danger" style="width:18rem">
                    <div class="card-header d-flex justify-content-center gap-2">
                        <h3>Others...</h3>
                    </div>
                    <div class="card-body">
                        <ul class="bg-danger">

                        <?php 
                         
                         $query = "select * from xyz where tag_name='other'"; 
                         $row = mysqli_query($conn ,$query);  
                            while ($roww = mysqli_fetch_assoc($row)) {
                              ?>

                                   <li class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                      <label class="strikethrough form-check-label" for="firstCheckbox"><?php echo $roww['title'] ?></label>
                                   </li>

                              <?php
                            }

                        ?>
                                             
                          </ul>
                    </div>
                  </div>
    </section>
    <section class="button">
        <button type="button" class="btn btn-primary">Prioritize my tasks</button>
    </section>
  </body>
</html>