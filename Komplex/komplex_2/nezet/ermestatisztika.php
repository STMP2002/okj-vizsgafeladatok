<?php include_once '../fejlec.php'; ?>
<section class="mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4 text-center"><?php echo "$cim"; ?></h1>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <?php include_once '../include/inc_ermestatisztika.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once '../lablec.php'; ?>