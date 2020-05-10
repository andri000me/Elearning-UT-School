<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_peserta/aksi_peserta.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil peserta
    default: ?>

<style>
            .autocomplete {
                padding: 2px 25px;
                white-space: nowrap;
                overflow: hidden;
                background: #fff;
                position: absolute;
                z-index: 99;
            }
             .autocomplete a {
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                color: #838384;
                text-decoration: none;
            }

            .autocomplete a hover{
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                color: #fff;
                background: #f7f7f7;
                text-decoration: none;
            }
            .autocomplete-selected {
                background: #337ab7;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: none;
                
            }
        </style>    

<?php 

        echo "
        <section class=\"content-header\">
         <h1>
          Data Peserta <br><br>
          <button id=\"formbtn\" class=\"btn btn-success\" onclick=location.href=\"?module=peserta&act=tambahpeserta\"><i class=\"fa fa-plus\"></i> Tambah Peserta</button>
         </h1>
         </section>
        
        <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">    
        <div class=\"center\">
          <div class=\"box\">
            <!--<div class=\"box-header\">-->              
            <!--</div>-->
            <!-- /.box-header -->

            <div class=\"box-body table-responsive\">
              <table id=\"dataTable\" class=\"table table-bordered table-striped\">
                <thead>
                <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Nama Peserta</th>
                <th>Registrasi Pembayaran</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>";

      $user=new User();
      $news=$user->tampil_peserta();  
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {  
                echo "<tr><td width=10px>$no</td>
                  <td>$r[periode]</td>
                  <td>$r[nama]</td>
                  <td>$r[pembayaran]</td>
                  <td width=130px>
                  <a href=\"?module=peserta&act=editpeserta&id=$r[id_peserta]\" class=\"btn btn-info btn-xs\" title=\"Edit Data\"><i class=\"fas fa-edit\"></i></a> &nbsp;
                  <a href=\"$aksi?module=peserta&act=hapus&id=$r[id_peserta]\" class=\"btn btn-danger btn-xs\" title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[id_peserta]?')\"><i class=\"fa fa-trash\"></i></a></td>
              </tr>";
              $no++;
            }
          }
                
                echo "</tbody>  
                            
                </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>";
          
    break;    
  
    case "tambahpeserta":
      echo "
      <section class=\"content-header\">
      <h1>
        Data Peserta
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"index.php?module=beranda\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
        <li class=\"active\">Tambah Data Peserta</li>
      </ol>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"box box-info\">
            <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Tambah Data Peserta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" action=\"$aksi?module=peserta&act=input\" enctype=\"multipart/form-data\">
              <div class=\"box-body\"> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama User<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\" placeholder=\"Ketik beberapa huruf\" name=\"nama\" onkeyup=\"autoComplete();\" required>
                    <input type=\"hidden\" name=\"id_user\" class=\"form-control\" id=\"id_user\" placeholder=\"\" required>
                      <div  id=\"hasil\" class=\"autocomplete\">
                  </div>
                </div>
                </div>              
          
                 <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Pembayaran<span class='text-danger' title='This field is required'>*</span></label>
                <div class=\"col-sm-9\">
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios1\" value=\"l\">
                <label class=\"form-check-label\" for=\"exampleRadios1\">
                  Lunas
                </label>
                </div>
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios2\" value=\"bl\">
                <label class=\"form-check-label\" for=\"exampleRadios2\">
                  Belum Lunas
                </label>
              </div>
              </div>
              </div>    
                  
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class=\"box-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Save</button>                
              </div>
              <!-- /.box-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.box --> ";
    break;
       
    case "editpeserta":
     $user=new User();
      $r=$user->detail_peserta_edit($_GET['id']);
      
      echo"<section class=\"content-header\">
      <h1>
        Data Peserta
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"index.php?module=beranda\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
        <li class=\"active\">Edit Data Peserta</li>
      </ol>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">
      <!-- Horizontal Form -->
          <div class=\"box box-info\">
            <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Tambah Data Peserta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=peserta&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_peserta]\">
              <div class=\"box-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama User<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\"  name=\"nama\" value=\"$r[nama]\" readonly>
                    <input type=\"hidden\" name=\"id_user\" value=\"$r[id_user]\" class=\"form-control\" id=\"id_user\" placeholder=\"\" required>
                  </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Pembayaran<span class='text-danger' title='This field is required'>*</span></label>
                <div class=\"col-sm-9\">";
                if ($r['pembayaran']=="l") {
                  echo "
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios1\" value=\"l\" checked>
                <label class=\"form-check-label\" for=\"exampleRadios1\">
                  lunas
                </label>
                </div>

                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios2\" value=\"bl\">
                <label class=\"form-check-label\" for=\"exampleRadios2\">
                  Belum Lunas
                </label>
              </div>";
            }
            else { echo "
              <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios1\" value=\"l\">
                <label class=\"form-check-label\" for=\"exampleRadios1\">
                  lunas
                </label>
                </div>

                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"pembayaran\" id=\"exampleRadios2\" value=\"bl\" checked>
                <label class=\"form-check-label\" for=\"exampleRadios2\">
                  Belum Lunas
                </label>
              </div>";
            }
              echo "
              </div>
              </div>        
                  
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class=\"box-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Save</button>                
              </div>
              <!-- /.box-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.box --> ";


  
    break;  
  }
}
?>
 <script language="JavaScript">
    var ajaxRequest;
    function getAjax() { //fungsi untuk mengecek AJAX pada browser
        try {
            ajaxRequest = new XMLHttpRequest();
        } catch (e) {
            try {
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                   ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
    }
    function autoComplete() { //fungsi menangkap input search dan menampilkan hasil search
        getAjax();
        input = document.getElementById('inputan').value;
        if (input == "") {
            document.getElementById("hasil").innerHTML = "";
        }
        else {
            ajaxRequest.open("GET","cari.php?input="+input);
            ajaxRequest.onreadystatechange = function() {
                document.getElementById("hasil").innerHTML = ajaxRequest.responseText;
            }
            ajaxRequest.send(null);
        }
    }
    function convertToRupiah(angka)
      {
        var rupiah = '';    
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
      }

    function autoInsert(id_user,nama) { //fungsi mengisi input text dengan hasil pencarian yang dipilih
        document.getElementById("inputan").value = nama;
        document.getElementById("id_user").value = id_user;
        document.getElementById("hasil").innerHTML = "";

    }       
</script>