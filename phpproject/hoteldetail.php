<?php
include 'include/function.php';
checkLoginAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <?php include './screen/link.php' ?>
</head>
</head>
<body>
    <?php include 'screen/navbar.php';?>
  <div class="container herocontainer">
    <div class="left">
        <h4>Hotel Details</h4>
    </div>
    <div class="right">
      
<button type="button" class="btn bg-danger bg-gradient rightsideherobtn" data-bs-toggle="modal" id="addHotelmodal" data-bs-target="#exampleModal">
  Add
</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header" id="modalheader">

            </div>
            <div class="modal-body" id="modalbody">
            
            </div>
            <div class="modal-footer" id="modalfooter">
  
            </div>
            </div>
        </div>
            </div>
            </div>
  </div>
   <div class="container">
    <div id="hoteldetailscont">

    </div>
   </div>
<script>

$(document).ready(function() {
    loadHotelDetails();
    $(document).on('click','#addHotelmodal',function(){
        var modalheaderhtml= `<h1 class="modal-title fs-5">Add Hotel</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`;
        $('#modalheader').html(modalheaderhtml);

        var html = `<form id="addHotelForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name"> Name</label>
                                        <input name="name" id="name" type="text" class="form-control" value="" required="">
                                    </div>                                 
                                </div>
                       
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="address"> Address</label>
                                        <input name="address" id="address" type="text" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="description"> Description</label>
                                        <input name="description" id="description" type="text" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                             
                            </form>`;
    
     
        $('#modalbody').html(html);
        
        var modalfooter = `              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitNewHotel">ADD </button>`;
                $('#modalfooter').html(modalfooter);
    });

    $(document).on('click','#submitNewHotel',function(e){
        e.preventDefault();
            var formData = $('#addHotelForm').serialize(); 
            formData += '&type=addnewHotel'; 
            $.ajax({
                url: 'include/ajax/hotel.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    var res = JSON.parse(response);
                    console.log(res.status);
                    if(res.status === '1'){ 
                        console.log('ok');
                        sweetAlert(res.msg,'success'); 
                        loadHotelDetails();
                    }
                    else{
                        console.log('no');
                        sweetAlert(res.msg,'error');
                    }              
                },
                error: function(xhr, status, error) {
                    console.log(error); 
                }
            });
    });

    $(document).on('click', '#updateIcon', function() {
     var id = $(this).data('id');
        var data = {
            'type': 'getSingleHotelDetails',
            'id': id
        };
        $.ajax({
            url: 'include/ajax/hotel.php',
            type: 'POST',
            data: data,
            success: function(response) {
                var list = JSON.parse(response);

                $.each(list, function(index, item){
                var modalheaderhtml = `<h1 class="modal-title fs-5">Update Hotel</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`;
                $('#modalheader').html(modalheaderhtml);

                var html = `<form id="updateHotelForm" enctype="multipart/form-data">
                <input type="text" value="${item.id}" name ="id" hidden />
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" type="text" class="form-control" value="${item.name}" required="">
                                    </div>                                 
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="address">Address</label>
                                        <input name="address" id="address" type="text" class="form-control" value="${item.address}" required="">
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="description">Description</label>
                                        <input name="description" id="description" type="text" class="form-control" value="${item.description}" required="">
                                    </div>                                   
                                </div>
                            </form>`;

                $('#modalbody').html(html);

                var modalfooter = `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-id="${item.id}" id="updateHotel">Update</button>`;
                $('#modalfooter').html(modalfooter);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click','#updateHotel',function(){

        var formData = $('#updateHotelForm').serialize();
        formData += '&type=updateHotelForm'; 
        $.ajax({
            url:'include/ajax/hotel.php',
            type:'POST',
            data:formData,
            success:function(data){
                var res = JSON.parse(data);
                if(res.status =='1'){
                    sweetAlert(res.msg,'success');
                    loadHotelDetails();
                    
                }else{
                    sweetAlert(res.msg,'error');
                }
            },
            error: function(error){
                sweetAlert(error,'error');
            }
        })
    });


    $(document).on('click', '#deleteIcon', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete this hotel detail!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = {
                'type': 'deleteHotel',
                'id': id
            };

            $.ajax({
                url: 'include/ajax/hotel.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    var res = JSON.parse(data);
                    if (res.status == '1') {
                        sweetAlert(res.msg, 'success');
                        loadHotelDetails();
                    } else {
                        sweetAlert(res.msg, 'error');
                    }
                },
                error: function(error) {
                    sweetAlert(error, 'error');
                }
            });
        }
    });
});


});


