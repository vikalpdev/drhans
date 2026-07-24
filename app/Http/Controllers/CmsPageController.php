<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;

class CmsPageController extends Controller
{
    public function show(CmsPage $cmsPage)
    {
        return view('cms.show', [
            'cmsPage' => $cmsPage,
        ]);
    }
}
