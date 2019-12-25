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
        <form action="{{ url('admin/conceptregister') }}" method="POST" enctype="multipart/form-data" id="form">
            {{ csrf_field() }}
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body ">
                        <div class="form-group col-md-12">
                            <label>Price</label><br>
                            <input type="text" name="price" class="form-control">{{ old('title') }}</input>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Title</label>
                            <textarea name="title" class="form-control"></textarea>
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