@extends('layouts.bootstrap')
@section('title')
    Category Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Category Data</h3>
                </div>
                <div class="card-body table-responsive">
                    @include('alert.success')

                    <a class="btn btn-primary" href="{{ route('category.create') }}">Create</a>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <a class="btn bg-gradient-primary" href="{{ route('category.index') }}">Published</a>
                            <a class="btn btn-outline-primary" href="{{ route('category.trash') }}">Trash</a>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $row)
                                <tr>
                                    <td>{{ $loop->iteration + $category->perPage() * ($category->currentPage() - 1) }}
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td><img class="img-thumbnail" src="{{ asset('uploads/' . $row->thumbnail) }}"
                                            width="150px"></td>
                                    <td>
                                            <a href="{{ route('category.edit', [$row->id]) }}"
                                            class="btn btn-info btn-sm">Edit</a>

                                            <form class="d-inline" action="{{ route('category.destroy',[$row->id]) }}" method="POST" onsubmit="return confirm('Move Category To Trash ?')">
                                            @csrf
                                            {{  method_field('DELETE') }}
                                            <input type="submit" class="btn btn-danger btn-sm" value="Trash">
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
