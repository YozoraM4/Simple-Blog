<?php

use App\Http\Controllers\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/categories', [CategoryApiController::class, 'index']);
// Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
// Route::post('/categories', [CategoryApiController::class, 'store']);
// Route::pust('/categories/{id}', [CategoryApiController::class, 'update']);
// Route::delete('/categories/{id}', [CategoryApiController::class, 'destory']);
Route::apiResource('/categories', CategoryApiController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function () {
        $validator = validator(request()->all(), [
            "email" => "required",
            "password" => "required",
        ]);
        if($validator->fails()) {
            return response($validator->errors()->all(), 400);
        }

        $user = User::where("email", request()->email)->first();
        if($user) {
            if(password_verify(request()->password, $user->password)) {
                return $user->createToken("browser")->plainTextToken;
            }
        }
        return response(["error" => "Incorrect Email or Password"], 401);
});
