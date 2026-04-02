<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string',
            'order' => 'nullable|integer',
            'type' => 'required|in:header,footer',
            'status' => 'boolean'
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Menu::create($validated);

        if ($validated['type'] === 'footer') {
            return redirect()->route('admin.settings.footer')->with('success', 'Footer menu item created successfully.');
        }

        return redirect()->route('admin.settings.header')->with('success', 'Header menu item created successfully.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string',
            'order' => 'integer',
            'status' => 'boolean'
        ]);

        $menu->update($validated);

        if ($menu->type === 'footer') {
            return redirect()->route('admin.settings.footer')->with('success', 'Footer menu item updated successfully.');
        }

        return redirect()->route('admin.settings.header')->with('success', 'Header menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $type = $menu->type;
        $menu->delete();

        if ($type === 'footer') {
            return redirect()->route('admin.settings.footer')->with('success', 'Footer menu item deleted successfully.');
        }

        return redirect()->route('admin.settings.header')->with('success', 'Header menu item deleted successfully.');
    }
}
