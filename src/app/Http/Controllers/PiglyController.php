<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PiglyRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Step1Request;
use App\Http\Requests\Step2Request;
use App\Http\Requests\TargetWeightRequest;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;

class PiglyController extends Controller
{

    public function index(Request $request)
    {
        $userId = Auth::id();

        $weightTarget = WeightTarget::where('user_id', $userId)->first();

        $currentWeight = WeightLog::where('user_id', $userId)->orderBy('date', 'desc')->first();

        $weightDifference = null;
        if ($currentWeight && $weightTarget) {
            $weightDifference = $currentWeight->weight - $weightTarget->target_weight;
        }

        $weightLogs = WeightLog::select('date', 'weight', 'calories', 'exercise_time')->paginate(8)->appends($request->query());

        return view('index', compact('weightTarget', 'currentWeight', 'weightDifference', 'weightLogs'));
    }

   
    public function showStep1Form()
    {
        return view('auth.register_step1');
    }


    public function processStep1(Step1Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
        return redirect()->back()->withErrors(['email' => 'このメールアドレスは既に登録されています。']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('register', $user->id);
        return redirect('/register/step2');
    }


    public function showStep2Form()
    {
        return view('auth.register_step2');
    }



    public function processStep2(Step2Request $request)
    {

        $userId = $request->session()->get('register');
       
        WeightLog::create([
            'user_id' => $userId,
            'weight' => $request->validated()['weight'],
            'date' => now()->format('Y-m-d'),
        ]);
        
        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $request->validated()['target_weight'],
        ]);

        $request->session()->forget('register');

        return redirect('/weight_logs');
    }




    public function goalSetting()
    {
        $user = auth()->user();

         if (!$user) {
            abort(403, 'ユーザーが認証されていません。');
         }

         $weightTarget = $user->weightTarget;
         if (!$user->weightTarget) {
            return redirect('/weight_logs')->withErrors('目標体重データが存在しません。');
         }

        $weightLogId = $weightTarget->id;


        return view('goal_setting', compact('weightLogId'));

    }





    public function update(TargetWeightRequest $request, $weightLogId)
    {
        $weightTarget = WeightTarget::where('user_id', auth()->user()->id)->first();

        if ($weightTarget) {
        $weightTarget->target_weight = $request->target_weight;
        $weightTarget->save();
        }

        return redirect('/weight_logs');
    }





    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }




    public function create()
    {
        return view('create');
    }

    public function store (PiglyRequest $request)
    {
        $date = Carbon::today()->format('Y-m-d');
        
        $validated = $request->validated();

        WeightLog::create([

            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        
        ]);

        return redirect('/weight_logs');
    }




    public function search(Request $request)
    {
        $userId = Auth::id();
        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        $currentWeight = WeightLog::where('user_id', $userId)->orderBy('date', 'desc')->first();
        $weightDifference = null;

        if ($currentWeight && $weightTarget) {
        $weightDifference = $currentWeight->weight - $weightTarget->target_weight;
        }


        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
        $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();


        $query = WeightLog::where('user_id', $userId);

        if ($startDate && $endDate) {
        $query->whereBetween('date', [$startDate, $endDate]);
    }

        $weightLogs = $query->paginate(8);

        return view('index', [
            'weightLogs' => $weightLogs,
            'weightTarget' => $weightTarget,
            'currentWeight' => $currentWeight,
            'weightDifference' => $weightDifference,
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
            'count' => $weightLogs->total(),
        ]);
    }

    public function edit($id)
    {
        $log = WeightLog::findOrFail($id);
        
        return view('weight_logs.show', compact('log'));
    }

    public function destroy(Request $request)
    {

        WeightLog::find($request->id)->delete();

        return redirect('/weight_logs');
    }
}
