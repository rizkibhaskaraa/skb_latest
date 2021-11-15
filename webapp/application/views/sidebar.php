<body id="page-top" onload="asd()">
    <!-- Page Wrapper -->
    <div id="wrapper" >
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-light" >
            <!-- Main Content -->
            <div id="content" style='background-color:#182039'>
                <!-- Topbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-black fixed-top mb-5" style='background-color:#212B4E' >
                  <a class="sidebar-brand d-flex align-items-center justify-content-center">               
                    <span><i class="fa-flip-horizontal fa fa-truck text-white mr-2"></i></span>
                    <div class="sidebar-brand-text text-white mr-5 "><h2>SKB</h2></div>
                  </a>
              
                  <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse "  id="navbarSupportedContent" >
                    <ul class="navbar-nav mr-auto" >


                      <li class="nav-item dropdown mr-3" id="LI_Dashboard">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Dashboard" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Dashboard" onclick="aktifasi('Dashboard')">
                          Dashboard
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" id="DB_Izin_page" href="<?=base_url("index.php/dashboard")?>">
                            <!-- <i class="fas fa-clipboard mr-2"></i> -->
                            DB Izin dan Dokumen
                            </a>
                            <a class="dropdown-item" id="DB_Operasional_page" href="<?=base_url("index.php/dashboard/dashboard_operasional")?>">
                            <!-- <i class="fas fa-truck mr-1"></i> -->
                            DB Operasional
                            </a>
                            <a class="dropdown-item" id="DB_Invoice_page" href="<?=base_url("index.php/dashboard/dashboard_invoice")?>">
                            <!-- <i class="fas fa-id-badge mr-2"></i> -->
                            DB Invoice
                            </a>
                        </div>
                      </li>
                    
                      <li class="nav-item dropdown mr-3" id="LI_Master_Data">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Master_Data" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Master_Data" onclick="aktifasi('Master_Data')">
                          Master Data
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" id="Merk_page" href="<?=base_url("index.php/home/merk")?>">
                            MD Tipe Mobil
                            </a>

                            <a class="dropdown-item" id="Kendaraan_page" href="<?=base_url("index.php/home/truck")?>">
                            MD Kendaraan
                            </a>

                            <a class="dropdown-item" id="Supir_page" href="<?=base_url("index.php/home/penggajian")?>">
                            MD Driver
                            </a>

                            <a class="dropdown-item" id="Customer_page" href="<?=base_url("index.php/home/customer")?>">
                            MD Customer
                            </a>

                            <a class="dropdown-item" id="Satuan_page" href="<?=base_url("index.php/home/satuan")?>">
                            MD Rute
                            </a>
                        
                        </div>
                      </li>

                      <li class="nav-item dropdown mr-3" id="LI_Job_Order">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Job_Order" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Job_Order" onclick="aktifasi('Job_Order')">
                          Job Order
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          
                            <a class="dropdown-item" id="Buat_JO_page" href="<?=base_url("index.php/form/joborder")?>">
                            <!-- <i class="fas fa-clipboard mr-2"></i> -->
                            Buat Job Order
                            </a>

                            <a class="dropdown-item" id="JO_page" href="<?=base_url("index.php/home")?>">
                            <!-- <i class="fas fa-truck mr-1"></i> -->
                            Data Job Order
                            </a>

                          <!-- <a class="collapse-item" id="Konfirmasi_JO_page" href="<?=base_url("index.php/home/konfirmasi_jo")?>">
                                            <i class="fas fa-info-circle"></i>
                                            <span id="coba">Konfirmasi Job Order</span>
                                        </a> -->
                        
                        </div>
                      </li>

                      <li class="nav-item dropdown mr-3" id="LI_Invoice">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Invoice" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Invoice" onclick="aktifasi('Invoice')">
                          Invoice
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          
                            <a class="dropdown-item" id="Invoice_page" href="<?=base_url("index.php/home/invoice")?>">
                            <!-- <i class="fas fa-clipboard mr-2"></i> -->
                            Buat Invoice
                            </a>

                            <a class="dropdown-item" id="Invoice_Customer_page" href="<?=base_url("index.php/home/invoice_customer")?>">
                            <!-- <i class="fas fa-truck mr-1"></i> -->
                            Data Invoice
                            </a>
                        
                        </div>
                      </li>

                      <li class="nav-item dropdown mr-3" id="LI_Penggajian">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Penggajian" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Penggajian" onclick="aktifasi('Penggajian')">
                          Penggajian
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          
                            <a class="dropdown-item" id="Gaji_page" href="<?= base_url('index.php/detail/pilih_gaji/x/x/home/').date('m')."/".date('Y')?>">
                            Buat Slip Gaji
                            </a>

                            <a class="dropdown-item" id="Laporan_Gaji_page" href="<?=base_url("index.php/home/report_gaji")?>">
                            Data Slip Gaji
                            </a>
                        
                        </div>
                      </li>

                      <li class="nav-item dropdown mr-3" id="LI_Kasbon">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Kasbon" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Kasbon" onclick="aktifasi('Kasbon')">
                          Kasbon
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          
                            <a class="dropdown-item" id="Buat_Bon_page" href="<?=base_url("index.php/form/bon")?>">
                            Buat Nota Kasbon
                            </a>

                            <a class="dropdown-item" id="Bon_page" href="<?=base_url("index.php/home/bon")?>">
                            Data Nota Kasbon
                            </a>

                            <a class="dropdown-item" id="Laporan_Bon_page" href="<?=base_url("index.php/home/report_bon")?>">
                            Mutasi Kasbon Driver
                            </a>
                        
                        </div>
                      </li>

                      <li class="nav-item dropdown mr-3" id="LI_Konfigurasi">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-target="#Konfigurasi" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-controls="Konfigurasi" onclick="aktifasi('Konfigurasi')">
                        Sistem dan Konfigurasi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          
                            <a class="dropdown-item" id="Akun_page" href="<?=base_url("index.php/home/akun")?>">
                            Data Akun
                            </a>
                        
                        </div>
                      </li>

                    </ul>  
                    <ul class="navbar-nav ml-auto ">
                      <!-- Nav Item - User Information -->
                      <li class="nav-item dropdown no-arrow">
                          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="mr-2 d-none d-lg-inline small"><strong><?= $_SESSION["user"]?></strong></span>
                              <i class="fas fa-user-friends"></i>
                          </a>
                          <!-- Dropdown - User Information -->
                          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in "
                              aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popup-ubah-password">
                                  <i class="fas fa-key mr-2 text-gray-400"></i>
                                  Ubah Password
                              </a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Keluar
                              </a>
                          </div>
                      </li>
                    </ul>  
                  </div>
                </nav>
                <!-- End of Topbar -->

