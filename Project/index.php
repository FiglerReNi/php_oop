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
            <?php foreach ($photos as $photo): ?>
                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?= $photo->id; ?>">
                        <img src="admin/<?= $photo->Path(); ?>" alt="" class="img-responsive photoSize">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <ul class="pager"> <!-- pagination egy másik class más kinézettel -->
                <?php
                if ($paginate->pageTotal() > 1) {
                    if ($paginate->hasNext()) {
                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }

                    for ($i = 1; $i <= $paginate->pageTotal(); $i++) {
                        if ($i == $paginate->currentPage) {
                            echo "<li class='active'><a href='index.php?page={$i}'>$i</a></li>";
                        } else {
                            echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                        }
                    }
                    if ($paginate->hasPrevious()) {
                        echo " <li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>

