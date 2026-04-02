<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        return $this->editHeader();
    }

    public function editHeader()
    {
        $setting = SiteSetting::first();
        if (!$setting) {
             $setting = SiteSetting::create([]);
        }
        $menus = \App\Models\Menu::where('type', 'header')->orderBy('order')->get();
        return view('admin.settings.header', compact('setting', 'menus'));
    }

    public function updateHeader(Request $request)
    {
        $setting = SiteSetting::first();
         if (!$setting) {
             $setting = SiteSetting::create([]);
        }

        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
            'currency' => 'nullable|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,svg|max:1024',
        ]);

        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                unlink(public_path($setting->favicon));
            }
            
            $file = $request->file('favicon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/favicon'), $filename);
            $validated['favicon'] = 'uploads/favicon/' . $filename;
        } elseif ($request->filled('favicon_path')) {
            $validated['favicon'] = $request->favicon_path;
        }

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }
            
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo'), $filename);
            $validated['logo'] = 'uploads/logo/' . $filename;
        } elseif ($request->filled('logo_path')) {
            $validated['logo'] = $request->logo_path;
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.header')->with('success', 'Header settings updated successfully.');
    }

    public function editFooter()
    {
        $setting = SiteSetting::first();
        if (!$setting) {
             $setting = SiteSetting::create([]);
        }
        $menus = \App\Models\Menu::where('type', 'footer')->orderBy('order')->get();
        return view('admin.settings.footer', compact('setting', 'menus'));
    }

    public function updateFooter(Request $request)
    {
        $setting = SiteSetting::first();
         if (!$setting) {
             $setting = SiteSetting::create([]);
        }

        $validated = $request->validate([
            'email' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_link' => 'nullable|string',
            'twitter_link' => 'nullable|string',
            'linkedin_link' => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'youtube_link' => 'nullable|string',
            'whatsapp_link' => 'nullable|string',
            'footer_description' => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'footer_phone' => 'nullable|string',
        ]);

        $setting->update($validated);

        return redirect()->route('admin.settings.footer')->with('success', 'Footer settings updated successfully.');
    }
    public function editShipping()
    {
        $setting = SiteSetting::first();
        if (!$setting) {
             $setting = SiteSetting::create([]);
        }
        return view('admin.settings.shipping', compact('setting'));
    }

    public function updateShipping(Request $request)
    {
        $setting = SiteSetting::first();
         if (!$setting) {
             $setting = SiteSetting::create([]);
        }

        $validated = $request->validate([
            'shiprocket_email' => 'nullable|string',
            'shiprocket_password' => 'nullable|string',
        ]);

        $setting->update($validated);

        return redirect()->route('admin.settings.shipping')->with('success', 'Shipping settings updated successfully.');
    }
    

    public function editAppearance()
    {
        $setting = SiteSetting::first();
        if (!$setting) {
             $setting = SiteSetting::create([]);
        }
        return view('admin.settings.appearance', compact('setting'));
    }

    public function updateAppearance(Request $request)
    {
        $setting = SiteSetting::first();
         if (!$setting) {
             $setting = SiteSetting::create([]);
        }

        $validated = $request->validate([
            'primary_color' => 'nullable|string|regex:/^#[a-fA-F0-9]{6}$/',
            'secondary_color' => 'nullable|string|regex:/^#[a-fA-F0-9]{6}$/',
            'home_meta_title' => 'nullable|string|max:255',
            'home_meta_description' => 'nullable|string',
            'home_meta_keywords' => 'nullable|string',
            'home_meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('home_meta_image')) {
            // Delete old meta image if exists
            if ($setting->home_meta_image && file_exists(public_path($setting->home_meta_image))) {
                unlink(public_path($setting->home_meta_image));
            }
            
            $file = $request->file('home_meta_image');
            $filename = time() . '_meta_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/meta'), $filename);
            $validated['home_meta_image'] = 'uploads/meta/' . $filename;
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.appearance')->with('success', 'Appearance settings updated successfully.');
    }
}
