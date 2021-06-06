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

                    @if(Request::get('keyword'))
                    <a class="btn btn-primary" href="{{ route('category.index') }}">Back</a>

                    @else
                    <a class="btn btn-primary" href="{{ route('category.create') }}">Create</a>
                    @endif


                    <hr>
                    <form action="{{ route('category.index') }}" method="get">
                    
                    <div class="row">
                        <div class="col-2">
                            <b>Search Name</b>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
                        </div>

                        <div class="col-1">
                            <div type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <div class="col-3">
                            <a class="btn bg-gradient-primary" href="{{ route('category.index') }}">Published</a>
                            <a class="btn btn-outline-primary" href="{{ route('category.trash') }}">Trash</a>
                        </div>
                    </div>
                    </form>
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
                    {{ $category->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
