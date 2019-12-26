@extends('admin.home')
@section('content')
<section class="content-header">
    <h1>
        Concept Promotion Free
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="free/create" class="btn btn-success">
        <i class="fa fa-plus"></i>
        <span>Add concept promotion free</span>
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
             $('.box div').show();
         } else {
             $.ajax({
                 url: '/searchfree',
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

                <div class="form-group col-md-12">
                    <label style="margin-top: 1em">Tag Concept Promotion Free</label>
          <select class="form-control" name="conceptInfo">
              <option value="0">---</option>
              @if(isset($sidebar) && $sidebar)
              @foreach($sidebar as $side)
              <option value="{{ $side->title }}">{{ $side->title }}</option>
              @endforeach
              @endif
              @foreach($test as $te)
              <option id="default" value="{{ $te->test }}" selected="">{{ $te->test }}</option>
              @endforeach
          </select>
                </div>
        <script type="text/javascript">
          $('.form-control').change(function () {

            $.ajaxSetup({ 
                  headers: { 
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                  } 
              });


              $.ajax({

                  type: 'POST',
                  url: 'free/' + $("#default").val(),
                  data: {
                      id: $(this).val(),
                      _method : 'PUT',
                      _token : $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: 'json',
                  success: function(data) {
                      // window.location.reload();
                  },
                  error: function(data) { 
                      window.location.reload();
                  }
              });

          });
        </script>

                <div class="col-sm-12">
                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Free</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th></tr>
                        </thead>
                        <tbody>
                        @if (isset($listconceptpromotionfree) && $listconceptpromotionfree )
                            @foreach($listconceptpromotionfree as $ser)
                                <tr role="row" class="odd">

                                    <td>{{ $ser->free }}</td>
                                    <td>
                                        <div class="btn-group" style="float: right;">
                                            <a href="{{ url('admin/free')}}/{{ $ser->free }}/edit" class="btn btn-default bg-purple">

                                                <span>Edits</span>
                                            </a>
                                            <form action="{{ url('admin/conceptpromotionfree')}}/{{ $ser->free }}" method="POST">
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