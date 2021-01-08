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
        $sql = "SELECT * FROM customer";
        $res = mysqli_query($connection, $sql);
        $n = mysqli_num_rows($res);
        ?>
        <html>
        <head>
            <title>CRUD USERS</title>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/main1.css">
            <style>
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
            <h1 align="center">CRUD Users</h1>
            <br/>

            <div class="table-responsive">
                <br/>
                <div align="right">
                    <button type="button" name="add" id="add" class="btn btn-info"><i class="fas fa-user-plus"></i>Add User</button>
                </div>
                <br />
                <div id="alert_message"></div>
                <table id="user_data" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                        <th>Customer Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Telephone Number</th>
                        <th>Address Id</th>
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>City</th>
                        <th>Postcode</th>
                        <th>Address Country</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Date Of Birth</th>
                        <th>Verified</th>
                        <th>Password</th>
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
                        <h2 class="modal-title"> Update User</h2>
                    </div>
                    <div class="modal-body">
                        <input type="number" class = "form-control" placeholder="Customer Id" id="cust_id" disabled>
                        <br>
                        <input type="text" class = "form-control" placeholder="First Name" id="firstName">
                        <br>
                        <input type="text" class = "form-control" placeholder="Last Name" id="lastName">
                        <br>
                        <input type="text" class = "form-control" placeholder="Contact Number" id="tele_no">
                        <br>
                        <input type="number" class = "form-control" placeholder="Address Id" id="addr_id">
                        <br>
                        <input type="email" class = "form-control" placeholder="Email" id="email">
                        <br>
                        <input type="date" class = "form-control" placeholder="Date of Birth" id="dob">
                        <br>
                        <input type="text" class = "form-control" placeholder="Username" id="username">
                        <br>
                        <span>Verification Status: </span><input type="text" class = "form-control" placeholder="verified" id="verified" disabled>
                        <div class="form-group">
                        <select class="custom-select" id="verified1">
                            <option disabled>Please Choose</option>
                            <option id="verified1">0</option>
                            <option id="verified1">1</option>
                        </select>
                        </div>
                        <br>
                        <input type="text" class = "form-control" placeholder="Address Line 1" id="addr_ln1">
                        <br>
                        <input type="text" class = "form-control" placeholder="Address Line 2" id="addr_ln2">
                        <br>
                        <input type="text" class = "form-control" placeholder="City" id="addr_city">
                        <br>
                        <input type="text" class = "form-control" placeholder="Country" id="addr_country">
                        <br>
                        <input type="text" class = "form-control" placeholder="Postcode" id="addr_postcode">
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
                    var dataTable = $('#user_data').DataTable({
                        "processing" : true,
                        "serverSide" : true,
                        "paging": false,
                        "status": false,
                        "order" : [],
                        "ajax" : {
                            url:"retrieveUsers.php",
                            type:"POST"
                        }
                    });
                }

                $('#add').click(function(){
                    var html = '<tr>';
                    html +=  '<td></td>';
                    html +=  '<td><input contenteditable="true" placeholder="first name" id="data1" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="last name" id="data2" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="contact number" id="data3" type="number"></td>';
                    html +=  '<td></td>';
                    html +=  '<td><input contenteditable="true" placeholder="address line 1" id="data4" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="address line 2" id="data5" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="city" id="data6" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="postcode" id="data7" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="country" id="data8" type="text"></td>';
                    html +=  '<td><input contenteditable="true" placeholder="username" id="data9" type="text"></td>';
                    html +=  '<td><input contenteditable="true" id="data10" placeholder="@email.com" type="email"></td>';
                    html +=  '<td><input contenteditable="true" id="data11" type="date"></td>';
                    html +=  '<td ><select  class="custom-select" required><option id="data12">0</option><option id="data12">1</option></select></td>';
                    html +=  '<td><input contenteditable="true" placeholder="password" id="data13" type="text"></td>';
                    html +=  '<td></td>';
                    html +=  '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs"><i class="fas fa-plus-circle"></i> Insert</button></td>';
                    html +=  '</tr>';
                    $('#user_data tbody').prepend(html);
                });

                $(document).on('click', '#insert', function(){
                    var firstName = $('#data1').val();
                    var lastName = $('#data2').val();
                    var tele_no = $('#data3').val();
                    var addr_ln1 = $('#data4').val();
                    var addr_ln2 = $('#data5').val();
                    var addr_city = $('#data6').val();
                    var addr_postcode = $('#data7').val();
                    var addr_country = $('#data8').val();
                    var username = $('#data9').val();
                    var email = $('#data10').val();
                    var dob = $('#data11').val();
                    var verified = $('#data12').text();
                    var password = $('#data13').val();
                    if(firstName != '' && lastName != '' && tele_no != '' && email != '' && dob != '' && username != '' && verified != ''
                        && addr_ln1 != '' && addr_ln2 != '' && addr_city != '' && addr_country != '' && addr_postcode != '' && password != '')
                    {
                        $.ajax({
                            url:"insert_user.php",
                            method:"POST",
                            data:{firstName:firstName, lastName:lastName, tele_no:tele_no, email:email, dob:dob, username:username,
                                verified:verified, addr_ln1:addr_ln1, addr_ln2:addr_ln2, addr_city:addr_city, addr_country:addr_country, addr_postcode:addr_postcode, password:password},
                            success:function(data)
                            {
                                $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                                $('#user_data').DataTable().destroy();
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
                                $('#user_data').DataTable().destroy();
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

                $(document).on('click', '#updateButton', function(){
                    $.ajax({
                        url: 'updateUsers.php',
                        method: 'POST',
                        dataType: 'text',
                        data:
                            {
                                id: $('#editingUserID').val(),
                                firstName: $('#firstName').val(),
                                lastName: $('#lastName').val(),
                                tele_no: $('#tele_no').val(),
                                email: $('#email').val(),
                                dob: $('#dob').val(),
                                username: $('#username').val(),
                                verified: $('#verified1').val(),
                                addr_ln1: $("#addr_ln1").val(),
                                addr_ln2: $("#addr_ln2").val(),
                                addr_city:$("#addr_city").val(),
                                addr_country:$("#addr_country").val(),
                                addr_postcode:$("#addr_postcode").val()
                            },
                        success: function(data)
                        {
                            $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                            $("#tableManager").modal('hide');
                            $('#user_data').DataTable().destroy();
                            fetch_data();
                        }
                    });
                    setInterval(function(){
                        $('#alert_message').html('');
                    }, 5000);
                });
            });
        </script>

        <?php
    }

}

