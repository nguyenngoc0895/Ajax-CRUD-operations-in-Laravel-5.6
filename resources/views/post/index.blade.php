@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Simple laravel CRUD use AJAX</h1>
    </div>
</div>

<div class="row">
    <div class="table table-responsive">
        <table class="table table-bordered" id="table">
            <tr>
                <th style="width:150px">No</th>
                <th>Title</th>
                <th>Body</th>
                <th>Create at</th>
                <th class="text-center" style="width:150px">
                    <a href="#" class="create-modal btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </th>
            </tr>
            {{ csrf_field() }}
            @foreach ($posts as $key => $post)
            <tr class="post{{ $post->id }}">
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <a href="" class="show-modal btn btn-info btn-sm" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-body="{{ $post->body }}"><i class="fa fa-eye"></i></a>
                    <a href="" class="edit-modal btn btn-warning btn-sm" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-body="{{ $post->body }}"><i class="fa fa-pencil"></i></a>
                    <a href="" class="delete-modal btn btn-danger btn-sm" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-body="{{ $post->body }}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {{$posts->links()}}
</div>

{{-- form create post --}}
<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form  class="form-horizontal" role="form">
                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="title">Title :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="your title here" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="body">Body :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="body" name="body" placeholder="your body here" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="add">
                    <span class="glyphicon glyphicon-plus"></span>Save Post
                </button>
                <button type="submit" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>

{{-- form create post --}}
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" role="form">
                        <div class="form-group row add">
                            <label class="control-label col-sm-2" for="id">ID :</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="id" disabled>
                            </div>
                        </div>
                        <div class="form-group row add">
                                <label class="control-label col-sm-2" for="title">Title :</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="t">
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body :</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="b">
                            </div>
                        </div>
                    </form>

                    {{-- form delete --}}
                    <div class="deletePost">
                        Are you sure want to delete this Post <span class="title"></span>?
                        <span class="hidden id"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>
                    <button type="submit" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

{{-- form show post --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for=""> ID :</label>
                    <b id="id"></b>
                </div>
                <div class="form-group">
                    <label for=""> Title :</label>
                    <b id="tt"></b>
                </div>
                <div class="form-group">
                    <label for=""> Body :</label>
                    <b id="bd"></b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-earning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection