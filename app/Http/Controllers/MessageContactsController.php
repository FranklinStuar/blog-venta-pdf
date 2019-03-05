<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MessageContact;
class MessageContactsController extends Controller
{
	public function __construct(){
		\Carbon\Carbon::setLocale('es');
	}
	public function index(){
		return view('klorofil.messages-contact.index')->with('messages',MessageContact::paginate(10));
	}

    public function store(Request $request){
        MessageContact::create([
        	'name'=> $request->name,
        	'email'=> $request->email,
        	'message'=> $request->message, 
        	'user_id'=> (\Auth::user())?\Auth::user()->id:null,
    	]);

        $request->session()->flash('success', 'Mensaje enviado correctamente');
        return redirect()->back();
    }

    public function show($id){
    	$message = MessageContact::find($id);
    	if($message->status="sin_revisar")
	    	$message->update([
				'status'=>'revisado'
			]);
		return view('klorofil.messages-contact.show')->with('message',$message);
    }

    public function sendResponse(Request $request,$id){
        $system = \App\System::first();
        $data = array('response'=>$request->message,'message_old'=>MessageContact::find($id)->message);
        // dd($data);
        \Mail::send('emails.message-contacts', $data, function ($message) use($system,$request) {
            $message->from($system->email, 'Systemta');
            $message->to($request->email)->subject("Respuesta a mensaje");
        });

        $request->session()->flash('success', 'Respuesta enviada correctamente');
        return redirect()->back();
    }
    public function destroy(Request $request,$id){
        MessageContact::destroy($id);
        $request->session()->flash('success', 'Mensaje quitado de lista');
        return redirect()->back();
    }

}
