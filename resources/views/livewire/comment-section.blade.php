<div>
    <div class="mt-4">

        {{-- Flash messages --}}
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Comments header --}}
        <h5>
            💬 Comments 
            <button wire:click="toggleComments" class="btn btn-link p-0 ms-2">
                @if($showComments)
                    Hide
                @else
                    Show
                @endif
            </button>
        </h5>

        {{-- Add new comment --}}
        @auth
            @if($this->hasPurchased())
                <div class="mb-3">
                    <textarea wire:model="newComment" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                    <button wire:click="addComment" class="btn btn-primary btn-sm mt-2">Post</button>
                </div>
            @else
                <p class="text-warning">You can only comment after purchasing this product.</p>
            @endif
        @else
            <p><a href="{{ route('login') }}">Login</a> to comment.</p>
        @endauth

        {{-- Display comments --}}
        @if ($showComments)
            @foreach ($comments as $comment)
                <div class="border rounded p-3 mb-3 bg-light">
                    <div class="d-flex justify-content-between align-items-start">
                        <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                        @if(auth()->id() === $comment->user_id)
                            <button class="btn btn-sm btn-outline-danger" 
                                    wire:click="deleteComment({{ $comment->id }})">Delete</button>
                        @endif
                    </div>

                    <p class="mt-2">{{ $comment->content }}</p>

                    @auth
                        @if($this->hasPurchased())
                            <button class="btn btn-sm btn-outline-primary mb-2" 
                                    wire:click="setReply({{ $comment->id }})">Reply</button>
                        @endif
                    @endauth

                    @if ($replyTo === $comment->id && $this->hasPurchased())
                        <div class="mt-2 ms-3">
                            <textarea wire:model="replyComment" 
                                      class="form-control form-control-sm" 
                                      rows="2" 
                                      placeholder="Write a reply..."></textarea>
                            <button wire:click="addReply" class="btn btn-success btn-sm mt-1">Send Reply</button>
                        </div>
                    @endif

                    {{-- Replies --}}
                    @foreach ($comment->replies as $reply)
                        <div class="ms-4 mt-2 p-2 border-start border-2 border-secondary bg-white rounded">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong>{{ $reply->user->name ?? 'Anonymous' }}</strong>
                                @if(auth()->id() === $reply->user_id)
                                    <button class="btn btn-sm btn-outline-danger" 
                                            wire:click="deleteComment({{ $reply->id }})">Delete</button>
                                @endif
                            </div>
                            <p class="mt-1 mb-0">{{ $reply->content }}</p>
                        </div>
                    @endforeach

                </div>
            @endforeach
        @endif

    </div>
</div>
