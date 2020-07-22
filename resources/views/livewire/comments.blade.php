<div class="container px-5 mt-5">

    <h1 class="text-center">Comments</h1>

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <form class="mt-3" wire:submit.prevent="addComment">
        <div class="row">
            <div class="col-auto">
                @if ($photo)
                    Photo Preview:
                    <img width="48px" src="{{ $photo->temporaryUrl() }}">
                @endif
            </div>
            <div class="col">
                <input type="file" wire:model="photo">
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    @error('newComment') <span class="error"style="color: red">{{ $message }}</span> @enderror
                    <input type="text" class="form-control mt-2" wire:model.lazy="newComment">
                </div>

            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </div>
        </div>

    </form>

    @foreach ($comments as $comment)

            <div class="border-solid rounded overflow-hidden shadow pl-3 mb-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start my-2">
                        <p class="font-weight-bold text-lg"> {{$comment->user->name}} </p>
                        <p class=" ml-3 font-weight-bold"> . </p>
                        <p class="ml-3 font-weight-bolder"> {{$comment->created_at->diffForHumans()}} </p>
                    </div>
                    <div class="mr-3 mt-2">
                        <a href="" style="color: indianred" wire:click.prevent="remove({{$comment->id}})"><i class="fad fa-trash"></i></a>
                    </div>
                </div>
                <p> {{$comment['body']}} </p>
            </div>



    @endforeach
    <div class="d-flex justify-content-center">

          {{ $comments->links() }}

    </div>
</div>
