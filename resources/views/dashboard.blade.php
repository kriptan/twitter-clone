@extends('layout.layout')
@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.left_side_bar')
    </div>
    <div class="col-6">
        @include('shared.success_message')
        @include('ideas.shared.submit_idea')
        <hr>
        @forelse($ideas as $idea)
            <div class="mt-3">
                @include('ideas.shared.idea_card')
            </div>
        @empty 
            <p class="text-center mt-4">No Ideas Found</p>
        @endforelse
        <div class="mt-3">
            {{ $ideas->withQueryString()->links() }}
        </div>
    </div>
    <div class="col-3">
        @include('shared.search_bar')
        @include('shared.follow_box')
    </div>
</div>
@endsection