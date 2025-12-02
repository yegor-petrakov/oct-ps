<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with('roles');

        // Global search across multiple fields
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'ilike', "%{$search}%")
                ->orWhere('first_name', 'ilike', "%{$search}%")
                ->orWhere('middle_name', 'ilike', "%{$search}%")
                ->orWhere('last_name', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%")
                ->orWhere('phone', 'ilike', "%{$search}%");
            });
        }

        // Filter by archived status
        if (($archived = $request->input('archived')) !== null) {
            if ($archived === '1') {
                $query->where('is_archived', true);
            } elseif ($archived === '0') {
                $query->where('is_archived', false);
            }
        }

        // Filter by role
        if ($roleId = $request->input('role_id')) {
            $query->whereHas('roles', fn($q) => $q->where('id', $roleId));
        }

        // Fetch results
        $users = $query->get();
        $roles = Role::all();

        return view('pages.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:256|unique:users,username',
            'first_name' => 'nullable|string|max:256',
            'middle_name' => 'nullable|string|max:256',
            'last_name' => 'nullable|string|max:256',
            'email' => 'required|email|max:256|unique:users,email',
            'phone' => 'nullable|string|max:256',
            'password' => 'required|string|min:6',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'username' => $request->username,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Пользователь создан');
    }


    public function overview(User $user)
    {
        return view('pages.users.overview', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // fetch all roles for selection
        $user->load('roles');

        return view('pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->merge([
            'is_archived' => $request->has('is_archived')
        ]);

        $data = $request->validate([
            'username' => 'required|string|max:256|unique:users,username,' . $user->id,
            'first_name' => 'nullable|string|max:256',
            'middle_name' => 'nullable|string|max:256',
            'last_name' => 'nullable|string|max:256',
            'email' => 'required|email|max:256|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:256',
            'password' => 'nullable|string|min:8',
            'is_archived' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        // Update user
        $user->update($data);

        // Sync roles
        $user->roles()->sync($data['roles'] ?? []);

        return redirect()->route('users.overview', parameters: $user)->with('success', 'Пользователь обновлен!');
    }
}









 // public function customers(User $user)
    // {
    //     return view('pages.users.customers', compact('user'));
    // }

    // public function services(User $user)
    // {
    //     $user->load([
    //         'services.request',
    //         'services.request.customer',
    //         'services.request.site',
    //         'services.status'
    //     ]);

    //     return view('pages.users.services', compact('user'));
    // }

    // public function stats(User $user)
    // {
    //     $user->load('services.request.category', 'services.request.workTypes');

    //     // 1) Services by Category
    //     $servicesByCategory = $user->services
    //         ->groupBy(fn($service) => $service->request->category->name ?? 'Без категории')
    //         ->map->count();

    //     // 2) Services by Work Type
    //     $workTypeCounts = [];

    //     foreach ($user->services as $service) {
    //         foreach ($service->request->workTypes as $type) {
    //             $workTypeCounts[$type->name] = ($workTypeCounts[$type->name] ?? 0) + 1;
    //         }
    //     }

    //     $stats = [
    //         'total_services'          => $user->services->count(),
    //         'services_by_category'    => $servicesByCategory,
    //         'services_by_work_type'   => $workTypeCounts,
    //     ];

    //     return view('pages.users.stats', compact('user', 'stats'));
    // }

    // public function stats(User $user)
    // {
    //     $user->load([
    //         'services.request.category',
    //         'services.request.workTypes',
    //         'services.status'
    //     ]);

    //     $services = $user->services;

    //     /*
    //     |--------------------------------------------------------------------------
    //     | A. BASIC OVERVIEW
    //     |--------------------------------------------------------------------------
    //     */

    //     $totalServices = $services->count();

    //     $currentMonthServices = $services
    //         ->filter(fn ($s) => $s->work_starts_at?->isCurrentMonth())
    //         ->count();

    //     $lastMonthServices = $services
    //         ->filter(fn ($s) => $s->work_starts_at?->isLastMonth())
    //         ->count();

    //     $currentYearServices = $services
    //         ->filter(fn ($s) => $s->work_starts_at?->isCurrentYear())
    //         ->count();

    //     $monthsInUse = max(1, $services->groupBy(fn ($s) => $s->work_starts_at?->format('Y-m'))->count());
    //     $averageServicesPerMonth = round($totalServices / $monthsInUse, 2);


    //     /*
    //     |--------------------------------------------------------------------------
    //     | B. CATEGORY-BASED STATS
    //     |--------------------------------------------------------------------------
    //     */

    //     $categoryStats = [];

    //     foreach ($services as $service) {
    //         $req = $service->request;
    //         if (!$req || !$req->category) continue;

    //         $cat = $req->category->display_name;

    //         if (!isset($categoryStats[$cat])) {
    //             $categoryStats[$cat] = [
    //                 'total' => 0,
    //                 'percentage' => 0,
    //                 'work_types' => []
    //             ];
    //         }

    //         $categoryStats[$cat]['total']++;

    //         // work types
    //         foreach ($req->workTypes as $wt) {
    //             $name = $wt->display_name;
    //             $categoryStats[$cat]['work_types'][$name] =
    //                 ($categoryStats[$cat]['work_types'][$name] ?? 0) + 1;
    //         }
    //     }

    //     // add percentages
    //     foreach ($categoryStats as $cat => $data) {
    //         $categoryStats[$cat]['percentage'] =
    //             $totalServices > 0
    //             ? round(($data['total'] / $totalServices) * 100, 2)
    //             : 0;
    //     }


    //     /*
    //     |--------------------------------------------------------------------------
    //     | C. STATUS-BASED STATS
    //     |--------------------------------------------------------------------------
    //     */

    //     // Example: pending, active, done, cancelled...
    //     $statusStats = $services->groupBy(fn ($s) => $s->status->name ?? 'Unknown')
    //         ->map(fn ($g) => $g->count());


    //     /*
    //     |--------------------------------------------------------------------------
    //     | D. MONTHLY BREAKDOWN (12-MONTH CHART)
    //     |--------------------------------------------------------------------------
    //     */

    //     $months = collect();
    //     for ($i = 11; $i >= 0; $i--) {
    //         $date = now()->subMonths($i);
    //         $monthKey = $date->format('Y-m');

    //         $count = $services
    //             ->filter(fn ($s) => $s->work_starts_at?->format('Y-m') === $monthKey)
    //             ->count();

    //         $months->push([
    //             'label' => $date->format('M Y'),
    //             'count' => $count
    //         ]);
    //     }


    //     /*
    //     |--------------------------------------------------------------------------
    //     | E. WEEKLY BREAKDOWN (LAST 8 WEEKS)
    //     |--------------------------------------------------------------------------
    //     */

    //     $weeks = collect();
    //     for ($i = 7; $i >= 0; $i--) {
    //         $weekStart = now()->startOfWeek()->subWeeks($i);
    //         $weekEnd = now()->startOfWeek()->subWeeks($i - 1);

    //         $count = $services->filter(fn ($s) =>
    //             $s->work_starts_at &&
    //             $s->work_starts_at->between($weekStart, $weekEnd)
    //         )->count();

    //         $weeks->push([
    //             'label' => $weekStart->format('W'),
    //             'count' => $count
    //         ]);
    //     }


    //     /*
    //     |--------------------------------------------------------------------------
    //     | F. TIME-TO-COMPLETE (if work_ends_at exists)
    //     |--------------------------------------------------------------------------
    //     */

    //     $timeToComplete = $services
    //         ->filter(fn ($s) => $s->work_ends_at && $s->work_starts_at)
    //         ->map(fn ($s) => $s->work_starts_at->diffInHours($s->work_ends_at));

    //     $completionStats = [
    //         'avg_hours' => $timeToComplete->avg() ?: null,
    //         'min_hours' => $timeToComplete->min() ?: null,
    //         'max_hours' => $timeToComplete->max() ?: null,
    //     ];


    //     /*
    //     |--------------------------------------------------------------------------
    //     | FINAL RESULT
    //     |--------------------------------------------------------------------------
    //     */

    //     $stats = [
    //         'basic' => [
    //             'total_services' => $totalServices,
    //             'total_services_current_month' => $currentMonthServices,
    //             'total_services_last_month' => $lastMonthServices,
    //             'total_services_this_year' => $currentYearServices,
    //             'average_services_per_month' => $averageServicesPerMonth,
    //         ],

    //         'categories' => $categoryStats,
    //         'statuses' => $statusStats,

    //         'monthly_breakdown' => $months,
    //         'weekly_breakdown' => $weeks,

    //         'completion_time' => $completionStats
    //     ];

    //     return view('pages.users.stats', compact('user', 'stats'));
    // }

