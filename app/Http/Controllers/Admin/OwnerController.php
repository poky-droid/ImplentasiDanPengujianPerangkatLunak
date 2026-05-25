<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
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
}
