<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FaqsController extends Controller
{
    public function index(){
    	return view('klorofil.faqs.index')->with('faqs',\App\Faq::all());
    }
    
    public function create(){
    	return view('klorofil.faqs.create')->with('faq',new \App\Faq);
    }

    public function store(Request $request){
		$this->validate($request, [
			'question' 	=> 'required',
			'answer' 	=> 'required',
		]);
    	Faq::create($request->all());
      	$request->session()->flash('success', 'Nueva pregunta realizada con éxito');
    	return redirect()->route('faqs.index');
    }

    public function edit($id){
    	return view('klorofil.faqs.edit')->with('faq',\App\Faq::find($id));
    }

    public function show($id){
    	return view('klorofil.faqs.show')->with('faq',\App\Faq::find($id));
    }

    public function update(Request $request, $id){
		$this->validate($request, [
			'question' 	=> 'required',
			'answer' 	=> 'required',
		]);
    	Faq::find($id)->update($request->all());
      	$request->session()->flash('success', 'Pregunta editada con éxito');
    	return redirect()->route('faqs.index');
    }

    public function destroy(Request $request, $id){
    	Faq::destroy($id);
      	$request->session()->flash('success', 'Pregunta eliminada con éxito');
    	return redirect()->route('faqs.index');
    }
}
