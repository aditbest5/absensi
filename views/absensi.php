<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">Scan QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="scanner-container"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-element py-30 vertical-form mb-30">
            <h4 class="font-20 mb-30">Check In Kehadiran</h4>
            <!-- Form -->
            <form onsubmit="return checkin(event)" method="POST">

                <!-- Form Group -->
                <div class="form-group">
                    <label class="font-14 bold mb-2">Nama Lengkap</label>
                    <input type="text" value="<?php echo $_SESSION['name']; ?>" class="theme-input-style" placeholder="Type Your Name" disabled>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group">
                    <label class="font-14 bold mb-2">NIK</label>
                    <input type="number" value="<?php echo $_SESSION['nik']; ?>" class="theme-input-style" placeholder="Type Email Address" disabled>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group">
                    <label class="font-14 bold mb-2">Tanggal</label>
                    <input type="dater" value="<?php echo date("d/m/Y") ?>" class="theme-input-style" placeholder="Contact Number">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group">
                    <label class="font-14 bold mb-2">Pilih Operasi</label>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="operasi" name="operasi" checked>
                            <label for="operasi"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="operasi">Operasional</label>
                    </div>
                </div>
                <!-- End Form Group -->
                <div class="form-group">
                    <label class="font-14 bold mb-2">Pilih Jadwal</label>
                    <div class="">
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="shift1" name="shift-group" checked>
                                <label for="shift1"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="shift">SHIFT 1: 06:00 s/d 14:00</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="shift2" name="shift-group">
                                <label for="shift2"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="shift2">SHIFT 2: 14:00 s/d 21:00</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="shift3" name="shift-group">
                                <label for="shift3"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="shift3">SHIFT 3: 21:00 s/d 06:00</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="longitude" class="font-14 bold mb-2">Longitude</label>
                        <input type="number" id="longitude" name="longitude" class="theme-input-style" placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="latitude" class="font-14 bold mb-2">Latitude</label>
                        <input type="number" id="latitude" name="latitude" class="theme-input-style" placeholder="" disabled>
                    </div>
                </div>


                <!-- Form Group -->
                <div class="form-row">
                    <div class="col-12 text-left">
                        <button type="submit" id="btn-check" class="btn long" data-bs-toggle="modal" data-bs-target="#qrModal" disabled>Check In</button>
                    </div>
                </div>
                <!-- End Form Group -->
            </form>
            <!-- End Form -->
        </div>


    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        getLocation();
    });

    function getLocation() {
        if (navigator.geolocation) {
            let navigation = navigator.geolocation.getCurrentPosition(showPosition, errorCallback);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        var longitude = position.coords.longitude;
        var latitude = position.coords.latitude;
        document.getElementById("longitude").value = longitude;
        document.getElementById("latitude").value = latitude;
        document.getElementById("btn-check").disabled = false;
    }

    function showQRScanner() {
        // Mendapatkan elemen container scanner
        var scannerContainer = document.getElementById("scanner-container");

        // Menghapus konten sebelumnya jika ada
        scannerContainer.innerHTML = "";

        // Membuat elemen video untuk menampilkan output scanner
        var videoElement = document.createElement("video");
        videoElement.setAttribute("id", "scanner-video");
        scannerContainer.appendChild(videoElement);

        // Memulai QuaggaJS
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.getElementById('scanner-video'),
                constraints: {
                    facingMode: "environment" // Menggunakan kamera belakang (jika ada)
                }
            },
            decoder: {
                readers: ["qrcode"] // Menggunakan pembaca QR code
            }
        }, function(err) {
            if (err) {
                console.error(err);
                alert('Error accessing camera.');
                return;
            }
            Quagga.start();
        });

        // Mendeteksi hasil pemindaian QR code
        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;
            alert('Scanned: ' + code);
            // Di sini Anda bisa melakukan apa yang Anda inginkan dengan hasil pemindaian, misalnya mengirimkannya ke server.
        });
    }

    function errorCallback(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                swal({
                    title: "Warning",
                    text: "Please Allow Location First!",
                    icon: "warning",
                }).then(function() {});
                break;
            case error.POSITION_UNAVAILABLE:
                swal({
                    title: "Error",
                    text: "Location information is unavailable.",
                    icon: "error",
                }).then(function() {});
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    function checkin(e) {
        e.preventDefault();
        let myModal = new bootstrap.Modal(document.getElementById('qrModal'));
        myModal.show();

        // Menampilkan QR scanner di dalam modal
        showQRScanner();

    }
</script>
<?php include('../layouts/footer.php') ?>