@extends('admin.home')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Services
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="{{ url('admin/services/create') }}" class="btn btn-success">
        <i class="fa fa-plus"></i>
        <span>Add services</span>
    </a>
    <p style="height: 5px"></p>
    @if (Session::has('message'))
        <div class="alert alert-info"> {{ Session::get('message') }}</div>
    @endif
    <form id="header-search" action="search/name">
        <input type="search" name="search" id="myInput" placeholder="Search for names.." class="form-control m-input">
        <div id="search-suggest" class="s-suggest"></div>
        @if(isset($Listsearch))
        {{ var_dump($Listsearch) }}
        @endif
        {{ csrf_field() }}
    </form>
    <script type="text/javascript">
     $('#header-search').on('keyup', function() {
         var search = $(this).serialize();
          if ($(this).find('.m-input').val() == '') {
             $('#search-suggest div').hide();
             $('.box div').show();
         } else {
             $.ajax({
                 url: '/search',
                 type: 'POST',
                 data: search,
             })
             .done(function(res) {
                 $('#search-suggest').html('');
                 $('#search-suggest').append(res)
             })
             $('.box div').hide();
         };
     });
    </script>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-12">
                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Ảnh</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Tag</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Tiêu Đề</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Nội dung</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Hành Động</th></tr>
                        </thead>
                        <tbody>
                        @if (isset($listServices) && count($listServices) >0)
                            @foreach($listServices as $ser)
                                <tr role="row" class="odd">
                                    <td>{{ $ser->image_name }}</td>
                                    <td class="sorting_1">{{ $ser->urlservices }}</td>
                                    <td>{{ $ser->title }}</td>
                                    <td>{{ $ser->content }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('admin/services')}}/{{ $ser->urlservices }}/edit" class="btn btn-default bg-purple">
                                                <span>Edits</span>
                                            </a>
                                            <form action="{{ url('admin/services')}}/{{ $ser->urlservices }}" method="POST">
                                                 <input type="hidden" name="_method" value="DELETE">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                               <input type="submit" class="btn btn-danger" value="Delete"/>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div style="float:right">
                        {!! $listServices->render() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
<form action="" method="post" id="formDelete">
    <input type="hidden" name="_method" value="DELETE">
    {{ csrf_field() }}
</form>
<div id="confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirm delete</h4>
            </div>
            <div class="modal-body">
                <p> Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btnDelete').click(function(){
                var userId = $(this).attr('data-value');
                $('#confirm')
                    .modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#delete', function (e) {
                        //delete function
                        var actionLink = "{{ url('admin/services')}}/"+ userId;
                        $('#formDelete').attr('action', actionLink).submit();
                    });
            });
        });
    </script>
@endsection