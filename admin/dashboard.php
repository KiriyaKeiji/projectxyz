<?php

    if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../lib/user.php';
    $user=new User();
    $rs=$user->getAdmin($_COOKIE['id']);
    setcookie("name", $rs[0]['name'], time()+3600,'/');
    setcookie("department", $rs[0]['department'], time()+3600,'/');
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $reports=$Pelaporan->getReportbyTujuan($_COOKIE['department']);

    require_once 'header.php';require_once 'sidebar.php';


?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Report Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <?php  foreach ($reports as $report) {
                        # code...
                        ?>
                        <div class="col-sm-12">
                            <a href="respond.php?id=<?php echo "$report[idlapor]"; ?>">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <?php echo $report['tanggal'];?> 
                                    <div class="pull-right"><?php echo $report['kategori']." by ". $report['namemhs'] ?></div>
                                </div>
                       
                                <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-2">
                                    <img class="crops" src="<?php echo "../".$report['ImagePath'];  ?>">    
                                    </div>
                                    <div class="col-sm-10">
                                    <p class="desk"><?php echo $report['isi_Pelaporan'];?></p>
                                    <hr/>
                                    <div class="pull-right">
                                    <?php 
                                    $tujuan=$Pelaporan->getTujuan($report['id_Pelaporan']);
                                    $i=0;
                                    echo "To : ";
                                    foreach ($tujuan as $key ) {
                                        echo ($i>0) ?  ", " : "" ;
                                        echo "$key[dep]";
                                    
                                        $i++;
                                    }


                                     ?></div>
                                    </div>


                                    
                                </div>    
                                </div>
                            </div></a>
                            <?php 
                            $tanggapan=$Pelaporan->getTanggapanbyid($report['id_Pelaporan']);
                                    
                                    foreach ($tanggapan as $key ) {?>
                                    <div class="col-sm-offset-1 ">
                                        <div class="panel panel-default">
                                <div class="panel-body">
                                <p class="tang"><?php echo "$key[isi]"; ?></p>
                                <hr/>
                                <?php 
                                    if ($key['oleh']==$_COOKIE['id']) {?>
                                        <a href="edit_reply.php?id=<?php echo $key['idtanggap']?>&idlapor=<?php echo $report['id_Pelaporan']; ?>">
                                            <span class="label label-success">edit</span>
                                        </a>
                                        <a href="del_reply.php?id=<?php echo $key['idtanggap']?>">
                                            <span class="label label-danger">delete</span>
                                        </a>
                                    <?php }
                                 ?>
                                <div class="pull-right"><?php echo "$key[tanggal] by ";
                                echo  ($key['oleh']==$_COOKIE['id']) ? "You" : $key['oleh'] ;
                                echo ", $key[dep]"; ?></div>
                                </div>

                            </div></div>
                                   <?php }


                                     ?></div>

                        <?php   }

                 ?></div></div>
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

