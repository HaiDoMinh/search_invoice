@extends('frontend.layouts.main')

@section('header' )
    @if(!empty( $page->title )) {!! $page->title !!} @endif
@endsection

@section('content')
    <div class="content-box">
        <div class="container content">
            {!! (!empty( $page->content )) ?  $page->content : "404 Not Found" !!}
        </div>
    </div>
@endsection

