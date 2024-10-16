<?php

namespace App\Http\Controllers;

use Ferdous\OtpValidator\Object\OtpRequestObject;
use Ferdous\OtpValidator\OtpValidator;
use Ferdous\OtpValidator\Object\OtpValidateRequestObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OtpController extends Controller
{
    public function confirmationPage()
    {
        return view('');
    }

    /**
     * @return array
     */
    public function requestForOtp(Request $request)
    {
        $email = $request->input('email');
        $verification_type=$request->input('ver_type');
        $con = mysqli_connect("localhost","root","","plus_h");

        if(mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        
        $result = mysqli_query($con, "SELECT * FROM otps WHERE email = '$email' AND type = '$verification_type' AND status = 'used'");
        
        // Perform query for customer/seller
        if(mysqli_num_rows($result) > 0) {
            mysqli_close($con);
            return redirect()->route($verification_type, $email);
        }

        mysqli_close($con);

        $client_req_id = '007';
        $number=$request->input('number');

        if($verification_type!='register.seller') {
            $validator = Validator::make([
                'email' => $email,
            ], [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ], [ 
                'email.unique' => 'Email sudah digunakan',
            ]);
            
            if($validator->fails()){
                return redirect()->back()
                                ->withInputs($request->all())
                                ->withErrors($validator);
            } 
        }

        $otp_req = OtpValidator::requestOtp(
            new OtpRequestObject($client_req_id, $number, $verification_type, $email)
        );

        if($otp_req['code'] === 201) {
            if($verification_type == "register.seller") {
                return view('auth.re-verify-otp')->with([
                    'otp_req' => $otp_req,
                    'email' => $email
                ]);
            }
            return view('auth.verify-otp')->with([
                'otp_req' => $otp_req, 
                'email' => $email
            ]);
        } else {
            dd([
                'otp_req' => $otp_req, 
                'email' => $email
            ]);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateOtp(Request $request)
    {
        $email = $request->input('email');
        $verification_type=$request->input('ver_type');
        $con = mysqli_connect("localhost","root","","plus_h");

        if(mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        
        $result = mysqli_query($con, "SELECT * FROM otps WHERE email = '$email' AND type = '$verification_type' AND status = 'used'");
        
        // Perform query for customer/seller
        if(mysqli_num_rows($result) > 0) {
            mysqli_close($con);
            return redirect()->route($verification_type, $email);
        }

        mysqli_close($con);

        $uniqId = $request->input('uniqueId');
        $otp = $request->input('otp');
        $data['resp'] = [
            200 => 'Email Confirmed',
            204 => 'Too Many Attempts',
            203 => 'Invalid OTP given',
            404 => 'Request not found',
            400 => 'Invalid OTP given'
        ];
        $data['validate'] =  OtpValidator::validateOtp(
            new OtpValidateRequestObject($uniqId,$otp)
        );

        if($data['validate']['code'] === 200){
            //TODO: OTP is correct and with return the transaction ID, proceed with next step
            return redirect()->route($verification_type, $email);
        };

        return view('auth.reverify-otp')->with($data);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function resendOtp(Request $request)
    {
        $uniqueId = $request->input('uniqueId');
        $otp_req = OtpValidator::resendOtp($uniqueId);

        if(isset($otp_req['code']) && $otp_req['code'] === 201){
            return view('auth.reverify-otp')->with($otp_req);
        } else {
            dd($otp_req);
        }
    }

}