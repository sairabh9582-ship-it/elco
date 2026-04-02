<?php

namespace Addons\Currency\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Addons\Currency\Models\Currency;
use App\Models\SiteSetting;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('currency::index', compact('currencies'));
    }

    public function create()
    {
        return view('currency::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:currencies,code',
            'symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric|min:0',
        ]);

        $currency = Currency::create($request->all());

        if ($request->is_default) {
            $this->setCurrencyAsDefault($currency);
        }

        return redirect()->route('admin.currency.index')->with('success', 'Currency created successfully.');
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency::edit', compact('currency'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:currencies,code,' . $id,
            'symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric|min:0',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($request->all());

        if ($request->is_default) {
            $this->setCurrencyAsDefault($currency);
        }

        return redirect()->route('admin.currency.index')->with('success', 'Currency updated successfully.');
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        if ($currency->is_default) {
            return back()->with('error', 'Cannot delete the default currency.');
        }
        $currency->delete();
        return redirect()->route('admin.currency.index')->with('success', 'Currency deleted successfully.');
    }

    public function setDefault($id)
    {
        $currency = Currency::findOrFail($id);
        $this->setCurrencyAsDefault($currency);
        return redirect()->route('admin.currency.index')->with('success', 'Default currency updated successfully.');
    }

    private function setCurrencyAsDefault($currency)
    {
        // 1. Mark this as default in currencies table
        Currency::query()->update(['is_default' => false]);
        $currency->update(['is_default' => true]);

        // 2. Update Site Settings to reflect this symbol globally
        $settings = SiteSetting::first();
        if ($settings) {
            $settings->update(['currency' => $currency->symbol]);
        }
    }
}
