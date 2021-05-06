<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Word;
use App\User;
use App\StudentRecords;
use Faker\Factory as Faker;

class ChallengeController extends Controller
{
	public function process($rows)
	{
		$n = 0;
		$data = [];
		foreach ($rows as $row) {
			$image_location = $row->image_location;

			if (!Str::of($image_location)->contains(['http', 'https'])) {
				$image_location = url('/') . '/' . $image_location;
			}

			$data[$n] = [
				'name' => $row->name,
				'url' => $image_location,
				'answer' => $row->answer,
			];
			if ($row->length != 0) {
				unset($data[$n]['answer']);
			} elseif ($row->length == 0) {
				unset($data[$n]['url']);
			}
			$n++;
		}
		return $data;
	}

	public function easy()
	{
		$rows = Word::where('length', '>=', 1)->where('length', '<=', 5)->take(50)->orderBy(DB::raw('RANDOM()'))->get();
		$data = $this->process($rows);
		return response()->json($data);
	}

	public function medium()
	{
		$rows = Word::where('length', '>', 5)->take(50)->orderBy(DB::raw('RANDOM()'))->get();
		$data = $this->process($rows);
		return response()->json($data);
	}

	public function hard()
	{
		$rows = Word::where('length', 0)->orderBy(DB::raw('RANDOM()'))->take(50)->get();
		$data = $this->process($rows);
		return response()->json($data);
	}

	public function getResult(Request $request)
	{
		$student_id = $request->student_id;
		// $grading = $request->grading;
		$difficulty = $request->difficulty;
		$result = $request->result;
		$total = $request->total;

		$user = User::find($student_id);

		if (is_null($user)) {
			return response()->json([ 'message' => 'Student does not exists!' ]);
		} elseif (!in_array($difficulty, ['easy', 'medium', 'hard'])) {
			return response()->json([ 'message' => 'Invalid difficulty level!' ]);
		}
		 elseif (!$request->has('result')) {
			return response()->json([ 'message' => 'Result not found!' ]);
		} elseif (!$request->has('total')) {
			return response()->json([ 'message' => 'Total not found!' ]);
		}

        // elseif (!$request->has('grading')) {
		// 	return response()->json([ 'message' => 'Grading not found!' ]);
        // }
        $faker = Faker::create();
		StudentRecords::create([
			'student_id' => $user->id,
			'grading' => $faker->unique(true)->randomElement(['1','2','3','4']),
			'difficulty' => $difficulty,
			'score' => $result,
			'total' => $total
		]);
		return response()->json([
			'message' => 'Student Score successfully saved!'
		]);
	}
}
