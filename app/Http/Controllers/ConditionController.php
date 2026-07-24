<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\ConditionTreated;
use App\Models\Specialist;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        return view('conditions.index', [
            'conditions' => ConditionTreated::when($category, fn ($q) => $q->where('category', $category))
                ->orderBy('order')
                ->get(),
            'activeCategory' => $category && isset(ConditionTreated::CATEGORIES[$category]) ? $category : null,
        ]);
    }

    public function show(ConditionTreated $condition)
    {
        return view('conditions.show', [
            'condition' => $condition,
            'otherConditions' => ConditionTreated::where('id', '!=', $condition->id)->orderBy('order')->take(7)->get(),
            'centres' => Centre::where('is_active', true)->orderBy('order')->get(),
            'specialists' => Specialist::where('is_active', true)->with('centres')->orderByRaw('TRIM(name)')->get(),
        ]);
    }
}
