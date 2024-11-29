<?php

namespace App\Http\Controllers;

use App\Models\OrganizerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerRequestController extends Controller
{
    public function create()
    {
        return view('organizer.request-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string',
            'document_number' => 'required|string',
            'document_photo' => 'required|image|mimes:jpg,png|max:2048',
            'contract' => 'requerid|pdf'
        ]);

        $path = $request->file('document_photo')->store('documents', 'public');

        OrganizerRequest::create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'document_number' => $request->document_number,
            'document_photo' => $path,
            'contract' => $path, 
        ]);

        return redirect()->route('organizer.request.create')
            ->with('success', 'Tu solicitud ha sido enviada.');
    }

    public function index()
    {
        $requests = OrganizerRequest::with('user')->where('status', 'pending')->get();
        return view('admin.organizer-requests.index', compact('requests'));
    }

    public function approve(OrganizerRequest $request)
    {
        $request->update(['status' => 'approved']);
        $request->user->assignRole('organizer');

        return redirect()->route('admin.organizer.requests')
            ->with('success', 'Solicitud aprobada.');
    }

    public function reject(OrganizerRequest $request)
    {
        $request->update(['status' => 'rejected']);

        return redirect()->route('admin.organizer.requests')
            ->with('success', 'Solicitud rechazada.');
    }
}

