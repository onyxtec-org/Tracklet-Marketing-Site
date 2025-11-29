<?php

namespace App\Http\Controllers;

use App\Mail\ContactThankYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function contact()
    {
        return view('contact');
    }

    public function blog()
    {
        return view('blog');
    }

    public function terms()
    {
        return view('terms');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'reason' => 'required|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        // Send thank you email to the user
        Mail::to($validated['email'])->send(new ContactThankYou($validated));

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We\'ve sent a confirmation email to your inbox.'
        ]);
    }
}
