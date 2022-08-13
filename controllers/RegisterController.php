<?php
namespace Controllers;

use League\Plates\Engine;
use Exception;
use Models\QueryBuilder;
use Delight\Auth\Auth;
use SimpleMail;
use Tamtamchik\SimpleFlash\Flash;


class RegisterController{


    private $templates;
    private $auth;
    private $db;
    private $mailer;
    public function __construct(Engine $engine, QueryBuilder $db, Auth $auth, SimpleMail $mailer)
    {
        $this ->db = $db;
        $this->templates = $engine;
        $this->auth = $auth;
        $this->mailer = $mailer;
    }


    public function index(){

        $flash =flash();

        echo $this->templates->render('page_register', ['title'=>'register', 'flash'=>$flash]);


    }
    public function emailVerification(){
//        try {
//            $this->auth->confirmEmailAndSignIn ($_GET['selector'], $_GET['token']);
//
//            echo 'Email address has been verified';
//        }
//        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
//            flash('Invalid token', 'error');
//        }
//        catch (\Delight\Auth\TokenExpiredException $e) {
//            flash('Token expired', 'error');
//        }
//        catch (\Delight\Auth\UserAlreadyExistsException $e) {
//            flash('Email address already exists', 'error');
//        }
//        catch (\Delight\Auth\TooManyRequestsException $e) {
//            flash('Too many requests', 'error');
//        }

    }
    public function userRegister(){

//        $db = new PDO("mysql:host=localhost;dbname=module","root","root");
//        $this->auth;
        $flash =flash();
        try {
//            $userId = $auth->register('gihuyojujoxi@tempr.email','123456', 'sveti', function ($selector, $token) {
//                echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
//            $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
//
//                $url = 'http://module2.local/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
//                echo $this->templates->render('email', ['url'=>$url]);
                //                echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
//                echo '  For emails, consider using the mail(...) function, Symfony Mailer, Swiftmailer, PHPMailer, etc.';
//                echo '  For SMS, consider using a third-party service and a compatible SDK';
//            }
          //  );

            $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username']);

            flash('You have successfully registered', 'success');
            header('LOCATION: /');

            //echo 'We have signed up a new user with the ID ' . $userId;

        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash('Invalid email address', 'error');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash('Invalid password', 'error');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash('User already exists', 'error');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash('Too many requests', 'error');
        }
        echo $this->templates->render('page_register', ['title'=>'register', 'flash'=>$flash]);
        $this->sendEmail($_POST['email'],$_POST['username']);
        $this->emailVerification();


    }
    public function sendEmail($email, $username){


//$send = SimpleMail::make()
//    ->setTo($email,$username)
//    ->setFrom('sonyatestest@gmail.com', 'admin')
//    ->setSubject('test test')
//    ->setMessage($this->templates->render('email'))
////    ->setMessage("http://module2.local/verify_email?selector=' .$selector . '&token=' . $token")
//    ->send();
//        echo ($send) ? 'Email sent successfully' : 'Could not send email';
//        echo $this->templates->render('email',[]);
   }




}
