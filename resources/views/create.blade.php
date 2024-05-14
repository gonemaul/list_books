@extends('layouts.main')

@section('container')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<style>
    trix-toolbar [data-trix-button-group="file-tools"]{
        display: none
    }
</style>

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Book</h1>
</div>

<div class="col-lg-8 mb-3">
    <form action="/books" method="post" enctype="multipart/form-data">
        @csrf
        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus value="{{old('title')}}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
        </div>

        {{-- author --}}
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author"  value="{{old('author')}}">
            @error('author')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status">
                <option value="publised">Publised</option>
                <option value="no_publised">No Publised</option>
            </select>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
        </div>

        {{-- image --}}
        <div class="mb-3">
            <label for="cover" class="form-label">Cover</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover" onchange="imgPreview()">
            @error('cover')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
        </div>

        {{-- description --}}
        <div class="mb-3">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="category_id" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{old('description')}}">
            <trix-editor input="description"></trix-editor>
        </div>
    
        {{-- submit --}}
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/books" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    function imgPreview() {
        const image = document.querySelector("#cover");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
@endsection