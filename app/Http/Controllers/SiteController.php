<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        $query = Site::query();

        // Global search across multiple fields
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                ->orWhere('address', 'ilike', "%{$search}%");
            });
        }

        // Filter by archived status
        if (($archived = $request->input('archived')) === '1') {
            $query->where('is_archived', true);
        } else {
            $query->where('is_archived', false);
        }

        $sites = $query
      
            ->paginate(15)
            ->appends($request->only(['search', 'archived']));

        return view('pages.sites.index', compact('sites'));
    }
}