<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissions;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permissions::get();

        return view('system.permissions.view', compact('permissions'));
    }
}