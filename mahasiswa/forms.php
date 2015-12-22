<?php 
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan;

    if(empty($_COOKIE['type'])  or $_COOKIE['type']!='mahasiswa' ){
    header('location: ../index.php');}
    if (!empty($_POST)) {
        # code...
    
    if (empty($_POST['report']) || empty($_POST['cat']) || empty($_POST['dep']) ) {
        $msg['error']='Field bertanda bintang harus di isi!';
        $uploadOk=0;
        #echo "1";
    }elseif ($_FILES['image']['error']==4) {
        $imgdir="Image/default.jpg";
        $uploadOk=1;
        #echo "2";
    }elseif ($_FILES['image']['error']!=0 && $_FILES['image']['error']!=4) {
        $msg['error']="Terdapat masalah dengan gambar anda..";
        $uploadOk=0;
        #echo "3";
    }else{
        $f=$_FILES['image'];
        $imgdir="Image/".date("YmdHis").$f['name'];
        $uploadOk=1;
        copy($f['tmp_name'], $imgdir);
        #echo "4";
    }

    if ($uploadOk==1) {
               
        $Pelaporan->newReport($_POST['report'],$imgdir,$_COOKIE['id'],$_POST['cat'],$_POST['dep']);
        
        $msg['success']="Data Berhasil Di input..";
    }

}

    
    require_once '../models/kategori.php';
    $Kategori=new Kategori;
    $cat=$Kategori->getKategori();
    require_once '../models/departemen.php';
    $Departemen=new Departemen;
    $dep=$Departemen->getDepartemen();

    require_once 'header.php';require_once 'sidebar.php';


    
 ?>
            

        <div id="page-wrapper">

            <div class="container-fluid">

            

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <?php if(!empty($msg['error'])):?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php echo $msg['error']?></p>
                </div>
            <?php endif?>
            <?php if(!empty($msg['success'])):?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php echo $msg['success']?></p>
                </div>
            <?php endif?>
                        <h1 class="page-header">
                            Forms
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Forms
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">

                       <form method="post" enctype="multipart/form-data">
                    <div class="form-group col-lg-12">
                        <label for="inputPassword3" class="col-sm-3 control-label">Report<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                <textarea name="report" class="form-control" rows="5"  placeholder="Detail Laporan. Contoh: Wifi disconnected"></textarea>
                            </div>
                    </div>  
    

                    <div class="form-group col-lg-12">
                        <label class="col-sm-3 control-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="inputEmail3" name="image" accept="image/*" placeholder="Nomor Unik Barang. Nomor KTP/SIM/NIM, Serial Number">
                            </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-sm-3 control-label">Category<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                
                                    
                                <select class="form-control" name="cat">
                                    <?php foreach($cat as $cats):?>
                                            
                                            <?php echo '<option value="';
                                                echo $cats['id_KategoriLapor'];
                                                
                                                echo '">';
                                                echo $cats['nama_KategoriLapor'];
                                                echo "</option>";?>
                                        <?php endforeach?>
                                </select>
                            </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-sm-3 control-label">Department<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                
                                    
                                <select multiple class="form-control" name="dep[]">
                                    <?php foreach($dep as $deps):?>
                                            
                                            <?php echo '<option value="';
                                                echo $deps['id_Departemen'];
                                                
                                                echo '">';
                                                echo $deps['nama_Departemen'];
                                                echo "</option>";?>
                                        <?php endforeach?>
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                        
                    </div>

                    

                </form>

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
