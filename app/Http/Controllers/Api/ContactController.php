<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 1,
            'data' => Contact::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        $validated['user_id'] = $request->user()->id ?? null;

        $contact = Contact::create($validated);

        if (!$request->ajax()) {
            return back()->with(['status' => __('Your message has been sent to the administrator.')]);
        }

        return response()->json([
            'message' => __('Your message has been sent to the administrator.'),
            'status' => 1,
            'data' => $contact
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);

        return response()->json([
            'status' => 1,
            'data' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'status' => 1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function markAsRead(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'read_at' => now()
        ]);

        return response()->json([
            'status' => 1,
            'data' => $contact
        ]);
    }
}
