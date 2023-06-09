<div class="container container-post">
    <div class="col">
        <div class="row">
            <div class="col-3">
            <?php 
                    $image = "";
                    if(file_exists($ROW_USER['profile_image']))
                    {
                        $image = $ROW_USER['profile_image'];
                    }
                    ?>
                <img src="<?php echo $image ?>" width="150px">
            </div>
            <div class="col-9">
                <h1><?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name']?></h1>
                <h2><?php echo $ROW['date']?></h2>
                <h3><?php echo $ROW['post']?></h3>
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</div><br>