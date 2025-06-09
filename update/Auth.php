<?php

namespace App\Controllers;
use GuzzleHttp\Client;

use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
class Auth extends BaseController
{
    protected $user;
    private $db; // Define the $db property


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect(); // Load the database library

    }

    public function index()
    {
        /* ---------------------------- Debugmode --------------------------- */
        $a = $this->userModel->getUser(session('userid'));
        dd($a, session());
    }


public function reset()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard');

        if ($this->request->getPost())
            return $this->reset_action();
        $data = [
            'title' => 'Reset',
            'validation' => Services::validation(),
        ];
        return view('Auth/reset', $data);
    }
    
    
    public function login()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard');

        if ($this->request->getPost())
            return $this->login_action();

        $data = [
            'title' => 'Login',
            'validation' => Services::validation(),
        ];
        return view('Auth/login', $data);
    }


    

    private function login_action()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $stay_log = $this->request->getPost('stay_log');

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $device_info = str_replace(['(', ')', ' ', ';'], ['', '-', '', '-'], strstr($user_agent, '(')); 

        $form_rules = [
            'username' => 'required|alpha_numeric|min_length[4]|max_length[111]|is_not_unique[users.username,error_message[The {field} is not registered.]]',
            'password' => 'required|min_length[5]|max_length[111]',
            'stay_log' => 'permit_empty|max_length[3]',
        ];
        if (!$this->validate($form_rules)) {
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        } else {
            $validation = Services::validation();
            $cekUser = $this->db->table('users')
                 ->where('username', $username)
                 ->limit(1)
                 ->get()
                 ->getRow();
            if ($cekUser) {
                $hashPassword = create_password($password, false);
                if (password_verify($hashPassword, $cekUser->password) or $hashPassword==create_passwords($password)) {
                    
              
                  
  if ($cekUser->loginDevices == NULL || $device_info == $cekUser->loginDevices || $cekUser->loginDevices == "RedZONERROR") {
if ($cekUser->loginDevices == NULL || $cekUser->loginDevices == "RedZONERROR") { $this->userModel->set('loginDevices', $device_info)->where('username', $username)->update(); }                   
                
                 // Send message to Telegram
                    $telegram_token = '6079785592:AAHSl4WOUjAUL7za8MbIDKG6p_-SSqJQwXc';
                   $chat_id = '@offensive_9';
                   $message = "User $username has logged in.";

                  $url = "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=" . urlencode($chat_id) . "&text=$message";file_get_contents($url);
                    
                    
                    $time = new \CodeIgniter\I18n\Time;
                    $data = [
                        'userid' => $cekUser->id_users,
                        'unames' => $cekUser->username,
                        'time_login' => $stay_log ? $time::now()->addHours(24) : $time::now()->addMinutes(30),
                        'time_since' => $time::now(),
                    ];
                    session()->set($data);
                    return redirect()->to('dashboard');
                    
                    
                    } else {
                        
                      $validation->setError('password', 'Wrong device, please try again.');
                    return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.'); 
                        
                    }
                    
                    
                } else {
                    $validation->setError('password', 'Wrong password, please try again.');
                    return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
                }
            }
        }
    }


public function reset_action()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $form_rules = [
            'username' => [
                'label' => 'username',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[111]|is_not_unique[users.username]',
                'errors' => [
                    'is_not_unique' => 'The {field} is not registered.'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[5]|max_length[111]',
            ],
            'stay_log' => [
                'rules' => 'permit_empty|max_length[3]'
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->route('reset')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        } else {
            $validation = Services::validation();
            $cekUser = $this->userModel->getUser($username, 'username');
            if ($cekUser) {
                $hashPassword = create_password($password, false);
                if (password_verify($hashPassword, $cekUser->password)) {
                
             $checkXnx = false;       
             $checkTime = "";
             
             if ($cekUser->loginRsetTime == "3"){  $checkXnx = true; $checkTime = "2";
                $this->userModel->set('loginRsetTime', "2")->where('username', $username)->update();
             } else if ($cekUser->loginRsetTime == "2"){  $checkXnx = true; $checkTime = "1";
                $this->userModel->set('loginRsetTime', "1")->where('username', $username)->update();
             } else if ($cekUser->loginRsetTime == "1"){  $checkXnx = true; $checkTime = "0";
                $this->userModel->set('loginRsetTime', "0")->where('username', $username)->update(); } else {  $checkXnx = false;  }
            
            
            if ($checkXnx) {
              $this->userModel->set('loginDevices', NULL)->where('username', $username)->update();
                sleep(1);         
      return redirect()->back()->with('msgSuccess', '<strong>Successful reset!</strong> <p style="font-size:15px ; ">Available reset time : '.$checkTime.' only');             
            } else {
                sleep(1);         
      return redirect()->back()->with('msgWarning', '<strong>Unsuccessful reset!</strong> <p style="font-size:16px ; ">Reason : reset limit is end');            
            }
            
                    
                    
                } else {
                    $validation->setError('password', 'Wrong password, please try again.');
                    return redirect()->route('reset')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
                }
            }
        }
    }


    public function register()
    {
        if (session('userid')) {
            return redirect('dashboard');
        }
    
        $data = [
            'title' => 'Register',
            'validation' => Services::validation(),
        ];
    
        if ($this->request->getPost()) {
            return $this->register_action();
        }
    
        return view('Auth/register', $data);
    }
    
    public function register_action()
    {
        helper(['create_password']);
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $referral = $this->request->getPost('referral');
    
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $login_devices = preg_replace("/[^A-Za-z0-9-\s]/", "", strstr($user_agent, '('));
    
        $form_rules = [
            'username' => 'required|alpha_numeric|min_length[4]|max_length[111]|is_unique[users.username]',
            'password' => 'required|min_length[5]|max_length[111]',
            'password2' => 'required|matches[password]',
            'referral' => 'required|min_length[5]|alpha_numeric',
        ];
        
        if (!$this->validate($form_rules)) {
            // Form Invalid
        } else {
            $mCode = new CodeModel();
            $rCheck = $mCode->checkCode($referral);
            $validation = Services::validation();
    
            if (!$rCheck) {
                $validation->setError('referral', 'Wrong referral, please try again.');
            } elseif ($rCheck->used_by) {
                $validation->setError('referral', "Wrong referral, code has been used &middot; $rCheck->used_by.");
            } else {
                $hashPassword = create_password($password);
                $data_register = [
                    'username' => $username,
                    'password' => $hashPassword,
                    'saldo' => $rCheck->set_saldo ?: 0,
                    'uplink' => $rCheck->created_by,
                    'login_devices' => $login_devices,
                    'login_rset_time' => "3"
                ];
    
                if ($this->userModel->insert($data_register)) {
                    $mCode->useReferral($referral);
                    $msg = "Register Successfuly!";
                    return redirect('login')->with('msgSuccess', $msg);
                }
            }
        }
    
        return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
    }
    
    
    
    
 
        

    public function logout()
    {
        if (session('userid')) {
            session()->remove(['userid', 'unames', 'time_login', 'time_since']);
            session()->setFlashdata('msgSuccess', 'Logout successfuly.');
        }
    
        return redirect('login');
    }
    
}
