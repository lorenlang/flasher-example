<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mail\ProfileChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Flasher\Prime\FlasherInterface;


class ProfileController extends Controller
{

    public function update(Request $request, FlasherInterface $flasher)

    {
        $flasher->addSuccess('This is an example success message');
        return redirect()->route('dashboard')->with('countview', FALSE);
    }

}
