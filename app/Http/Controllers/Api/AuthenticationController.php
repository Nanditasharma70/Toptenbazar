<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\SignupRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Requests\Api\VerifyOtp;
use App\Mail\OtpMail;
use App\Models\UploadedFile;
use App\Models\User;
use App\Services\LogServices;
use App\Trait\StatusTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    use StatusTrait;
     #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "AuthenticationController";

    #Bind FileUpload Model
    protected $fileUpload;

    #Bind User Model
    protected $user;

    #Bind $app Name
    protected $appname = "toptenbazar";

     public function __construct(LogServices $logServices,UploadedFile $fileUpload,User $user)
     {
        $this->logServices = $logServices;
        $this->fileUpload  = $fileUpload;
        $this->user        = $user;
    }


    public function signup(SignupRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$request->has('otp')) {
                if (!$user) {
                    $user = User::create([
                        'slug'           => str()->random(15),
                        'email'          => $request->email,
                        'name'           => $request->name ?? '',
                        'status'         => 1,
                        'password'       => Hash::make('123456'), // temp
                        'role_id'        => 3,
                    ]);
                }

                $otp = rand(1000, 9999);
                $user->update([
                    'login_otp'      => $otp,
                    'otp_expires_at' => Carbon::now()->addMinutes(10),
                ]);

                Mail::to($user->email)->send(new OtpMail($otp));

                return response()->json([
                    'status'  => true,
                    'message' => 'OTP sent to your email. Please verify.',
                ]);
            }
            if ($user && 
                $user->login_otp === $request->otp && 
                Carbon::now()->lt($user->otp_expires_at)) {

                $user->update([
                    'login_otp' => null,
                    'otp_expires_at' => null,
                ]);
                $token = $user->createToken(config('app.name'))->plainTextToken;
                return response()->json([
                    'status'  => true,
                    'message' => 'OTP verified. Logged in successfully.',
                    'token'   => $token,
                    'data'    => [
                        'name' => $user->name,
                        'role' => $user->role->name,
                        'id'   => $user->slug,
                    ]
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Invalid or expired OTP.',
            ], 422);

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    /**
     * @method Logout authenticate user
     * @param 
     * @return response
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();
            $this->logServices->createInfoLog("Logout user");

            return response()->json([
                'status_code' => $this->success_code,
                'status'      => $this->success,
                'message'     => 'Logout successfully.'
            ], $this->success_code);

        } catch (\Throwable $e) {
            $this->logServices->createErrorLog("Logout Function - " . $e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }

    /**
     * @method helps to get account profile
     * @param request
     * @return responseJson
     */
    public function getProfile()
    {
        try{
                $user = $this->user->with('image:id,user_id,path')->firstWhere('id',Auth::user()->id);
                if(!$user)
                {
                      return response()->json([
                            'status'  => false,
                            'message' => 'User not found.',
                            'data'    => []
                        ], 404);
                }
                return response()->json([
                    'status'  => true,
                    'message' => 'User fetched successfully.',
                    'data'    => [
                        'name'     => $user->name ?? '',
                        'role'     => $user->role->name ?? '',
                        // 'id'   => $user->id ?? '',
                        'slug'      => $user->slug ?? '',
                        'email'     => $user->email ?? '',
                        'phone'     => $user->phone ?? '',
                        'image_url' => $user->image ? asset($user->image->path) : null,
                    ]
                ]);

        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog("getProfile Function - " . $e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }
    /**
     * 
     */
    public function updateProfile(UpdateUserRequest $request,$userSlug)
    {
        try{
            $user =  $this->user->with('image:id,user_id,path')->firstWhere('slug',$userSlug);
            if(!$user)
                {
                    return response()->json([
                        'status'  => false,
                        'message' => 'User not found.',
                        'data'    => []
                    ], 404);
                }
                if ($request->has('images')) {
                    $images = is_array($request->file('images'))  ? $request->file('images')  : [$request->file('images')];
                        foreach ($images as $file) {
                                $originalName = $file->getClientOriginalName();
                                $mimeType     = $file->getMimeType();
                                $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                                $path         = $file->storeAs('assets/account_profile', $filename, 'customupload');

                                $fileUploadData = [
                                    'path'          => $path,
                                    'mime_type'     => $mimeType,
                                    'original_name' => $originalName,
                                    'file_name'     => $filename,
                                    'user_id'       => Auth::user()->id
                                ];
                           $this->fileUpload->updateOrCreate(
                                            ['user_id' => Auth::id()], 
                                            $fileUploadData            
                                        );
                            }
                    }
                $updateData = [
                    'name'  => $request->name ?? $user->name,
                    'email' => $request->email ?? $user->email,
                    'phone' => $request->phone ?? $user->phone
                ];
               $userUpdated =  $user->update($updateData);
               if(!$userUpdated)
               {
                      return response()->json([
                            'status'  => false,
                            'message' => 'User not updated.',
                            'data'    => []
                        ], 400);
               }  
               return response()->json([
                        'status'  => true,
                        'message' => 'User updated successfully.',
                        'data'    => [
                            'name'     => $user->name ?? '',
                            'slug'      => $user->slug ?? '',
                            'email'     => $user->email ?? '',
                            'phone'     => $user->phone ?? '',
                            'image_url' => $user->image ? asset($user->image->path) : null,
                        ]
                ]);

        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog("updateProfile Function - " . $e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }


}
