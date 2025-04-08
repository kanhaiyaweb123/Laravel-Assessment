<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\PostCreated;

class PostController extends Controller
{
    /**
     * Display a listing of the resource (with pagination).
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return response()->json($posts);
    }

    /**
     * Store a newly created post and trigger event.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create the post
        $post = Post::create($validated);

        // Fire event to notify admin
        event(new PostCreated($post));

        return response()->json([
            'message' => 'Post created successfully!',
            'post'    => $post,
        ], 201);
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully!',
            'post'    => $post,
        ]);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!']);
    }
}
