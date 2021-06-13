@extends('layouts.bootstrap')
@section('title')
    Create Student
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Update Student</h3>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post"
                        action="{{ route('student.update',[$student->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="card-body">

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" disabled
                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email"
                                    id="email" value="{{ $student->email }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                    name="name" id="name" placeholder="Enter name" value="{{ $student->name }}">
                                <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender"
                                    class="form-control {{ $errors->first('gender') ? 'is-invalid' : '' }}">
                                    <option value="pria" @if ($student->gender == 'pria') selected @endif>Pria</option>
                                    <option value="wanita" @if ($student->gender == 'wanita') selected @endif>Wanita</option>
                                </select>
                                <span class="error invalid-feedback">{{ $errors->first('gender') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status"
                                    class="form-control {{ $errors->first('status') ? 'is-invalid' : '' }}">
                                    <option value="active" @if ($student->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if ($student->status == 'inactive') selected @endif>InActive</option>
                                </select>
                                <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                                    name="phone" id="phone" placeholder="Enter phone" value="{{ $student->phone }}">
                                <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                            </div>


                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                          <div class="input-group">
                              <img class="img-thumbnail" src="{{ asset('uploads/'.$student->avatar) }}" width="150px">
                              
                          </div>
                               
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file"
                                    class="form-control {{ $errors->first('avatar') ? 'is-invalid' : '' }}" name="avatar"
                                    id="avatar" placeholder="Enter avatar" value="{{ old('avatar') }}">
                                <span class="error invalid-feedback">{{ $errors->first('avatar') }}</span>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
