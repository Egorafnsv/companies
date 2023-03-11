<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getComments(){
            $request = request()->all();
            $comments = $this->getCommentsByField($request['company_id'], $request['field']);
            $result['comments'] = $comments;
            return response()->json($result);
    }
    
    public function insertComment(){
        $request = request()->all();
        $field_id = Field::where('field', "{$request['field']}")->first()['id'];

        $comment = [
            'created_at' => date('Y-m-d H:i:s'),
            'comment' => $request['comment'],
            'user_id' => Auth::user()->id,
            'company_id' => $request['company_id'],
            'field_id' => $field_id,
        ];

        Comment::insertGetId($comment);
    }

    private function getCommentsByField(int $id, string $field)
    {
        $comments = Comment::join('fields', 'comments.field_id', '=', 'fields.id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('company_id', $id)
            ->where('field', $field)
            ->select('comments.created_at', 'comment', 'users.name as username')
            ->orderBy('comments.created_at')
            ->get();

            foreach ($comments as &$comment) {
                $comment->created_at_formatted = $comment->created_at
                                                        ->setTimezone('Europe/Moscow')
                                                        ->format('Y-m-d H:i:s');
            }
            unset($comment);

        return $comments;
    }

}
