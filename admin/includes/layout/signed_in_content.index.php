<div class="container-fluid">
    <!-- Signed in content -->
    <div class="row-fluid">
        <div class="col-sm-12 contentArea">
            <h1 class="titles text-left">Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></h1>
            <?php
                if($user->hasPermission('admin')) {
                    echo '<p>You are an administrator!</p>';
                }
            ?>
            <div class="col-sm-12">
                <h1 class="titles text-left">Site Administration</h1>
                <?php print "$siteCatDisplayList"; ?>
            </div>
            <div class="col-sm-12">
                <h1 class="titles text-left">Server Administration</h1>
                <?php print "$serverCatDisplayList"; ?>
            </div>
            <div class="col-sm-12">
                <h1 class="titles text-left">Office Administration</h1>
                <?php print "$officeCatDisplayList"; ?>
            </div>
        </div>
    </div>
</div>