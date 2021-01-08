<?php
include 'credentials.php';
require('headerZashas2.php');

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//session_start();
if (!isset($_SESSION['loggedIn']))
{
    echo "You are not logged in.";
}
else
{
    if($_SESSION['username'] == 'admin') {
        $sql = "SELECT * FROM products";
        $res = mysqli_query($connection, $sql);
        $n = mysqli_num_rows($res);
        ?>
        <html>
        <head>
            <title>CRUD Products</title>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/main1.css"><style>
                .box
                {
                    position:absolute;
                    left:0;
                    right:0;
                    width:100%;
                    padding:2px;
                    background-color:#fff;
                    border:1px solid #ccc;
                    border-radius:5px;
                    margin-top:20px;
                }
            </style>
        </head>
        <body>
        <div class="container box">
            <h1 align="center">CRUD Products</h1>
            <br/>

            <div class="table-responsive">
                <br/>
                <div align="right">
                    <a href="insert_prod.php" type="button" id="add" class="btn btn-info"><i class="fas fa-plus"></i> Add Product</a>
                </div>
                <br />
                <div id="alert_message"></div>
                <table id="product_data" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                        <th>Product Id</th>
                        <th>Product Title</th>
                        <th>Product Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div id="tableManager" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title"> Update Product</h2>
                    </div>
                    <div class="modal-body">
                        <input type="number" class = "form-control" placeholder="Product Id" id="prod_id" disabled>
                        <br>
                        <input type="text" class = "form-control" placeholder="Product Title" id="prod_title">
                        <br>
                        <input type="text" class = "form-control" placeholder="Prod Description" id="prod_dscr">
                        <br>
                        <input type="text" class = "form-control" placeholder="Price" id="price">
                        <br>
                        <input type="number" class = "form-control" placeholder="Quantity" id="prod_qty">
                        <br>
                        <input type="hidden" id="editingUserID" value="0">
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="updateButton"  value="Update" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"> </script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        </body>
        </html>

        <script type="text/javascript" language="javascript" >
            $(document).ready(function(){

                fetch_data();
                function fetch_data()
                {
                    var dataTable = $('#product_data').DataTable({
                        "processing" : true,
                        "serverSide" : true,
                        "paging": false,
                        "status": false,
                        "order" : [],
                        "ajax" : {
                            url:"retrieveProducts.php",
                            type:"POST"
                        }
                    });
                }

                $(document).on('click', '#insert', function(){
                    var prod_title = $('#data1').val();
                    var prod_dscr = $('#data2').val();
                    var price = $('#data3').val();
                    var prod_qty = $('#data4').val();

                    if(prod_title != '' && prod_dscr != '' && price != '' && prod_qty != '')
                    {
                        $.ajax({
                            url:"insert_product.php",
                            method:"POST",
                            data:{prod_title:prod_title, prod_dscr:prod_dscr, price:price, prod_qty:prod_qty},
                            success:function(data)
                            {
                                $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                                $('#product_data').DataTable().destroy();
                                fetch_data();
                            }
                        });
                        setInterval(function(){
                            $('#alert_message').html('');
                        }, 5000);
                    }
                    else
                    {
                        alert("All Fields are required");
                    }
                });

                $(document).on('click', '.delete', function(){
                    var id = $(this).data("id3");
                    if(confirm("Are you sure you want to remove this?"))
                    {
                        $.ajax({
                            url:"deleteUser.php",
                            method:"POST",
                            data: { id : id},
                            success:function(data){
                                $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                                $('#product_data').DataTable().destroy();
                                fetch_data();
                            }
                        });
                        setInterval(function(){
                            $('#alert_message').html('');
                        }, 5000);
                    }
                });

                $(document).on('click', '.update', function(){
                    $('#editingUserID').val($(this).data("id3"));
                    $.ajax({
                        url: 'updateUser.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {id: $(this).data("id3")},
                        success: function(response)
                        {
                            $('#cust_id').val(response.cust_id);
                            $('#firstName').val(response.firstName);
                            $('#lastName').val(response.lastName);
                            $('#tele_no').val(response.tele_no);
                            $('#addr_id').val(response.addr_id);
                            $('#email').val(response.email);
                            $('#dob').val(response.dob);
                            $('#username').val(response.username);
                            $('#verified').val(response.verified);
                            $('#addr_ln1').val(response.addr_ln1);
                            $('#addr_ln2').val(response.addr_ln2);
                            $('#addr_city').val(response.addr_city);
                            $('#addr_country').val(response.addr_country);
                            $('#addr_postcode').val(response.addr_postcode);
                            $("#tableManager").modal('show');
                        }
                    });
                });

                $(document).on("click", ".browse", function() {
                    var file = $(this)
                        .parent()
                        .parent()
                        .parent()
                        .find(".file");
                    file.trigger("click");
                });
                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#file").val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("preview").src = e.target.result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });
                });

            $('#image_form').submit(function(event){
                event.preventDefault();
                var image_name = $('#image').val();
                if(image_name == '')
                {
                    alert("Please Select Image");
                    return false;
                }
                else
                {
                    var extension = $('#image').val().split('.').pop().toLowerCase();
                    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert("Invalid Image File");
                        $('#image').val('');
                        return false;
                    }
                    else
                    {
                        $.ajax({
                            url:"action.php",
                            method:"POST",
                            data:new FormData(this),
                            contentType:false,
                            processData:false,
                            success:function(data)
                            {
                                alert(data);
                                fetch_data();
                                $('#image_form')[0].reset();
                                $('#imageModal').modal('hide');
                            }
                        });
                    }
                }
            });

                // $(document).on('click', '#updateImages', function(){
                //     $.ajax({
                //         url: 'updateImages.php',
                //         method: 'POST',
                //         data:
                //             {
                //                 id: $('#editingUserID').val(),
                //                 imageId: $('#imageId').val(),
                //                 file: "files[]"
                //             },
                //         success: function(data)
                //         {
                //             $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                //             $("#tableImages").modal('hide');
                //             $('#product_data').DataTable().destroy();
                //             fetch_data();
                //         },
                //         cache: false,
                //         contentType: false,
                //         processData: false
                //     });
                //     setInterval(function(){
                //         $('#alert_message').html('');
                //     }, 5000);
                // });

                $(document).on('click', '#but_upload', function(){
                    $("#msg").html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please wait...!</div>');
                    $.ajax({
                        type: "POST",
                        url: "updateImages.php",
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function(data) {
                            if (data == 1 || parseInt(data) == 1) {
                                $("#msg").html(
                                    '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Data updated successfully.</div>'
                                );
                            } else {
                                $("#msg").html(
                                    '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Extension not good only try with <strong>GIF, JPG, PNG, JPEG</strong>.</div>'
                                );
                            }
                        },
                        error: function(data) {
                            $("#msg").html(
                                '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong.</div>'
                            );
                        }
                    });
                });

        </script>

        <?php
    }
    else{
        echo"You do not have permission to access this page.";
    }

}

