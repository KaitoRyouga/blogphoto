@extends('admin.home')
@section('content')
   <section class="content-header">
        <h1>
            Edit concept
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/concept') }}/{{ $concept->urlconcept }}" method="POST">
          <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            @if(count($errors) >0)
                <ul>
                @foreach($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
                </ul>
            @endif
            <div class="box">
                <div class="box-body row">
                    <div class="form-group col-md-12">
                        <label>Tag dịch vụ</label>
                            <input type="text" name="txtName" class="form-control" value="{{ $concept->urlconcept }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Tiêu đề</label>
                            <input name="title" class="form-control" value="{{ $concept->title }}"></input>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Nội dung</label>
                            <textarea name="content" class="form-control">{{ $concept->content }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="dropzone" id="my-dropzone" name="myDropzone">

                    </div>
                </div>
                <div class="box-footer row">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        <span>Save and back</span>
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('page-js-script')
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/dropzone.css') }}">
    <script src="{{ asset('Admin/dist/js/dropzone.js') }}"></script>
    <script type="text/javascript">
       Dropzone.options.myDropzone= {
           url: '{{ url('admin/uploadImg') }}',
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
                url: '{{ url('admin/deleteImg') }}',
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