<script>
    function asd(){
        var page = '<?= $page?>';
        $("#"+page).addClass("active");
        var collapse_group = '<?= $collapse_group?>';
        $("#"+collapse_group).addClass("show");
        // var konfigurasi = <?= $akun_akses["akun_akses"]?>;
        var konfigurasi_page = <?= $akun_akses["akses"]?>;
        var page = ["x","JO_page","Konfirmasi_JO_page","Invoice_page","Invoice_Customer_page","Bon_page","Gaji_page",
        "Laporan_page","Laporan_Uang_Jalan_page","Laporan_Gaji_page","Laporan_Bon_page","Akun_page","Saldo_Bon_Page",
        "Buat_Bon_page","Buat_JO_page","DB_Izin_page","DB_Operasional_page","DB_Invoice_page"];
        if(konfigurasi_page[0]==0){
            $("#HR_Master_Data").hide();
            $("#LI_Master_Data").hide();
        }
        if(konfigurasi_page[15]==0 && konfigurasi_page[16]==0 && konfigurasi_page[17]==0){
            $("#HR_Dashboard").hide();
            $("#LI_Dashboard").hide();
        }
        if(konfigurasi_page[14]==0 && konfigurasi_page[1]==0 && konfigurasi_page[2]==0){
            $("#HR_Job_Order").hide();
            $("#LI_Job_Order").hide();
        }
        if(konfigurasi_page[5]==0 && konfigurasi_page[10]==0 && konfigurasi_page[13]==0){
            $("#HR_Kasbon").hide();
            $("#LI_Kasbon").hide();
        }
        if(konfigurasi_page[3]==0 && konfigurasi_page[4]==0){
            $("#HR_Invoice").hide();
            $("#LI_Invoice").hide();
        }
        if(konfigurasi_page[6]==0 && konfigurasi_page[9]==0){
            $("#HR_Penggajian").hide();
            $("#LI_Penggajian").hide();
        }
        if(konfigurasi_page[11]==0){
            $("#HR_Konfigurasi").hide();
            $("#LI_Konfigurasi").hide();
        }
        for(i=0;i<konfigurasi_page.length;i++){
            if(konfigurasi_page[i]==0){
                $("#"+page[i]).hide();
            }
        }
    }
    function aktifasi(x){
        var collapse_group = ["Master_Data","Job_Order","Invoice","Penggajian","Kasbon","Laporan","Konfigurasi","Dashboard"];
        for(i=0;i<collapse_group.length;i++){
            if(x!=collapse_group[i]){
                $("#"+collapse_group[i]).removeClass("show");
            }
        }
    }
</script>
