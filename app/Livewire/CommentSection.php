<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
  public $product;
    public $newComment = '';
    public $replyComment = '';
    public $replyTo = null;
    public $showComments = false;

    protected $rules = [
        'newComment' => 'required|string|max:500',
        'replyComment' => 'nullable|string|max:500',
    ];

    public function addComment()
    {
   

$this->validate(['newComment' => 'required']);

       if (!Auth::check()) {
        session()->flash('error', 'You must be logged in to comment.');
        return;
    }

    // Check if user has purchased this product
    if (!$this->hasPurchased()) {
        session()->flash('error', 'You can only comment after purchasing this product.');
        return;
    }
        Comment::create([
            'product_id' => $this->product->id,
             'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);
        $this->newComment = '';
    }

    public function setReply($commentId)
    {
        $this->replyTo = $commentId;
    }

    public function toggleComments()
{
    $this->showComments = !$this->showComments;
}


    public function addReply()
    {
    
        $this->validate(['replyComment' => 'required']);
      

    if 
        (!Auth::check())
        {
        session()->flash('error', 'You must be logged in to reply.');
        return;
    }

    if (!$this->hasPurchased()) {
        session()->flash('error', 'You can only reply after purchasing this product.');
        return;
    }

        Comment::create([
            'product_id' => $this->product->id,
             'user_id' => Auth::id(),
            'parent_id' => $this->replyTo,
            'content' => $this->replyComment,
        ]);

        $this->replyComment = '';
        $this->replyTo = null;
    }

    public function deleteComment($commentId)
{
    $comment = Comment::find($commentId);

    if (!$comment) {
        return;
    }

 
    if (Auth::id() !== $comment->user_id) {
        session()->flash('error', 'You can only delete your own comments.');
        return;
    }

  
    if ($comment->replies()->exists()) {
        $comment->replies()->delete();
    }

    $comment->delete();

    session()->flash('message', 'Comment deleted successfully!');
}


public function hasPurchased(): bool
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user) {
        return false;
    }

    /** @var HasMany $orders */
    $orders = $user->orders();

    return $orders->whereHas('orderItems', function ($query) {
        $query->where('product_id', $this->product->id);
    })->exists();
}








    public function render()
    {

 $comments = $this->product->comments()->latest()->get();
        return view('livewire.comment-section', compact('comments'));
    }
}
