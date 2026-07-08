<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $returns = Borrowing::with(['member', 'book'])

            ->where('status', 'returned')

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->whereHas('member', function ($m) use ($search) {
                        $m->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('book', function ($b) use ($search) {
                        $b->where('title', 'like', "%{$search}%");
                    });

                });

            })

            ->latest()

            ->paginate(10);

        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        return redirect()->route('borrowings.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('borrowings.index');
    }

    public function show($id)
    {
        return redirect()->route('returns.index');
    }

    public function edit($id)
    {
        return redirect()->route('returns.index');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('returns.index');
    }

    public function destroy($id)
    {
        return redirect()->route('returns.index');
    }
}