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
    <header>
        <div class="px-3 py-2 bg-dark text-white">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="#" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <div style="font-size: 30px;"><i class="fa-solid fa-circle-dollar-to-slot"></i></div>
                    </a>

                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <li>
                            <a href="#" class="nav-link text-secondary">
                                <div class="nav-item">
                                    <div class="icon"><i class="fa-solid fa-house"></i></div>
                                    <div class="text"> Home</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <div class="nav-item">
                                    <div class="icon"> <i class="fa-solid fa-display"></i></div>
                                    <div class="text"> Dashboard</div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-4">
        <div class="row ">
            <div class="row mb-3  justify-content-center">
                <div class="col-10">
                    <div class="row">
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

                </div>

            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-10">
                    <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                        <div class="bg-light border rounded-3">
                            <div class="box-container">
                                <?php for ($i = 0; $i <= 99; $i++) : ?>
                                    <div class="box-item">
                                        <div class="box-item-image">
                                            <img src="./image/Sold-Out-PNG.png" alt="">
                                        </div>
                                        <div class="box-item-tool"></div>
                                        <div class="box-item-number"><?= $i <= 9 ? '0' . $i : $i ?></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="bg-light border rounded-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once './script.php'; ?>
</body>


</html>