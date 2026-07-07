<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('id')->get();
        
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'category' => 'required',
        'weight' => 'required|numeric',
        'price' => 'required|numeric',
        'supplier' => 'required',
        ]);
        
        Item::create([
        'name' => $request->name,
        'category' => $request->category,
        'weight' => $request->weight,
        'price' => $request->price,
        'supplier' => $request->supplier,
        ]);
        
        return redirect()->route('items.index')
                     ->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
        'name' => 'required',
        'category' => 'required',
        'weight' => 'required|numeric',
        'price' => 'required|numeric',
        'supplier' => 'required',
        ]);
        
        $item->update([
        'name' => $request->name,
        'category' => $request->category,
        'weight' => $request->weight,
        'price' => $request->price,
        'supplier' => $request->supplier,
        ]);
        
        return redirect()->route('items.index')
                            ->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        
        return redirect()->route('items.index')
                            ->with('success', 'Item berhasil dihapus.');
    }
}
