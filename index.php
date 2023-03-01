<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once './loadcss.php'; ?>


</head>


<body class="bg-body">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="content">
                            <div class="content-pirce">
                                <div class="text">เบอร์ละ</div>
                                <div class="price">50 .-</div>
                            </div>
                            <div class="content-date">
                                <div class="text">1/3/2566</div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="content-pay">
                            <div class="text">
                                <h1>เบอร์เงินสด</h1>
                            </div>
                            <div class="top-number">
                                ถูกบน 300 .-
                            </div>
                            <div class="bottom-number">
                                ถูกล่าง 3000 .-
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="box-container">
                        <?php for ($i = 0; $i <= 99; $i++) : ?>
                            <div class="box-item">
                                <div class="box-item-tool"></div>
                                <div class="box-item-number"><?= $i ?></div>

                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

            </div>


        </div>

    </div>


    <?php require_once './script.php'; ?>
</body>


</html>