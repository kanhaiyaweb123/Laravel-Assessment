use App\Models\Post;
use App\Events\PostCreated;
use Illuminate\Http\Request;

public function index()
{
    return response()->json(Post::paginate(10));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $post = Post::create($request->only('title', 'content'));

    // Fire Event
    event(new PostCreated($post));

    return response()->json($post, 201);
}
