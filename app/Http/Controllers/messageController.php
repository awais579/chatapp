<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
class messageController extends Controller
{
    public function sendMessage(Request $request){
        $from_user_id = auth()->user()->id;
        $data = $request->all();
        $message = new Message();
        $message->from_user_id =$from_user_id;
        $message->to_user_id = $data["to_user_id"];  
        $message->content = $data["content"]; 
        $message->save();

        $myMessage = Message::all();
        return $myMessage;
    }
}
