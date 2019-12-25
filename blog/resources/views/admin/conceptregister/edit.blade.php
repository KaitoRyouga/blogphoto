@extends('admin.home')
@section('content')
   <section class="content-header">
        <h1>
            Edit concept
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/conceptregister') }}/{{ $concept->title }}" method="POST">
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
                        <label>Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $concept->price }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Title</label>
                            <input name="title" class="form-control" value="{{ $concept->title }}"></input>
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