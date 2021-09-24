<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function test(Request $request) {
		return response()->json([
			'message' => 'Working'
		], 200);
	}
}
