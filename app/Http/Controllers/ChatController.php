<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatController extends Controller
{
	// public function chats(){
	// 	return view('realtimecrud');
	// }
	public function store(Request $request) {
		$this->validate($request, [
			'content' => 'required',
			'name' => 'required'
		]);

		$input = $request->all();
		// $input['ip'] = request()->ip();
		$input['type'] = 'chat';

		$chat = Chat::create($input);
		return response(['data' => $chat], 200);
	}

	public function join(Request $request) {
		$this->validate($request, [
			'name' => 'required'
		]);

		$input = $request->all();
		$input['content'] = 'join';
		$input['ip'] = request()->ip();
		$input['type'] = 'info';

		$chat = Chat::create($input);
		return response(['data' => $chat], 200);
	}
}
