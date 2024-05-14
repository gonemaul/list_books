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
    <h1 class="h2">Change Book</h1>
</div>

<div class="col-lg-8 mb-3">
    <img src="{{ asset('storage/' . $data->cover) }}" class="text-center d-block img-preview rounded img-fluid mb-3 col-sm-5">
    <form action="/books/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus value="{{ $data->title }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
        </div>

        {{-- author --}}
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author"  value="{{ $data->author }}" required>
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
                @if ($data->status == 'publised')
                    <option selected value="publised">Publised</option> 
                    <option value="no_publised">No Publised</option>
                @else
                    <option value="publised">Publised</option> 
                    <option selected value="no_publised">No Publised</option>
                @endif
            </select>
        </div>

        {{-- image --}}
        <div class="mb-3">
            <label for="cover" class="form-label">Cover</label>
            @if ($data->cover == 'cover_book/no_preview_available.png')
                <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" disabled name="cover" onchange="imgPreview()">
            @else
                <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover" onchange="imgPreview()">
            @endif
            @if (session()->has('errorCover'))
                <div class="invalid-feedback">
                    {{ session('errorCover')}}
                </div>
            @endif
            

            <div class="form-check mt-1 ms-1">
                @if ($data->cover == 'cover_book/no_preview_available.png')
                    <input class="form-check-input" type="checkbox" name="checkbox" id="flexCheckChecked" checked onchange="removeCover()">
                @else
                    <input class="form-check-input" type="checkbox" name="checkbox" id="flexCheckChecked" onchange="removeCover()">
                @endif
                <label class="form-check-label" for="flexCheckChecked">
                  Hapus cover
                </label>
            </div>
        </div>

        {{-- description --}}
        <div class="mb-3">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
            @enderror
            <label for="category_id" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ $data->description }}">
            <trix-editor input="description"></trix-editor>
        </div>
    
        {{-- submit --}}
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/books" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const image = document.querySelector("#cover");
    
    function removeCover(){
        const check = document.querySelector('#flexCheckChecked');
        if (check.checked){
            cover.setAttribute('disabled', true)
        }
        else{
            cover.removeAttribute('disabled')
        }
    }

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function imgPreview() {
        const imgPreview = document.querySelector(".img-preview");

        // imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection