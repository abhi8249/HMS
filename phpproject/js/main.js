function sweetAlert(msg = '', status = 'success') {
    Swal.fire({
        title: status.charAt(0).toUpperCase() + status.slice(1), // Capitalize the status
        text: msg,
        icon: status,
        confirmButtonText: 'Ok'
    });
}

$(document).on('click','#logout',function(){
    $.ajax({
        url: 'include/ajax/login.php',
        type: 'POST',
        data: {'type':'logout'},
        success: function(data) {
            location.reload();
        }

    })
})

