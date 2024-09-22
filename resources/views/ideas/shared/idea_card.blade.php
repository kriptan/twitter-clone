<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $idea->user->getImageUrl() }}" alt="Mario Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}"> {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                <form method ="POST" action={{ route('idea.destroy',$idea->id) }}>
                    @csrf
                    @method('delete')
                    @auth
                        @if (auth()->user()->id == $idea->user_id)
                            <a href={{ route('idea.edit', $idea->id) }} class="mx-2">Edit</a>  
                        @endif
                    @endauth                 
                    <a href={{ route('idea.show', $idea->id) }} class="mx-1">View</a>
                    @auth
                        @if (auth()->user()->id == $idea->user_id)
                            <button class="btn btn-danger btn-sm">X</button>
                        @endif
                    @endauth   
                </form>
                
                
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($editing ?? false)
            @include('shared.edit_idea')
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like_button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }}</span>
            </div>
        </div>
        @include('shared.comments_box')
    </div>
</div>