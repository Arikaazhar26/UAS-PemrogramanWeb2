<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    public function index(Request $request)
{
    $query = Member::query();

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('member_code', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->status) {
        $query->where('status', $request->status);
    }

    $members = $query->latest()->paginate(10);

    return view('members.index', compact('members'));
}

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required',
    'email' => 'required|email|unique:members,email',
    'phone' => 'required',
    'address' => 'nullable',
]);

        $lastMember = \App\Models\Member::latest('id')->first();

if ($lastMember) {

    $number = (int) substr($lastMember->member_code,3) + 1;

} else {

    $number = 1;

}

$memberCode = 'MBR'.str_pad($number,3,'0',STR_PAD_LEFT);

       Member::create([
    'member_code' => $memberCode,
    'name'        => $request->name,
    'email'       => $request->email,
    'phone'       => $request->phone,
    'address'     => $request->address,
    'status'      => $request->status,
]);

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil ditambahkan');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'member_code' => 'required|unique:members,member_code,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:members,email,' . $id,
            'phone' => 'required',
            'address' => 'nullable',
             'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $member->update([
    'member_code' => $request->member_code,
    'name'        => $request->name,
    'email'       => $request->email,
    'phone'       => $request->phone,
    'address'     => $request->address,
    'status'      => $request->status,
]);

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil diupdate');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil dihapus');
    }

    public function exportPdf()
{
    $members = Member::all();

    $pdf = Pdf::loadView('members.pdf', compact('members'));

    return $pdf->download('data-member.pdf');
}
}