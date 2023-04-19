        <nav class="row">
            <div class="pt-2 pb-2 nav-h col-12">
                <div class="row">
                    <div class="pl-5 col-lg-4 col-sm-6 text-white">
                        <h6>Hà Nội: <strong class="number">0371234567</strong> | TP.Hồ Chí Minh: <strong
                                class="number">0377654321</strong></h6>

                    </div>
                    <div class="col-lg-4 col-sm-6"></div>
                    <div class="pl-5 col-lg-4 col-sm-6 text-white">
                        <h6>Giờ mở cửa: <strong class="number">8h00 - 20h00</strong></h6>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-sm navbar-light col">
                <a class="navbar-brand" href="index.php">
                    <img src="img/winsmile.jpg" class="img-fluid" width="80" height="80">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tintuc.php">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nhasi.php">Nha sĩ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="vetoi.php">Về tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lienhe.php">Liên hệ</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm..." name="tukhoa">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="timkiem">Tìm
                            kiếm</button>
                    </form>
                    <div class="nav-item dropdown ml-3">
                        <!-- <div class="nav-link dropdown-toggle border " href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-log "><img src="/V_TiemChung/assets/uploads/<?= $user->avatar ?>" alt=""
                                    class="rounded-circle" style="width:30px; height:30px"> &nbsp;
                                <?= $user->ten ?></span> |
                        </div> -->
                        <?php
                            use ct466\Nhakhoa\Benhnhan;
                            require_once __DIR__. "/../bootstrap.php";
                            $benhnhan = new Benhnhan($PDO);
                        if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
                            unset($_SESSION['id_benhnhan']);
                            }
                        if (isset($_SESSION['id_benhnhan'])) {
                            $benhnhanid = $_SESSION['id_benhnhan'];
                            $benhnhanData = $benhnhan->find($benhnhanid);
                        ?>
                        <div class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-log ">
                                <img src="img/upload/admin.jpg" alt="" class="rounded-circle"
                                    style="width:40px; height:40px"> &nbsp;
                                <?php echo $benhnhanData->hoten; ?>
                            </span> |
                        </div>
                        <div class="dropdown-menu shadow-lg">
                            <a href="index.php?dangxuat=1" class="dropdown-item "><i
                                    class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                            <a href="hoadon.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Lịch sử
                                hoá đơn</a>
                            <a href="ls_kham.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Lịch sử
                                khám</a>
                            <a href="suataikhoan.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Sửa tài
                                khoản</a>
                            <a href="suathongtin.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Sửa thông
                                tin</a>
                        </div>
                        <?php
                            } else {
                            ?>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Đăng nhập <img src="img/login.png" alt=""></a>
                            </li>
                        </ul>
                        <?php
                            }
                         ?>
                    </div>
                </div>
            </nav>
        </nav>