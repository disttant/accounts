<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\Contact as Contact;

class MailController extends Controller
{


    /*public static function SendFromWeb( Request $request )
    {
        //$value = config('app.timezone');

        # Validate input fields
        $validator = Validator::make( $request->all(), [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'body'  => 'required|string|max:1000'
        ]);

        if ( $validator->fails() ) {
            return redirect()
                ->route('admin.apartments.creation')
                ->withErrors('Some field is malformed');
            return 'algo falló en el validador';
        }

        Mail::to( config('custom.contact.to') )
    		//->cc('cc-example@gmail.com')
    		//->bcc('bcc-example@gmail.com')
    		->send(new Contact( $request->input('name'), $request->input('email'), $request->input('body') ));
	    
	    if (Mail::failures()) {
            // return with failed message
            return 'falló el envío';
        }
        
        return 'enviado correctamente';


    }*/

}
