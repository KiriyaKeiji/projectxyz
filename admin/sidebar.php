
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="report.php"><i class="fa fa-fw fa-edit"></i> Unreplied Complaint for <?php echo "$_COOKIE[department]"; ?></a>
                    </li>
                    <li>
                        <a href="download.php"><i class="fa fa-fw fa-table"></i> Download Data</a>
                    </li>
                    <?php if ($_COOKIE['department']=='Super Admin') {
                        # code...?>
                    
                    <li>
                        <a href="import.php"><i class="fa fa-fw fa-table"></i> Import MHS</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>