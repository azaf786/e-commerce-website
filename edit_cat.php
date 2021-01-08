<?php
include 'headerZashas2.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!isset($_SESSION['loggedIn']))
{
    echo "You are not logged in.";
}
else
{
    if($_SESSION['username'] == 'admin') {

        $sql = "SELECT * FROM category";
        $res = mysqli_query($connection, $sql);

        $n = mysqli_num_rows($res);

        echo <<<_END
        <html>
<head>
    <title>CRUD Category</title>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/main1.css">
    <style>
        .box
        {
            width:1270px;
            padding:20px;
            background-color:#fff;
            border:1px solid #ccc;
            border-radius:5px;
            margin-top:25px;
            box-sizing:border-box;
        }
    </style>
</head>
<body>
<div class="container box">
    <h1 align="center">CRUD Main Category</h1>
    <br/>

    <div class="table-responsive">
        <br/>
        <div align="right">
            <button type="button" name="add" id="add" class="btn btn-info"> <i class="fas fa-plus"></i> Insert Category</button>
        </div>
        <br />
        <div id="alert_message"></div>
        <table id="user_data" class="table table-bordered table-striped">
            <thead>

            <tr>
                <th>Category Id</th>
                <th>Category Title</th>
                <th>Sub Category</th>
                <th>Sub Sub Category</th>
                <th>Delete Category</th>
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
                        <h2 class="modal-title"> Update Category</h2>
                    </div>
                    <div class="modal-body">
                        <input type="text" class = "form-control" placeholder="Category Id" id="cat_id" disabled>
                        <br>
                        <input type="text" class = "form-control" placeholder="Category Title" id="cat_title">
                        <br>
                        <input type="text" class = "form-control" placeholder="Sub Category" id="sub_cat">
                        <br>
                        <input type="text" class = "form-control" placeholder="Sub-Sub Category" id="sub_sub_cat">
                        <br>
                        <input type="hidden" id="editingCatID" value="0">
                </div>
                <div class="modal-footer">
                        <input type="button" id="updateButton"  value="Update" class="btn btn-success">
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
                'serverMethod': 'post',
                "order" : [],
                "ajax" : {
                    url:"retrieve.php",
                    type:"POST"
                }
            });
        }

        $('#add').click(function(){
            var html = '<tr>';
            html += '<td></td>';
            html += '<td><input contenteditable="true" id="data1" type="text" placeholder="category title"></td>';
            html += '<td><input contenteditable="true" id="data2" type="text" placeholder="sub category"></td>';
            html += '<td><input contenteditable="true" id="data3" type="text" placeholder="sub-sub category"></td>';
            html += '<td></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#user_data tbody').prepend(html);
        });

        $(document).on('click', '#insert', function(){
            var cat_title = $('#data1').val();
            var sub_cat = $('#data2').val();
            var sub_sub_cat = $('#data3').val();
            if(cat_title != '' && sub_cat != '' && sub_sub_cat != '')
            {
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:{cat_title:cat_title, sub_cat:sub_cat, sub_sub_cat: sub_sub_cat},
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
                    url:"delete.php",
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
            $('#editingCatID').val($(this).data("id3"));
              $.ajax({
                url: 'update.php',
                method: 'POST',
                dataType: 'json',
                data: {id: $(this).data("id3")},
                success: function(response) 
                {
                  $('#cat_id').val(response.cat_id);
                  $('#cat_title').val(response.cat_title);
                  $('#sub_cat').val(response.sub_cat);
                  $('#sub_sub_cat').val(response.sub_sub_cat);
                  $("#tableManager").modal('show');
                }
                
              });
            
        });
         
         $(document).on('click', '#updateButton', function(){
             $.ajax({
                url: 'updateCat.php',
                method: 'POST',
                dataType: 'text',
                data: 
                {
                    id: $('#cat_id').val(),
                    cat_title: $("#cat_title").val(),
                    sub_cat: $("#sub_cat").val(),
                    sub_sub_cat: $("#sub_sub_cat").val()
                },
                success: function() 
                {
                   $("#tableManager").modal('hide');
                   $('#user_data').DataTable().destroy();
                   fetch_data();
                }
            });
         });
    });
    </script>
_END;
    }
}
?>