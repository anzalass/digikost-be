<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserVerification;
use App\Models\Pengadaan;
use App\Models\User;
use App\Models\Ruang;
use App\Models\Kategori;
use App\Models\Pemeliharaan;
use App\Models\Aktivitas;
use App\Models\Notifikasi;
// use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


// use \Illuminate\Http\Response::HTTP_UNAUTHORIZED

class UserController extends BaseController
{
    public function regis(UserRequest $request){
          $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required|string|max:50',
                'name' => 'required|string|max:255',
                'role' => 'required|string|max:1',
                "noHP" => 'required|string|max:13'
            ]);
             if($validator->fails()){
                return response()->json([
                    'error' => $validator->errors()
                ],422);
            }
        try{
            $user = User::create([
                        'email'=>$request->email,
                        'name'=>$request->name,
                        'password' => Hash::make($request->password ),
                        'role' => $request->role,
                        'noHP' => $request->noHP
                    ]);

            if($user){
                return response()->json([
                    'status'=>200,
                    'message' => "Registered, verify your email address to login"
                ],200);
            }
        
        }catch(\Exception $e){
            return response()->json([
                'message'=>$e
            ],500);
        }
    }


    public function HomePage($iduser){
        $user = User::count();
        $ruangan = Ruang::count();
        $kategori = Kategori::count();
        $pengadaan = Pengadaan::count();
        $pemeliharaan = Pemeliharaan::count();
        $aktivitas = Aktivitas::all();
        $notifikasi = Notifikasi::where('untuk', $iduser)->get(); // Menggunakan $iduser di sini
        $notifikasilength = Notifikasi::where('untuk',$iduser)->count(); // Menggunakan $iduser di sini
        $totalbarang = Pengadaan::where('status', 'selesai')->count();
    
        return response()->json([
           'totaluser' => $user,
           'totalruangan' => $ruangan,
           'totalkategori' => $kategori,
           'totalpengadaan' => $pengadaan,
           'totalpemeliharaan' => $pemeliharaan,
           'aktivitas' => $aktivitas,
           'notifikasi' => $notifikasi,
           'lengthnotifikasi' => $notifikasilength,
           'totalbarang' => $totalbarang
        ], 200);
    }

    public function getUser(){
        $user = User::all();

        return response()->json([
            'results' => $user,
            'total' =>count($user)
        ],200);
    }

    public function getUserById($id){
        try{   
            $userFind = User::find($id);
            if($userFind){
                return response()->json([
                    'results'=> $userFind
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e
            ],500);
        }
    }   

    public function user(){
        return Auth::user();
    }

    public function login(LoginRequest $request){
        $validator = Validator::make($request->only(['email', 'password']),[
            'email' => 'required|email',
            'password' => 'required|string|max:50',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],422);
        }else{
            if(!$token = Auth::attempt($request->only('email','password'))){
                return response([
                    'message'=> "Invalid Credentials"
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                $datauser = User::where('email', $request->email)->first();
                return response()->json([
                    'data' => $datauser
                ]);
            }

            // return $this->respondWithToken($token);

            // $user = Auth::user();
            // $token = $user->createToken('token')->plainTextToken;

            // $cookie = cookie('jwt',$token, 60*24,);

            // return response()->json([
            //     'message' => $token
            // ])->withCookie($cookie);
            return response()->json([
                'message' => $token
            ]);
        }
    }

    // public function sendResetLinkEmail(UserRequest $request)
    // {
    //     try{
    //         Mail::mailer('smtp')->to("jaung9401@gmail.com")->send('gg');
    //     }catch(\Exception $e){
    //         return response()->json([
    //             'message'=>$e
    //         ],500);
    //     }
    // //    try{
    // //         $this->validate($request, ['email' => 'required|email']);

    // //         $response = Password::sendResetLink($request->only('email'));

    // //         return $response == Password::RESET_LINK_SENT
    // //             ? response()->json(['message' => 'Reset link sent to your email.'], 200)
    // //             : response()->json(['error' => 'Unable to send reset link.'], 400);
    // //    }catch(\Exception $e){
    // //     return response()->json([
    // //         'message'=>$e
    // //     ],500);
    // //    }
    // }

    public function logout(){
        $cookie = Cookie::forget('jwt');

        return Response()->json([
            'message' => 'Success'
        ])->withCookie($cookie);
    }

    public function updateDataUser(UserRequest $request, $id){
        try{
            $findUser = User::find($id);
            if($findUser){
                $validator = Validator::make($request->only(['name', 'noHP']),[
                    'name' => 'required',
                    'noHP' => 'required|max:13'
                ]);

                if($validator->fails()){
                    return response()->json([
                        'error' => $validator->errors()
                    ],422);
                }else{
                    $findUser->name = $request->name;
                    $findUser->noHP = $request->noHP;
                    $findUser->save();
                    return response()->json([
                        'message' => "Data User Berhasil Di Update"
                    ],200);
                }
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e
            ],500);
        }
    }

    public function deleteUser($id){
        $findUser = User::find($id);

        if($findUser){
            $findUser->delete();
            return response()->json([
                'message' =>"User berhasil dihapus."
            ],200);
        }
    }
}