function loadHotelDetails(){
    $.ajax({
        url:'include/ajax/hotel.php',
        type:'POST',
        data:{'type':'loadHotelDetails'},
        success:function(data){

            var list = JSON.parse(data);
            var html =`<table class="table table-dark table-striped">
                        <thead>
                            <tr>
                            <th scope="col">sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        `;
            $.each(list, function(index, item){
                var updatebtn = `<a class="update bg-gradient-info" id="updateIcon"  data-bs-toggle="modal" id="addHotelmodal" data-bs-target="#exampleModal" href="javascript:void(0)" data-id="${item.id}" data-tooltip-top="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                </svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a>
                `;
                var deletebtn =`<a class="delete" id="deleteIcon" style="cursor:pointer;" data-id="${item.id}"><svg  fill="red" style="color:red;" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="18px" height="18px" viewBox="0 0 482.428 482.429"
	 xml:space="preserve">
<g>
	<g>
		<path d="M381.163,57.799h-75.094C302.323,25.316,274.686,0,241.214,0c-33.471,0-61.104,25.315-64.85,57.799h-75.098
			c-30.39,0-55.111,24.728-55.111,55.117v2.828c0,23.223,14.46,43.1,34.83,51.199v260.369c0,30.39,24.724,55.117,55.112,55.117
			h210.236c30.389,0,55.111-24.729,55.111-55.117V166.944c20.369-8.1,34.83-27.977,34.83-51.199v-2.828
			C436.274,82.527,411.551,57.799,381.163,57.799z M241.214,26.139c19.037,0,34.927,13.645,38.443,31.66h-76.879
			C206.293,39.783,222.184,26.139,241.214,26.139z M375.305,427.312c0,15.978-13,28.979-28.973,28.979H136.096
			c-15.973,0-28.973-13.002-28.973-28.979V170.861h268.182V427.312z M410.135,115.744c0,15.978-13,28.979-28.973,28.979H101.266
			c-15.973,0-28.973-13.001-28.973-28.979v-2.828c0-15.978,13-28.979,28.973-28.979h279.897c15.973,0,28.973,13.001,28.973,28.979
			V115.744z"/>
		<path d="M171.144,422.863c7.218,0,13.069-5.853,13.069-13.068V262.641c0-7.216-5.852-13.07-13.069-13.07
			c-7.217,0-13.069,5.854-13.069,13.07v147.154C158.074,417.012,163.926,422.863,171.144,422.863z"/>
		<path d="M241.214,422.863c7.218,0,13.07-5.853,13.07-13.068V262.641c0-7.216-5.854-13.07-13.07-13.07
			c-7.217,0-13.069,5.854-13.069,13.07v147.154C228.145,417.012,233.996,422.863,241.214,422.863z"/>
		<path d="M311.284,422.863c7.217,0,13.068-5.853,13.068-13.068V262.641c0-7.216-5.852-13.07-13.068-13.07
			c-7.219,0-13.07,5.854-13.07,13.07v147.154C298.213,417.012,304.067,422.863,311.284,422.863z"/>
	</g>
</g>
</svg></a>`;
                html+= `    <tr>
                                <th style="width:15%;" scope="row">${index+1}</th>
                                <td style="width:20%;">${item.name}</td>
                                <td style="width:20%;">${item.address}</td>
                                <td style="width:20%;">${item.description}</td>
                                <td style="width:25%;">${updatebtn}${deletebtn}</td>
                            </tr>
                            `;
            });
            html+=`  </tbody>
                     </table>`;
                     $('#hoteldetailscont').html(html);
        }
    });
}
</script>
</body>
</html>