<?php 
if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $reports=$Pelaporan->getReportbyIDLapor($_GET['id'],$_COOKIE['department']);

    require_once 'header.php';require_once 'sidebar.php';




 ?>

  <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <?php  foreach ($reports as $report) {
                        # code...
                        ?>
                        <div class="col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <?php echo $report['tanggal'];?> 
                                    <div class="pull-right"><?php echo $report['kategori']." by ". $report['mhs'] ?></div>
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
                            </div>
                            <?php 
                            $tanggapan=$Pelaporan->getTanggapanbyid($report['id_Pelaporan']);
                                    
                                    foreach ($tanggapan as $key ) {?>
                                    <div class="col-sm-offset-1 ">
                                        <div class="panel panel-default">
                                <div class="panel-body">
                                <p class="tang"><?php echo "$key[isi]"; ?></p>
                                <hr/>
                                
                                <div class="pull-right"><?php echo "$key[tanggal] by ";
                                echo  ($key['oleh']==$_COOKIE['id']) ? "You" : $key['oleh'] ;
                                echo ", $key[dep]"; ?></div>
                                </div>

                            </div></div>
                                   <?php }




                                     ?>
                                     <div class="col-sm-offset-1 ">
                                        <div class="panel panel-default">
                                <div class="panel-body">
                                <form method="post" action="newrespond.php">
                                	<textarea class="form-control" rows="5" name="isi" placeholder="Write respond..." required></textarea>
                                	<input type="hidden" name="idlaporan" value="<?php echo "$_GET[id]"; ?>">
                                	<input type="hidden" name="oleh" value="<?php echo "$_COOKIE[id]"; ?>">
                                	<hr/>
                                	<div class="pull-right">
                                		<?php echo "$_COOKIE[name], $_COOKIE[department]"; ?>
                                		<button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                                	</div>
                                </form>
                                </div>

                            </div></div></div>

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

