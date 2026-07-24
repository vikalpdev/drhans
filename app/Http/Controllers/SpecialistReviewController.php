<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialistReviewRequest;
use App\Models\Specialist;

class SpecialistReviewController extends Controller
{
    public function store(StoreSpecialistReviewRequest $request, Specialist $specialist)
    {
        $specialist->reviews()->create([
            ...$request->safe()->except('website'),
            'status' => 'pending',
        ]);

        return back()->with('reviewSuccess', 'Thank you for your feedback! Your review will appear once it has been reviewed by our team.');
    }
}
