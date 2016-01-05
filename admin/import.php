<?php 
	if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    if(!empty($_FILES)){	

	$f = $_FILES['csv'];
	copy($f['tmp_name'], 'tmp.csv');

	$fo = fopen('tmp.csv', 'r');
	require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
	
	while($read = fgetcsv($fo)){		
		$Pelaporan->createSiswa($read[0],$read[1],$read[2]);			
		
	}
	$msg['success']="Data Berhasil Di input..";

	

}

    

    require_once 'header.php';require_once 'sidebar.php';
 ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <?php if(!empty($msg['success'])):?>
		        <div class="alert alert-info alert-dismissible" role="alert">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	<p><?php echo $msg['success']?></p>
            	</div>
			<?php endif?>
                        <form role="form" action="" method="post" enctype="multipart/form-data">			
			
			<div class="form-group">
		    	<label>Upload CSV</label>
		    	<input type="file" class="form-control"  name="csv" accept=".csv" placeholder="Nomor Unik Barang. Nomor KTP/SIM/NIM, Serial Number" required>

		  	</div> 
			
			<button type="submit" class="btn btn-info">Submit</button>
		</form>
                    </div>
                </div>
                <!-- /.row -->

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

