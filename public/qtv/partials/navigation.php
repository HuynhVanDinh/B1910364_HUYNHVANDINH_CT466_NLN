<div>
    <div class="navigation">
        <ul>
            <li>
                <a href="index.php">
                    <span class="icon">
                        <div>
                            <img class="rounded-circle logo" src="../../img/winsmile.jpg" alt="" height="50">
                        </div>
                    </span>
                    <span class="title">Win smile</span>
                </a>
            </li>

            <li>
                <a href="index.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Trang chủ</span>
                </a>
            </li>

            <li>
                <a href="ql_nhasi.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý nha sĩ</span>
                </a>
            </li>

            <li>
                <a href="ql_nhanvien.php">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý nhân viên</span>
                </a>
            </li>
            <li>
                <a href="ql_benhnhan.php">
                    <span class="icon">
                        <ion-icon name="man-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý bệnh nhân</span>
                </a>
            </li>
            <li>
                <a href="ql_benh.php">
                    <span class="icon">
                        <ion-icon name="folder-open-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý danh mục bệnh</span>
                </a>
            </li>

            <li>
                <a href="quanlytintuc\">
                    <span class="icon">
                        <ion-icon name="newspaper-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý tin tức</span>
                </a>
            </li>

            <li>
                <a href="quanlytaikhoan\">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý tài khoản</span>
                </a>
            </li>

            <li>
                <a href="phanhoi.php">
                    <span class="icon">
                        <ion-icon name="chatbubbles"></ion-icon>
                    </span>
                    <span class="title">Phản hồi</span>
                </a>
            </li>
            <?php if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {unset($_SESSION['id_user']); } ?>
            <li>
                <a href="../index.php?dangxuat=1">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Đăng xuất</span>
                </a>
            </li>
        </ul>
    </div>