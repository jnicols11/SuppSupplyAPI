<?php

namespace App\Http\Controllers;

use App\Services\Business\UserService;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
	public function test(Request $request) {
		return response()->json([
			'message' => 'Working'
		], 200);
	}

	public function getAllUsers() {
		$users = [];

		if (UserService::getAllUsers() != 500) {
			// populate users array from function
			$users = UserService::getAllUsers();

			// return all users
			return $users;
		} else {
			// return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
		}
	}

	public function getUserByID($id) {

		$user = UserService::getUserByID($id);

		if ($user != null) {
			return $user->jsonSerialize();
		} else {
			return response()->json([
				'message' => 'User not found'
			], 404);
		}
	}

	public function register(Request $request) {
		// Establish variables from request
		$firstName = $request->input('firstName');
		$lastName = $request->input('lastName');
		$email = $request->input('email');
		$password = $request->input('password');

		// Populate model with variable
		$user = new UserModel(-1, $firstName, $lastName, $email, $password);

		if (UserService::register($user) == 200) {
			// return success JSON response to user
			return response()->json([
				'message' => 'Register Success!'
			], 200);
		} else if (UserService::register($user) == 422) {
			// return user already exists JSON response to user
			return response()->json([
				'message' => 'user already exists'
			], 422);
		} else {
			// 500 server error
			return response()->json([
				'message' => 'Registration failed internal server error'
			], 500);
		}
	}

	public function login(Request $request) {
		// Establish variables from request
		$email = $request->input('email');
		$password = $request->input('password');

		// check if function return object
		if (is_object(UserService::login($email, $password))) {
			// populate model
			$user = UserService::login($email, $password);

			// return model as JSON
			return $user->jsonSerialize();
		} else if (UserService::login($email, $password) == 401) {
			// Invalid Credentials
			return response()->json([
				'message' => 'Incorrect email or password'
			], 401);
		} else {
			// 500 server error
			return response()->json([
				'message' => 'Login failed internal server error'
			], 500);
		}
	}

	public function updateUser(Request $request) {
		// Establish variables from Request
		$id = $request->input('id');
		$firstName = $request->input('firstName');
		$lastName = $request->input('lastName');
		$email = $request->input('email');

		// populate user model
		$user = new UserModel($id, $firstName, $lastName, $email, null);

		if (UserService::update($user) == 200) {
			return response()->json([
				'message' => 'User updated successfully'
			], 200);
		} else {
			return response()->json([
				'message' => 'Internal Server Error'
			], 500);
		}
	}

	public function deleteUser($id) {
		if (UserService::delete($id) == 200) {
			return response()->json([
				'message' => 'User Deleted Successfully'
			], 200);
		} else {
			return response()->json([
				'message' => 'Internal Server Error'
			], 500);
		}
	}
}
