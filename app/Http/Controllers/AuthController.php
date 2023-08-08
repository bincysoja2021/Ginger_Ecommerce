<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $successStatus = 200;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $checkexist=User::where('email', '=', $request->email)->exists();
        if($checkexist==false)
        {
          return response()->json(['message' => "User not found.",'success' => 'error','statusCode' => 401,'data'=>[]], $this-> successStatus);
        }
        else
        {
            if (! $token = auth()->attempt($validator->validated())) 
            {
                return response()->json(['message' => "Incorrect Password.",'success' => 'error','statusCode' => 401,'data'=>[]], $this-> successStatus);
            }
        }
        return $this->createNewToken($token);
    }
   
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}