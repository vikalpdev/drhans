<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\ConditionTreated;

class ConditionController extends Controller
{
    public function index()
    {
        return view('conditions.index', [
            'conditions' => ConditionTreated::orderBy('order')->get(),
        ]);
    }

    public function show(ConditionTreated $condition)
    {
        return view('conditions.show', [
            'condition' => $condition,
            'otherConditions' => ConditionTreated::where('id', '!=', $condition->id)->orderBy('order')->take(7)->get(),
            'centres' => Centre::orderBy('order')->get(),
        ]);
    }
}
