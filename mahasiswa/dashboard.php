<?php
     if(empty($_COOKIE['type'])  or $_COOKIE['type']!='mahasiswa' ){
    header('location: ../index.php');}
    require_once '../lib/user.php';
    $user=new User();
    $rs=$user->getMhs($_COOKIE['id']);
    setcookie("name", $rs[0]['name'], time()+3600,'/');

    require_once '../models/pelaporan.php';
    $pelaporan=new Pelaporan();
    $reports=$pelaporan->getReportbyID($_COOKIE['id']);
    $replieds=$pelaporan->getRepliedbyID($_COOKIE['id']);

    
    

    require_once 'header.php';require_once 'sidebar.php';
?>


            
            <!-- /.navbar-collapse -->
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                
                 

                    <div class="col-sm-12">
                        <h1 class="page-header">
                            Latest Report by You 
                        </h1>
                        <hr/>
                        <?php 

                    foreach ($reports as $report) {
                        # code...
                        ?>
                        <div class="col-sm-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <?php echo $report['tanggal'];?> 
                                    <div class="pull-right"><?php echo $report['kategori']." by ". $_COOKIE['name'] ?></div>
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
                                    $tujuan=$pelaporan->getTujuan($report['id_Pelaporan']);
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
                            </div>
                            <?php 
                            $tanggapan=$pelaporan->getTanggapanbyid($report['id_Pelaporan']);
                                    
                                    foreach ($tanggapan as $key ) {?>
                                    <div class="col-sm-offset-1 ">
                                        <div class="panel panel-primary">
                                <div class="panel-body">
                                <p class="tang"><?php echo "$key[isi]"; ?></p>
                                <hr/>
                                <div class="pull-right"><?php echo "$key[tanggal] by $key[oleh], $key[dep]"; ?></div>
                                </div>

                            </div></div>
                                   <?php }


                                     ?>
                            
                        </div>

                        <?php   }

                 ?>
                        
                    </div>
                    
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Replied Complaint 
                        </h1>
                        <hr/>
                        <?php 

                    foreach ($replieds as $replied) {
                        # code...
                        ?>
                        <div class="col-sm-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <?php echo $replied['tanggal'];?> 
                                    <div class="pull-right"><?php echo $replied['kategori']." by ". $_COOKIE['name'] ?></div>
                                </div>
                       
                                <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-2">
                                    <img class="crops" src="<?php echo "../".$replied['ImagePath'];  ?>">    
                                    </div>
                                    <div class="col-sm-10">
                                    <p class="desk"><?php echo $replied['isi_Pelaporan'];?></p>
                                    <hr/>
                                    <div class="pull-right">
                                    <?php 
                                    $tujuan=$pelaporan->getTujuan($replied['id_Pelaporan']);
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
                            </div>
                            <?php 
                            $tanggapan=$pelaporan->getTanggapanbyid($replied['id_Pelaporan']);
                                    
                                    foreach ($tanggapan as $key ) {?>
                                    <div class="col-sm-offset-1 ">
                                        <div class="panel panel-default">
                                <div class="panel-body">
                                <p class="tang"><?php echo "$key[isi]"; ?></p>
                                <hr/>
                                <div class="pull-right"><?php echo "$key[tanggal] by $key[oleh], $key[dep]"; ?></div>
                                </div>

                            </div></div>
                                   <?php }


                                     ?>
                            
                        </div>

                        <?php   }

                 ?>
                        
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
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>
