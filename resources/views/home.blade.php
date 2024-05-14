@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="header mb-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="/books/create" class="btn btn-warning md-2"><i class="fa-solid fa-circle-plus"></i> Add New Book</a>
                </div>
                <form action="/books">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}" aria-label="search" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-sharp text-success fa-solid fa-circle-check"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
                
        @if ($books->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">No</th>
                        <th class="text-center" scope="col">Cover</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <th class="text-center" width="5%" scope="row">{{ $loop->iteration}}</th>
                            <td class="text-center" width="20%">
                                <img src="{{ asset('storage/' . $book->cover) }}" class="rounded img-fluid">
                            </td>
                            <td class="text-start" width="25%"><span class="d-block">{{ $book->title }}</span></td>
                            <td class="text-start" width="15%">{{ $book->author }}</td>
                            <td class="text-start" width="15%">
                                @if ($book->status == 'publised')
                                    <span class=" opacity-75 fw-medium"><i class="fa-sharp text-success fa-solid fa-circle-check"></i> Publised</span>
                                @else
                                    <span class=" opacity-75 fw-medium"><i class="fa-solid text-danger fa-circle-xmark"></i> Not Publised</span>
                                @endif
                            </td>
                            <td width="15%">
                                <a href="/books/{{ $book->id }}" class="mb-2 d-block fs-6 badge bg-info" style="width: 60%;margin: auto"><i class="fa-solid fa-eye"></i> Detail</a>
                                <a href="/books/{{ $book->id }}/edit" class="mb-2 d-block fs-6 badge bg-warning" style="width: 60%;margin: auto"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <form action="/books/{{ $book->id }}" method="POST" style="width: 60%; margin:auto">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge fs-6 bg-danger border-0" style="width: 100%" onclick="return confirm('Apa kamu Yakin?..')"><i class="fa-solid fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2 class="text-center">Not Found...</h2>
        @endif
    </div>
@endsection