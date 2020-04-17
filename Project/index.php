<?php include("includes/header.php");

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$itemPerPage = 4;
$itemTotalCount = photo::countAll();

$paginate = new paginate($page, $itemPerPage, $itemTotalCount);

$sql = "SELECT * FROM photos 
        LIMIT {$itemPerPage}
        OFFSET {$paginate->offset()}";

$photos = photo::findThisQuery($sql);

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
        <div class="row">
            <ul class="pager">
                <li class="next"></li>
                <li class="previous"></li>
            </ul>
        </div>
    </div>
</div>
<!--    <div class="col-md-4">-->
<!--        --><?php //include("includes/sidebar.php"); ?>
<!--    </div>-->
    <?php include("includes/footer.php"); ?>

