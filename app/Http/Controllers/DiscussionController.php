<?php

namespace App\Http\Controllers;

use App\Content;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{

    public function index(){
        $title = __t('discussions');

        return view(theme('dashboard.discussions.index'), compact('title'));
    }

    public function reply($discussion_id){
        $title = __t('discussions');
        $discussion = Discussion::find($discussion_id);

        return view(theme('dashboard.discussions.reply'), compact('title', 'discussion'));
    }

    public function replyPost(Request $request, $discussion_id){
        $this->validate($request, ['message' => 'required']);

        $discussion = Discussion::find($discussion_id);

        $user = Auth::user();
        $title = clean_html($request->title);
        $message = linkify(clean_html($request->message));

        $data = [
            'course_id' => $discussion->course_id,
            'content_id' => $discussion->content_id,
            'user_id' => $user->id,
            'discussion_id' => $discussion_id,
            'title' => $title,
            'message' => $message,
        ];

        Discussion::create($data);

        $discussion->update(['replied' => 1]);
        return back()->with('success', __t('discussion_replied'));
    }

    public function askQuestion(Request $request){
        $rules = [
            'title'     => 'required|max:220',
            'message'   => 'required'
        ];

        $this->validate($request, $rules);

        $content_id = $request->content_id;
        $content = Content::find($content_id);

        $user = Auth::user();
        $title = clean_html($request->title);
        $message = linkify(clean_html($request->message));

        $data = [
            'course_id' => $content->course_id,
            'content_id' => $content_id,
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'replied' => 0,
        ];

        Discussion::create($data);

        return redirect(url()->previous().'#course-discussion-wrap');
    }


}
