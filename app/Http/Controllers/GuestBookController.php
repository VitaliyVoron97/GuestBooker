<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;

class GuestBookController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->paginate(10);
        return view('GuestBook.home', compact('messages'));
    }

    public function send(MessageCreateRequest $request)
    {
        $data = $request->validated();
        Message::create($data);

        return back();
    }
}
