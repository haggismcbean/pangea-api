<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\GameEvents\SpeakEvent;
use App\GameEvents\CharacterSpeakEvent;
use App\GameEvents\PointEvent;

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
		$character = $this->getCharacter($request->input('sourceId'));

		$message = $request->input('message');

		if ($character && $message) {
			$speakEvent = new SpeakEvent();
			$speakEvent->handle($character, $message);
			
			return ['status' => 'Message Sent!'];
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
	public function sendCharacterMessage(Request $request)
	{
		$sourceCharacter = $this->getCharacter($request->input('sourceId'));
		$targetCharacter = $this->getCharacter($request->input('targetId'));

		$message = $request->input('message');

		if ($sourceCharacter->zone_id !== $targetCharacter->zone_id) {
			return;
		}

		if ($targetCharacter && $sourceCharacter && $message) {
			$speakEvent = new CharacterSpeakEvent();
			$speakEvent->handle($sourceCharacter, $targetCharacter, $message);
			
			return ['status' => 'Message Sent!'];
		} else {
			return response()->json(['status' => 'Unauthorised'], 401);
		}
	}

	public function pointAt(Request $request)
	{
		$sourceCharacter = $this->getCharacter($request->input('sourceId'));
		$targetCharacter = $this->getCharacter($request->input('targetId'));

		if ($sourceCharacter->zone_id !== $targetCharacter->zone_id) {
			return;
		}

		if ($targetCharacter && $sourceCharacter) {
			$pointEvent = new PointEvent();
			$pointEvent->handle($sourceCharacter, $targetCharacter);
			
			return ['status' => 'Message Sent!'];
		} else {
			return response()->json(['status' => 'Unauthorised'], 401);
		}
	}

	private function getCharacter($characterId) {
		$user = Auth::user();

		$character = $user->characters()->find($characterId);

		if ($character) {
			return $character;
		} else {
			return null;
		}
	}
}
