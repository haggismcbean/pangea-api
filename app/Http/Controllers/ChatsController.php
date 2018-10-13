<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\GameEvents\SpeakEvent;

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
	public function fetchMessages(Request $request)
	{
		$character = $this->getCharacter($request->query('character_id'));

		if ($character) {
			return Message::where('character_id', $character->id)->orderBy('created_at', 'DESC')->paginate(15);
		} else {
			return response()->json(['status' => 'Unauthorised'], 401);
		}
	}

	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request)
	{
		$character = $this->getCharacter($request->input('characterId'));

		if ($character) {
			$speakEvent = new SpeakEvent();
			$speakEvent->handle($character, $request);
			
			return ['status' => 'Message Sent!'];
		} else {
			return response()->json(['status' => 'Unauthorised'], 401);
		}
	}

	private function getCharacter($characterId) {
		$user = Auth::user();
		$characterId = $characterId;

		$character = $user->characters()->find($characterId);

		if ($character) {
			return $character;
		} else {
			return null;
		}
	}
}
