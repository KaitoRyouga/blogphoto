@extends('admin.home')
@section('content')
    <section class="content-header">
        <h1>
            Create concept promotion
        </h1>
    </section>
    <section class="content ">
        @if(count($errors) >0)
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <!-- enctype="multipart/form-data" class="dropzone dz-clickable" -->
        <form action="{{ url('admin/conceptpromotionfree') }}" method="POST" enctype="multipart/form-data" id="form">
            {{ csrf_field() }}
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body ">


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


                        <div class="form-group col-md-12">
                            <label>Free</label><br>
                            <textarea name="free" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fa fa-save"></i>
                    <span>Save and back</span>
                </button>
            </div>
        </form>

    </section>
@endsection