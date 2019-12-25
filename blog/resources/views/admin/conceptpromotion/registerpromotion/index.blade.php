@extends('admin.home')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Concept
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="{{ url('admin/conceptpromotion/create') }}" class="btn btn-success">
        <i class="fa fa-plus"></i>
        <span>Add concept promotion</span>
    </a>
    <p style="height: 5px"></p>
    @if (Session::has('message'))
        <div class="alert alert-info"> {{ Session::get('message') }}</div>
    @endif
        <form id="header-search" action="search/name">
        <input type="search" name="search" id="myInput" placeholder="Search for names.." class="form-control m-input">
        <div id="search-suggest" class="s-suggest"></div>
        {{ csrf_field() }}
    </form>
    <script type="text/javascript">
     $('#header-search').on('keyup', function() {
         var search = $(this).serialize();
          if ($(this).find('.m-input').val() == '') {
             $('#search-suggest div').hide();
         } else {
             $.ajax({
                 url: '/searchconcept',
                 type: 'POST',
                 data: search,
             })
             .done(function(res) {
                 $('#search-suggest').html('');
                 $('#search-suggest').append(res)
             })
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
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Tag</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Free</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Other</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Register Promotion</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th></tr>
                        </thead>
                        <tbody>
                        @if (isset($listconceptpromotion) && count($listconceptpromotion) >0)
                            @foreach($listconceptpromotion as $ser)
                                <tr role="row" class="odd">
                                    <td>{{ $ser->tag }}</td>
                                    <td class="sorting_1">{{ $ser->free }}</td>
                                    <td>{{ $ser->other }}</td>
                                    <td>{{ $ser->registerpromotion }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('admin/conceptpromotion')}}/{{ $ser->registerpromotion }}/edit" class="btn btn-default bg-purple">
                                                <span>Edits</span>
                                            </a>
                                            <form action="{{ url('admin/conceptpromotion')}}/{{ $ser->tag }}" method="POST">
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
                        {!! $listconceptpromotion->render() !!}
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
                        var actionLink = "{{ url('admin/concept')}}/"+ userId;
                        $('#formDelete').attr('action', actionLink).submit();
                    });
            });
        });
    </script>
@endsection