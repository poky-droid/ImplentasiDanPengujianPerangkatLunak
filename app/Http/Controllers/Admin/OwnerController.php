<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Kos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::paginate(15);
        return view('admin.list-owner', compact('owners'));
    }

    public function store(Request $request)
    {
        // Create owner logic
        return redirect()->route('admin.owners.index');
    }

    public function update(Request $request, Owner $owner)
    {
        // Update owner logic
        return redirect()->route('admin.owners.index');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('admin.owners.index');
    }

    public function dashboard()
    {
        $kosList = Kos::where('owner_id', Auth::id())
            ->latest()
            ->take(8)
            ->get();

        return view('owner.dashboard', compact('kosList'));
    }
}
