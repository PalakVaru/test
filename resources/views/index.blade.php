<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
    <h3 style="text-align:center;">User List</h3>
    <a href="{{ route('logout') }}" class="btn btn-primary" style="floar:right;"> logout</a>
    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered user_datatable" id="user_table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Profile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>    
            </div>
        </div>
    </div>    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $("#user_table").dataTable({
            processing: true,
            serverSide: true,
            ajax: "index",
            columns: [
                {data: 'fname', name: 'fname'},
                {data: 'lname', name: 'lname'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'photo', name: 'photo'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).attr("data-id");
            $.ajax({ 
            url: "{{ route('delete') }}",
            data: {"id": id, "_token": "{{ csrf_token()}}"},
            type: 'post',
            success: function(result){
                $(".delete_"+id).closest('tr').remove();
            }
            });
        });
    });
</script>
</html>