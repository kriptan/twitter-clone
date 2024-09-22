<div class="card">
    <div class="px-3 pt-4 pb-2">
        {{-- file update  --}}
        <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id) }}">
            
             {{-- Adds a CSRF token to the form.
             This is a security measure to prevent cross-site request forgery attacks.
             The CSRF token is a unique token generated for each user session and
             included in the form data to verify that the request originated from
             the expected source. --}}
            @csrf 
            
             {{-- Adds a PUT HTTP method override to the form.
             This is necessary when using the Laravel `route()` helper to generate a URL
             for a PUT or PATCH HTTP method, as HTML forms only support GET and POST.
             The `@method('put')` directive tells Laravel to use the PUT HTTP method
             when processing the form submission, even though the HTML form itself
             only uses POST. --}}
             
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                        src="{{ $user->getImageUrl() }}" alt="Mario Avatar">
                    <div>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @auth
                    @if(Auth::id() === $user->id)
                        <div>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary">View Profile</a>
                        </div>
                    @endif
                @endauth
            </div>
            <div class = "mt-5">
                <label>Profile Picture </label>
                <input name="image" type="file" class="form-control">
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>           
                    <textarea name="bio" class="form-control" rows="4">{{ $user->bio }} </textarea>
                        @error('bio')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    <button type="submit" class="btn btn-primary mt-3 mb-3">Save</button>         
                    @include('users.shared.user_stats')
            </div>
        </form>
    </div>
</div>
<hr>