<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <!-- Modal -->
        <?php
        include("../config/connection.php");

        $query = mysqli_query($conn, "SELECT * FROM tbl_kehadiran WHERE user_id = '" . $_SESSION['user_id'] . "' and created_date = '" . date('Y-m-d') . "'");
        $cek = mysqli_num_rows($query);
        $attendance = mysqli_fetch_array($query);
        if (isset($attendance['status'])) {
            if ($attendance['status'] == "checkin") { ?>
                <div class="form-element py-30 multiple-column">
                    <h4 class="font-20 mb-20">Checkin Detail</h4>
                    <!-- Form -->
                    <form onsubmit="return checkout(event)" method="POST">

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">Your Name</label>
                                    <input type="text" class="theme-input-style" placeholder="Type Your Name" value="<?php echo $_SESSION['name'] ?>" disabled>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">NIK</label>
                                    <input type="text" class="theme-input-style" placeholder="Your NIK" value="<?php echo $_SESSION['nik']; ?>" disabled>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">Company</label>
                                    <input type="text" class="theme-input-style" placeholder="Company Name" value="PT. Jasamarga">
                                </div>
                                <!-- End Form Group -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">Jadwal Shift</label>
                                    <input type="text" class="theme-input-style" placeholder="Contact Number" value="<?php echo $attendance['pilih_jadwal'] ?>">
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">Jenis Operasi</label>
                                    <input type="text" class="theme-input-style" value="<?php echo $attendance['operasi'] ?>">
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label class="font-14 bold mb-2">Status</label>
                                    <input type="text" class="theme-input-style" placeholder="Address" value="on going">
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>


                        <!-- End Form Row -->

                        <!-- Form Row -->
                        <div class="form-row">
                            <div class="col-12 text-left">
                                <button type="submit" class="btn long">Check Out</button>
                            </div>
                        </div>
                        <!-- End Form Row -->
                    </form>
                    <!-- End Form -->
                </div>
            <?php
            } else if ($attendance['status'] == "checkout") { ?><div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrModalLabel">Scan QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="scanner-container" width="400px"></div>
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
                                    <input type="radio" id="operasi" name="operasi" value="operasional" checked>
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
                </div> <?php }
                } else {

                        ?><div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrModalLabel">Scan QR Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="scanner-container" width="400px"></div>
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
                                <input type="radio" id="operasi" name="operasi" value="operasional" checked>
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
            </div><?php } ?>

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
        var expectedLongitude = 106.84513; // Ganti dengan longitude yang diharapkan
        var expectedLatitude = -6.21462; // Ganti dengan latitude yang diharapkan
        var tolerance = 0.1; // Toleransi untuk perbandingan
        if (document.getElementById("longitude") && document.getElementById('latitude')) {
            document.getElementById("longitude").value = longitude;
            document.getElementById("latitude").value = latitude;
            document.getElementById("btn-check").disabled = false;
            if (Math.abs(longitude - expectedLongitude) <= tolerance && Math.abs(latitude - expectedLatitude) <= tolerance) {
                document.getElementById("btn-check").disabled = false;
            } else {
                document.getElementById("btn-check").disabled = true;
                swal({
                    title: "Location Mismatch",
                    text: "You are not at the expected location.",
                    icon: "error",
                });
            }
        }

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

    // Show the QR code scanner when the "Check In" button is clicked
    async function checkin(e) {
        e.preventDefault();

        let myModal = new bootstrap.Modal(document.getElementById('qrModal'));
        myModal.show();


        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                var cameraId = devices[0].id;
                const html5QrCode = new Html5Qrcode("scanner-container");

                html5QrCode.start(
                    cameraId, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    async (decodedText, decodedResult) => {
                            console.log('Scan successful:', decodedText, decodedResult);

                            // Define the expected QR code text
                            const expectedText = "jasamarga_checkin";

                            if (decodedText === expectedText) {
                                html5QrCode.stop();
                                let selectedShift = document.querySelector('input[name="shift-group"]:checked').id;
                                let selectedOperasi = document.querySelector('input[name="operasi"]:checked').value;
                                console.log(selectedShift + ' ' + selectedOperasi);
                                $('#qrModal').modal('hide');

                                // Call the checkin function
                                const checkinStatusResponse = await fetch("api.php?act=checkin_status", {
                                    method: 'GET',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                });
                                const checkinStatusData = await checkinStatusResponse.json();

                                if (checkinStatusData.status === "checked_in") {
                                    // User has already checked in today, show alert
                                    swal({
                                        title: "Already Checked In",
                                        text: "You have already checked in today.",
                                        icon: "warning",
                                    });
                                    return; // Stop further execution
                                } else {
                                    let url = "api.php?act=insert_kehadiran";
                                    await fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: new URLSearchParams({
                                            operasi: selectedOperasi,
                                            longitude: document.getElementById("longitude").value,
                                            latitude: document.getElementById("latitude").value,
                                            'pilih_jadwal': selectedShift
                                        })
                                    }).then(response => response.json()).then(data => {
                                        console.log(data?.status);
                                        if (data?.status == "success") {
                                            window.location.href = "dashboard";
                                        } else {
                                            swal({
                                                title: "Checkin Failed",
                                                text: data?.status,
                                                icon: "error",
                                            });
                                        }
                                    });
                                }

                            } else {
                                swal({
                                    title: "Invalid QR Code",
                                    text: "The scanned QR code is not valid.",
                                    icon: "error",
                                });
                            }
                        },
                        (errorMessage) => {
                            // console.warn(`Code scan error = ${errorMessage}`);
                        }
                ).catch((err) => {
                    // console.warn(`Code scan error = ${err}`);
                });
            }
        }).catch(err => {
            console.warn(`Error getting cameras: ${err}`);
        });
    }

    function checkout(e) {
        e.preventDefault();
        swal({
                title: "Checkout",
                text: "Are you sure to checkout?",
                icon: "warning",
                buttons: {
                    cancel: "No",
                    confirm: "Yes"
                },
            })
            .then((willContinue) => {
                if (willContinue) {
                    // Melanjutkan aksi
                    fetch("api.php?act=update_kehadiran", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            status: "checkout"
                        })
                    }).then(response => response.json()).then(data => {
                        console.log(data?.status);
                        if (data?.status == "success") {
                            window.location.href = "check-in";
                        } else {
                            swal({
                                title: "Checkout Failed",
                                text: data?.status,
                                icon: "error",
                            }).then(function() {});
                        }
                    });
                }
            });
    }

    // function autoCheckout() {
    //     fetch("api.php?act=check_attendance", {
    //         method: 'GET',
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded'
    //         }
    //     }).then(response => response.json()).then(data => {
    //         if (data?.status == 'found') {
    //             let checkinDate = new Date(data.created_date);
    //             let now = new Date();
    //             if (checkinDate.getDate() !== now.getDate()) {
    //                 fetch("api.php?act=update_kehadiran", {
    //                     method: 'POST',
    //                     headers: {
    //                         'Content-Type': 'application/x-www-form-urlencoded'
    //                     },
    //                     body: new URLSearchParams({
    //                         status: "checkout"
    //                     })
    //                 }).then(response => response.json()).then(data => {
    //                     console.log(data?.status);
    //                     if (data?.status == "success") {
    //                         localStorage.setItem('lastCheckedDate', now.toISOString());
    //                     }
    //                 });
    //             }
    //         }
    //     });
    // }

    // window.addEventListener('DOMContentLoaded', (event) => {
    //     autoCheckout();
    //     setInterval(autoCheckout, 60 * 1000); // Check every minute
    // });
</script>
<?php include('../layouts/footer.php') ?>