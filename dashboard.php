 <?php include('layouts/header.php') ?>
 <div class="main-content">
     <div class="card mb-3 h-100">
         <div class="card-body text-center">
             <h3 class="mt-4">Selamat Datang, <?php echo $_SESSION['name'] ?> !</h3>\
             <h4 class="">Jangan Lupa Absen!</h4>
         </div>
         <div class="card-footer">
             <marquee behavior="scroll" direction="left" id="running-text">
                 <?php echo date('l, d F Y H:i') ?> WIB
             </marquee>
         </div>
     </div>
 </div>
 <script>
     // Fungsi untuk mengupdate teks berjalan dengan tanggal dan waktu saat ini di WIB
     function updateRunningText() {
         var runningText = "<?php echo date('l, d F Y H:i') ?> WIB";
         document.getElementById("running-text").innerText = runningText;
     }

     // Memanggil fungsi updateRunningText setiap detik (1000 milidetik)
     setInterval(updateRunningText, 1000);

     // Memanggil fungsi untuk pertama kali saat halaman dimuat
     updateRunningText();
 </script>
 <?php include('layouts/footer.php') ?>