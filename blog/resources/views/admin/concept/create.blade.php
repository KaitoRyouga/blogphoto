@extends('admin.home')
@section('content')
    <section class="content-header">
        <h1>
            Create concept
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
        <form action="{{ url('admin/concept') }}" method="POST" enctype="multipart/form-data" id="form">
            {{ csrf_field() }}
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body ">
                        <div class="form-group col-md-12">
                            <label>Tag concept</label>
                            <input type="text" name="txtName" class="form-control" value="{{ old('txtName')}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tiêu đề</label>
                            <input name="title" class="form-control">{{ old('title') }}</input>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nội dung</label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="dropzone" id="my-dropzone" name="myDropzone">

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

@section('page-js-script')
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/dropzone.css') }}">
    <script src="{{ asset('Admin/dist/js/dropzone.js') }}"></script>
    <script type="text/javascript">
       Dropzone.options.myDropzone= {
           url: '{{ url('admin/uploadConceptImg') }}',
           headers: {
               'X-CSRF-TOKEN': '{!! csrf_token() !!}'
           },
           success: function (file) {
      $('form').append('<input type="hidden" name="filename" value="' + file.name+ '">')
    },
           autoProcessQueue: true,
           uploadMultiple: true,
           parallelUploads: 5,
           maxFiles: 10,
           maxFilesize: 5,
           acceptedFiles: ".jpeg,.jpg,.png,.gif",
           dictFileTooBig: 'Image is bigger than 5MB',
           addRemoveLinks: true,
           removedfile: function(file) {
           var name = file.name;    
           name =name.replace(/\s+/g, '-').toLowerCase();    /*only spaces*/
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/deleteConceptImg') }}',
                headers: {
                     'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                 },
                data: "id="+name,
                dataType: 'html',
                success: function(data) {
                    $("#msg").html(data);
                }
            });
          var _ref;
          if (file.previewElement) {
            if ((_ref = file.previewElement) != null) {
              _ref.parentNode.removeChild(file.previewElement);
            }
          }
          return this._updateMaxFilesReachedClass();
        },
        previewsContainer: null,
        hiddenInputContainer: "body",
       }
    </script>
    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
            padding: 100px;
            margin: 20px 6px;
        }
    </style>
@endsection