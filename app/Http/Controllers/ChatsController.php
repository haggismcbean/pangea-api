<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('chat');
	}

	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages()
	{
		return Message::with('character')->get();
	}

	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request)
	{
		$user = Auth::user();
		$characterId = $request->input('characterId');

		$character = $user->characters()->find($characterId);

		$message = $character->messages()->create([
			'message' => $request->input('message')
		]);

		broadcast(new MessageSent($character, $message));

		return ['status' => 'Message Sent!'];
	}
}
