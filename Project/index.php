<?php include("includes/header.php");

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$itemPerPage = 4;
$itemTotalCount = photo::countAll();

$photos = photo::findAll();

?>
<div class="row">
    <div class="col-md-12">
        <div class="thumbnails row">
        <?php foreach($photos as $photo): ?>
            <div class="col-xs-6 col-md-3">
                <a class="thumbnail" href="photo.php?id=<?= $photo->id; ?>">
                    <img src="admin/<?= $photo->Path(); ?>" alt="" class="img-responsive photoSize" >
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<!--    <div class="col-md-4">-->
<!--        --><?php //include("includes/sidebar.php"); ?>
<!--    </div>-->
    <?php include("includes/footer.php"); ?>

