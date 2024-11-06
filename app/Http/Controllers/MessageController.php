<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'chatroom_id' => 'required',
            'message' => 'nullable',
            'attachment' => 'nullable',
        ]);
        $path = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->storeAs('pictures', $file->getClientOriginalName(), 'public');
        }
        $message = Message::create([
            'chatroom_id' => $request->chatroom_id,
            'sender_id' => (auth()->id()),
            'message' => $request->message,
            'attachment_path' => $path,
        ]);
        return response()->json($message);
    }
    public function list(Request $request)
    {
        $messages = Message::where('chatroom_id', $request->chatroom_id)
            ->paginate(10);
        return response()->json($messages);
    }
}

