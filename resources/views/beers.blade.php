@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        @foreach($beers as $beer)
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <div class="row mb-3">
                    <div class="col-12">
                        <span style="font-size: 1.25rem;">{{$beer->name}}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{$beer->description}}
                    </div>
                    <div class="col-6">
                        <img src="{{$beer->image_url}}" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <nav>
            <ul class="pagination justify-content-center">
                @if ($current_page == 1)
                    <li class="page-item disabled">
                @else
                    <li class="page-item">
                @endif
                    <a class="page-link" href="?page={{$current_page - 1}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link">{{$current_page}}</a></li>
                <li class="page-item">
                    <a class="page-link" href="?page={{$current_page + 1}}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection