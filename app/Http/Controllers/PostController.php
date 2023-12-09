<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if ($request->bulk_action_btn === 'update_status'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            Post::query()->whereIn('id', $request->bulk_ids)->update(['status' => $request->status]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'delete'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            Post::query()->whereIn('id', $request->bulk_ids)->delete();
            return back()->with('success', __a('bulk_action_success'));
        }

        $title = __a('pages');
        $posts = Post::whereType('page')->orderBy('id', 'desc')->paginate(20);
        return view('admin.cms.pages', compact('title', 'posts'));
    }

    public function posts(Request $request){
        if ($request->bulk_action_btn === 'update_status'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            Post::query()->whereIn('id', $request->bulk_ids)->update(['status' => $request->status]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'delete'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            Post::query()->whereIn('id', $request->bulk_ids)->delete();
            return back()->with('success', __a('bulk_action_success'));
        }

        $title = __a('posts');
        $posts = Post::whereType('post')->orderBy('id', 'desc')->paginate(20);

        return view('admin.cms.posts', compact('title', 'posts'));
    }

    public function createPost(){
        $title = __a('create_new_post');

        return view('admin.cms.post_create', compact('title'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePost(Request $request){
        if(is_live_env()) return back()->with('error', __a('app.feature_disable_demo'));

        $user = Auth::user();
        $rules = [
            'title'     => 'required|max:220',
            'post_content'   => 'required',
        ];
        $this->validate($request, $rules);

        $slug = unique_slug($request->title, 'Post');
        $data = [
            'user_id'               => $user->id,
            'title'                 => clean_html($request->title),
            'slug'                  => $slug,
            'post_content'          => clean_html($request->post_content),
            'type'                  => 'post',
            'status'                => '1',
            'feature_image'         => $request->feature_image,
        ];

        Post::create($data);
        return redirect(route('posts'))->with('success', __a('post_has_been_created'));
    }


    public function editPost($id){
        $title = __a('edit_post');
        $post = Post::find($id);

        return view('admin.cms.edit_post', compact('title', 'post'));
    }

    public function updatePost(Request $request, $id){
        if(is_live_env()) return back()->with('error', __a('app.feature_disable_demo'));

        $rules = [
            'title'     => 'required|max:220',
            'post_content'   => 'required',
        ];
        $this->validate($request, $rules);
        $page = Post::find($id);

        $data = [
            'title'                 => clean_html($request->title),
            'post_content'          => clean_html($request->post_content),
            'feature_image'         => $request->feature_image,
        ];

        $page->update($data);
        return redirect()->back()->with('success', __a('post_has_been_updated'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $title = __a('pages');
        return view('admin.cms.page_create', compact('title'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        if(is_live_env()) return back()->with('error', __a('app.feature_disable_demo'));

        $user = Auth::user();
        $rules = [
            'title'     => 'required|max:220',
            'post_content'   => 'required',
        ];
        $this->validate($request, $rules);

        $slug = unique_slug($request->title, 'Post');
        $data = [
            'user_id'               => $user->id,
            'title'                 => clean_html($request->title),
            'slug'                  => $slug,
            'post_content'          => clean_html($request->post_content),
            'type'                  => 'page',
            'status'                => 1,
        ];

        Post::create($data);
        return redirect(route('pages'))->with('success', __a('page_has_been_created'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $title = __a('edit_page');
        $post = Post::find($id);
        return view('admin.cms.edit_page', compact('title', 'post'));
    }

    public function updatePage(Request $request, $id){
        if(is_live_env()) return back()->with('error', __a('app.feature_disable_demo'));

        $rules = [
            'title'     => 'required|max:220',
            'post_content'   => 'required',
        ];
        $this->validate($request, $rules);
        $page = Post::find($id);

        $data = [
            'title'                 => clean_html($request->title),
            'post_content'          => clean_html($request->post_content),
        ];

        $page->update($data);
        return redirect()->back()->with('success', __a('page_has_been_updated'));
    }

    public function showPage($slug){
        $page = Post::whereSlug($slug)->first();

        if (! $page){
            return view('theme.error_404');
        }
        $title = $page->title;
        return view('theme.single_page', compact('title', 'page'));
    }

    public function blog(){
        $title = __t('blog');
        $posts = Post::post()->publish()->paginate(20);
        return view(theme('blog'), compact('title', 'posts'));
    }

    public function authorPosts($id){
        $posts = Post::whereType('post')->whereUserId($id)->paginate(20);
        $user = User::find($id);
        $title = $user->name."'s ".trans('app.blog');
        return view('theme.blog', compact('title', 'posts'));
    }

    public function postSingle($slug){
        $post = Post::whereSlug($slug)->first();
        if ( ! $post){
            abort(404);
        }
        $title = $post->title;

        if ($post->type === 'post'){
            return view(theme('single_post'), compact('title', 'post'));
        }
        return view(theme('single_page'), compact('title', 'post'));
    }

    public function postProxy($id){
        $post = Post::where('id', $id)->orWhere('slug', $id)->first();
        if ( ! $post){
            abort(404);
        }
        return redirect(route('post', $post->slug));
    }

}
