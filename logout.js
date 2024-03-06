function logout() {
  swal({
    title: "Are you sure?",
    text: "to Leave this Page ??",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willOut) => {
    if (willOut) {
      window.location = "logout.php";
    } else {
      console.log("NaN");
    }
  });
}
