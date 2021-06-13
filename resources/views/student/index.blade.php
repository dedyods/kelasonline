@extends('layouts.bootstrap')

@section('title')
    Student Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Data Students</h3>
                </div>
                <div class="card-body table-responsive">
                    @include('alert.success')
                    <a href="{{ route('student.create') }}" class="btn btn-primary">Create</a>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $row)
                                <tr>
                                    <td>{{ $loop->iteration + $student->perPage() * ($student->currentPage() - 1) }}
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->gender }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td><img class="img-thumbnail" src="{{ asset('uploads/' . $row->avatar) }}" alt=""
                                            width="150px"></td>
                                   
                                    <td>{{ $row->status }}</td>
                                    <td>
                                      <a href="{{ route('student.edit',[$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                      <form method="post" class="d-inline" action="{{ route('student.reset-password',[$row->id]) }}" onsubmit="return confirm('Reset Password This Student')">
                                        @csrf
                                        <input type="submit" value="Reset Password" class="btn btn-success btn-sm">

                                      </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $student->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
