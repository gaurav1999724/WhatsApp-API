<?php
namespace App\Http\Controllers;
use App\Models\Chatroom;
use App\Models\ChatroomMember;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'member_limit' => 'required',
        ]);

        $chatroom = Chatroom::create([
            'name' => $request->name,
            'member_limit' => $request->member_limit,
        ]);
        return response()->json(['chatroom_id' => $chatroom->id]);
    }

    public function list(Request $request)
    {
        $chatrooms = Chatroom::paginate(10);
        return response()->json($chatrooms);
    }

    public function enter(Request $request)
    {
     $request->validate([
            'chatroom_id' => 'required|exists:chatrooms,id',
        ]);
        $chatroom = Chatroom::findOrFail($request->chatroom_id);
        return response()->json(['message' => 'Entered chatroom']);
    }

    public function leave(Request $request)
    {
     $request->validate([
            'chatroom_id' => 'required|exists:chatrooms,id',
        ]);
        return response()->json(['message' => 'Left chatroom']);
    }
}

