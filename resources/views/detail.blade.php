@extends('layouts.main')

@section('container')
<div class="container justify-content-center d-flex align-items-center">
    <div class="card mt-3 mb-3" style="width: 50%;">
        <img src="{{ asset('storage/' . $data->cover) }}" class="card-img-top rounded" >
        <div class="card-body">
          <h5 class="card-header bg-transparent p-1">
            <span class="d-block">
              {{ $data->title }}
            </span>
            <span>
              @if ($data->status == 'publised')
                <small class=" opacity-75 fw-medium fs-6"><i class="fa-sharp fs-6 text-success fa-solid fa-circle-check"></i> Publised</small>
              @else
                <small class=" opacity-75 fw-medium fs-6"><i class="fa-solid fs-6 text-danger fa-circle-xmark"></i> Not Publised</small>
              @endif
            </span>
          </h5>
          <article class="card-text mt-2 mb-2 pb-1 border-bottom">{!! $data->description !!}</article>
          <span class="card-text d-block text-body-secondary">Dibuat  : {{ $data->created_at->diffForHumans() }}</span>
          <span class="card-text d-block text-body-secondary">Penulis : {{ $data->author }}</span>
          <a class="btn btn-primary mt-3" href="/books">Back</a>
        </div>
    </div>
</div>
@endsection