@extends('layouts.bootstrap')
@section('title')
Create Category
@endsection

@section('content')
    <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Category</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                    <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                  </div>
                  <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control {{$errors->first('thumbnail') ? 'is-invalid' : ''}}" name="thumbnail" id="thumbnail" placeholder="Enter thumbnail" value="{{ old('thumbnail') }}">
                    <span class="error invalid-feedback">{{$errors->first('thumbnail')}}</span>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection