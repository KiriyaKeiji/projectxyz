<?php

    if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $reports=$Pelaporan->getReportbyTujuan($_COOKIE['department']);
    

    require_once 'header.php';require_once 'sidebar.php';
    

?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

