<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthInfo;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    // Bind admin prefix
    protected $admin = 'admin';

    protected $controller = "authenticate";

    #Bind LogServices
    protected $logServices;

    #Bind AuthInfo Service
    protected $authinfo;

    public function __construct(LogServices $logServices, AuthInfo $authinfo)
    {
        $this->logServices = $logServices;
        $this->authinfo    = $authinfo;
    }
    /**
     * @method helps to view login page
     * @param nothing
     * @return view 
     */
    public function loginView()
    {
        try {
            return view('admin.pages.login.admin-login');
        } catch (\Throwable $e) {
            return redirect()->back();
        }
    }

    /**
     * @method helps to authenticate the admin
     * @param Request
     * @return jsonResponse
     */
    public function authenticate(LoginRequest $request)
    {
        try {
            // $credentials = $request->only('email', 'password');
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($credentials)) {
                if (Auth::user()->status != 1 && Auth::user()->role_id != 1) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $notification = [
                        'message'    => 'Please Contact to admin',
                        'alert-type' => 'error'
                    ];
                    return redirect()->back()->with($notification, 400);
                }
                $this->logServices->createInfoLog("User successfully logged In :" . Auth::user()->name, 'top_ten_bazar');
                $notification = [
                    'message'    => 'Successfully logged in',
                    'alert-type' => 'success'
                ];
                return $this->authinfo->getUserRole() == $this->admin ? redirect()->intended($this->admin . '/dashboard')->with($notification, 200) :
                    redirect()->back()->with(
                        [
                            'message'    => 'Unauthorized access',
                            'alert-type' => 'error'
                        ],
                        403
                    );
            } else {
                $notification = [
                    'message'    => 'Invalid credential',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification, 400);
            }
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' authenticate() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    /**
     * @method POST
     * @param
     * @return 
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $notification = [
                'message'    => 'Successfully logged out',
                'alert-type' => 'success'
            ];
            return redirect('/admin/login')->with($notification);
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' logout() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
