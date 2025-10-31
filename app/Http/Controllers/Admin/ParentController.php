<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    public function index()
    {
        $parents = ParentModel::latest()->paginate(15);
        return view('admin.parents.index', compact('parents'));
    }
}
