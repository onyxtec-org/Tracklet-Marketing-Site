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

    public function blogPost($slug)
    {
        $posts = [
            'why-operations-teams-deserve-single-source-of-truth' => 'blog-post-1',
            'what-admin-chaos-really-costs-growing-company' => 'blog-post-2',
            'modern-asset-management-is-not-about-barcodes' => 'blog-post-3',
            'when-finance-and-admins-share-same-dashboard' => 'blog-post-4',
            'building-tracklet-designing-real-operational-clarity' => 'blog-post-5',
            'tracklet-vs-stacked-saas-what-consolidation-actually-looks-like' => 'blog-post-6',
            'playbook-high-velocity-office-ops-teams' => 'blog-post-7',
        ];

        if (isset($posts[$slug])) {
            return view('blog-posts.' . $posts[$slug]);
        }

        abort(404);
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
