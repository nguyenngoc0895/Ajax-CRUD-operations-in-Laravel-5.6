<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD use Ajax</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('post.index') }}">Ajax</a>
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{-- ajax form add --}}
    <script type="text/javascript">
        $(document).on('click', '.create-modal', function(){
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Add Post');
        });

        ///function create
        $("#add").click(function(){
            $.ajax({
                type: 'POST',
                url: '/addPost',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'title': $('input[name=title]').val(),
                    'body': $('input[name=body]').val(),
                },
                success: function(data){
                    console.log('test');
                    if((data.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.title);
                        $('.error').text(data.errors.body);
                    }else{
                        $('.error').remove();
                        $('#table').append(
                            "<tr class='post "+ data.id +"'>" +
                                "<td>"+ data.id +"</td>" +
                                "<td>"+ data.title +"</td>" +
                                "<td>"+ data.body +"</td>" +
                                "<td>"+ data.created_at +"</td>" +
                                "<td>" +
                                    "<a href='' class='show-modal btn btn-info btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-eye'></i></a>" + '&nbsp;'+
                                    "<a href='' class='edit-modal btn btn-warning btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-pencil'></i></a>"+ '&nbsp;'+
                                    "<a href='' class='edit-modal btn btn-danger btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-trash'></i></a>" +
                                "</td>"+
                            "</tr>"
                        )
                    }
                },
            });
            // $('#title').val();
            // $('#body').val();
        });


        //show funcion
        $(document).on('click', '.show-modal', function(e){
            e.preventDefault();
            $('#show').modal('show');
            $('#id').text($(this).data('id'));
            $('#tt').text($(this).data('title'));
            $('#bd').text($(this).data('body'));
            $('.modal-title').text('Show Post');
        });

        // function edit post
        $(document).on('click', '.edit-modal', function(e){
            e.preventDefault();
            $('#footer_action_button').text(" Update Post");
            $('#footer_action_button').addClass("glyphicon-check");
            $('.actionBtn').addClass('btn-success edit');
            $('.modal-title').text("Edit Post");
            $('.deletePost').hide();
            $('.form-horizontal').show();
            $('#id').val($(this).data('id'));
            $('#t').val($(this).data('title'));
            $('#b').val($(this).data('body'));
            $('#myModal').modal('show');
            
            $('.modal-footer').on('click', '.edit', function(){
                console.log('test');
                $.ajax({
                    type: 'POST',
                    url: '/editPost',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $("#id").val(),
                        'title': $("#t").val(),
                        'body': $("#b").val(),
                    },
                    success: function(data){
                        $('.post' + data.id).replaceWith(" " +
                            "<tr class='post "+ data.id +"'>" +
                                "<td>"+ data.id +"</td>" +
                                "<td>"+ data.title +"</td>" +
                                "<td>"+ data.body +"</td>" +
                                "<td>"+ data.created_at +"</td>" +
                                "<td>" +
                                    "<a href='' class='show-modal btn btn-info btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-eye'></i></a>" + '&nbsp;'+
                                    "<a href='' class='edit-modal btn btn-warning btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-pencil'></i></a>"+ '&nbsp;'+
                                    "<a href='' class='edit-modal btn btn-danger btn-sm' data-id='"+ data.id +"' data-title='"+ data.title +"' data-body='"+ data.body +"'>" + "<i class='fa fa-trash'></i></a>" +
                                "</td>"+
                            "</tr>"
                        );
                    }
                });
            });
        });

        ////form delete;
        $(document).on('click', '.delete-modal', function(e){
            e.preventDefault();
            $('#footer_action_button').text("Delete Post");
            $('#footer_action_button').addClass("glyphicon-trash");
            $('.actionBtn').addClass('btn-danger delete');
            $('.modal-title').text(" Delete Post");
            $('.id').text($(this).data('id'))
            $('.deletePost').show();
            $('.form-horizontal').hide();
            $('.title').html($(this).data('title'));
            $('#myModal').modal('show');

            $('.modal-footer').on('click', '.delete', function(){
                $.ajax({
                    type: 'GET',
                    url: '/deletePost',
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'id': $('.id').text(),
                    },
                    success: function(data){
                        $('.post' + $('.id').text()).remove();
                    }
                })
            })
        });

    </script>

</body>
</html>