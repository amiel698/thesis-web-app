<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Word;
use Auth;

// use Storage;
use Illuminate\Support\Facades\Storage;

class WordsController extends Controller
{
	public function index(Request $request)
	{
		$search = '';
		$query = new Word;
		if($request->has('search') && $request->search != '') {
			$search = trim($request->search);
			$query = $query->where('name', 'LIKE', "%$search%");
		}
		$rows = $query->orderBy('created_at', 'ASC')->paginate(50);
		$data = compact('rows', 'search');
		return view('words.index', $data);
	}

	public function create()
	{
		$route = route('words.store');
		$button_text = 'Save';
		$difficulty = old('difficulty');
		$name = old('name');
		$answer = old('answer');
		$image_url = old('image_url');
		$image_location = '';
		$file_selection = old('file_selection');

		if ($file_selection == '') {
			$file_selection = 'file';
		}

		$data = compact('route', 'button_text', 'difficulty', 'name', 'answer', 'image_url', 'image_location', 'file_selection');
		return view('words.form', $data);
	}

	public function store(Request $request)
	{
		$request->validate([
        	'difficulty'=> 'required',
        	'name' 		=> 'required|unique:words',
        	'answer' 	=> 'required_if:difficulty,hard',
        	'image' 	=> 'required_if:file_selection,file|image',
        	'image_url' => 'required_if:file_selection,url'
		]);

        if ($request->file_selection == 'file') {

	        $file           = $request->file('image');
	        $extension      =  $file->getClientOriginalExtension();
	        $file_name      = time(). '.' . $extension;
	        // $file_location  = 'images';

	        if (!Storage::exists('uploads/images/')) {
	            Storage::makeDirectory('uploads/images/');
	        }


	        $file->move('uploads/images/', $file_name);

	        $image_location = 'uploads/images/'.$file_name;
        } else {
	        $image_location = $request->image_url;
        }

        /*$str_length = 0;
		$str_arr = explode(' ', $request->name);

        if (count($str_arr) == 1) {
        	$str_length = strlen($request->name);
        }*/
        $answer = null;
		$str_length = strlen($request->name);

        if ($request->difficulty == 'hard') {
        	$str_length = 0;
        	$answer = $request->answer;
        	$image_location = '';
        }

		Word::create([
			'name' => $request->name,
			'length' => $str_length,
			'image_location' => $image_location,
			'answer' => $answer
		]);

		return redirect()->route('words.create')->with('success_msg', 'Word successfully added!');
	}

	public function edit($id)
	{
		$row = Word::find($id);
		if (is_null($row)) {
			abort(404);
		}

		$route = route('words.update', $id);
		$button_text = 'Update';
		$difficulty = ($row->length == 0)? 'hard':'normal';
		$name = $row->name;
		$answer = $row->answer;
		$image_location = $row->image_location;
		$image_url = $row->image_location;
		$file_selection = (Str::of($image_location)->contains(['http', 'https']))? 'url': 'file';

		#$data = compact('route', 'button_text', 'name', 'image_url', 'image_location', 'file_selection');
		$data = compact('route', 'button_text', 'difficulty', 'name', 'answer', 'image_url', 'image_location', 'file_selection');
		return view('words.form', $data);
	}

	public function update($id, Request $request)
	{
		$request->validate([
        	'difficulty'=> 'required',
        	'name' => 'required|unique:words,name,'.$id.',id',
        	'answer' 	=> 'required_if:difficulty,hard',
        	'image' 	=> 'required_if:file_selection,file|image',
        	'image_url' => 'required_if:file_selection,url'
		]);

        if ($request->file_selection == 'file') {

	        $file           = $request->file('image');
	        $extension      = $file->getClientOriginalExtension();
	        $file_name      = time(). '.' . $extension;
	         // $file_location  = 'images';

             if (!Storage::exists('uploads/images/')) {
	            Storage::makeDirectory('uploads/images/');
	        }

	        $file->move('uploads/images/', $file_name);

	        $image_location = 'uploads/images/'.$file_name;
        } else {
	        $image_location = $request->image_url;
        }

        $answer = null;
		$str_length = strlen($request->name);

        if ($request->difficulty == 'hard') {
        	$str_length = 0;
        	$answer = $request->answer;
        	$image_location = '';
        }

		Word::where('id', $id)
		->update([
			'name' => $request->name,
			'length' => $str_length,
			'image_location' => $image_location,
			'answer' => $answer
		]);

		return redirect()->route('words.edit', $id)->with('success_msg', 'Word successfully updated!');
	}

    public function remove($id){


        $word = Word::findOrFail($id);
        $path = $word->image_location;
        Storage::delete($path);
        $word->forceDelete();

        return redirect()->back()->with('success_msg', 'Word Deleted!!');
    }
}
