<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
       $this->postRepository = $postRepository;
    }

    // Repository Pattern
    public function index() 
    {
        $posts = $this->postRepository->all();

        return view('posts.index', compact('posts'));
    }
    /*
    public function index() 
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }
    */

    // Repository Pattern
    public function show($id) 
    {
        $post = $this->postRepository->find($id);

        return view('posts.show', compact('post'));
    }
     /*
    public function show(Post $post) 
    {
        return view('posts.show', compact('post'));
    }
    */

    // Repository Pattern
    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'content' => 'required',
        ]);
        $request = request()->only($this->postRepository->getModel()->fillable) + ['user_id' => auth()->user()->id];

        $post = $this->postRepository->create($request);

        return redirect(route('posts.show', $post->id));
    }
    /*
    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return redirect(route('posts.show', $post->id));
    }
    */

    // Repository Pattern
    public function update($id)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $request = request()->only($this->postRepository->getModel()->fillable) + ['user_id' => auth()->user()->id];

        $post = $this->postRepository->update($request, $id);

        return redirect(route('posts.show', $post->id));
    }
    /*
    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($data);

        return redirect(route('posts.show', $post->id));
    }
    */

    // Repository Pattern
    public function destroy($id)
    {
        $this->postRepository->delete($id);

        return redirect(route('posts.index'));
    }
    /*
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('posts.index'));
    }
    */
}
