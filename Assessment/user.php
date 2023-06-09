<div class="col-12">
    <div class="row friend-list">
        <div class="col-4">
            <?php 
                $image = "";
                if(file_exists($FRIEND_ROW['profile_image']))
                {
                    $image = $FRIEND_ROW['profile_image'];
                }
                ?>
            <img src="<?php echo $image ?>" width="50rem" height="50rem">
        </div>
        <div class="col">
            <h2><?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?></h1>
        </div>
    </div>
</div><br>