<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class LivePost extends Component
{
    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(round('login'), true);
        }

        $user = auth()->user();

        if ($user->hasLiked($this->post)) {
            $user->likes()->detach($this->post);
            return;
        }

        $user->likes()->attach($this->post);
    }
    public Post $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.live-post');
    }

}
