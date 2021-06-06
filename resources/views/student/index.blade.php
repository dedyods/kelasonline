@extends('layoouts.bootstrap')

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
                    <td>{{ $loop->iteration + ($student->perPage() * ($student->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->avatar }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/',$row->avatar) }}" alt="" srcset=""></td>
                    <td>{{ $row->status }}</td>
                    <td>-</td>
                </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $studen->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
