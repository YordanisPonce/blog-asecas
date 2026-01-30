<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        $page = FooterPage::firstOrCreate(['id' => 1]);

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'logo' => $this->img($page->logo),

                'legal' => [
                    'title' => $this->t($page, 'legal_title', $lang),
                    'links' => $this->tArr($page, 'legal_links', $lang),
                ],
                'company' => [
                    'title' => $this->t($page, 'company_title', $lang),
                    'links' => $this->tArr($page, 'company_links', $lang),
                ],
                'products' => [
                    'title' => $this->t($page, 'products_title', $lang),
                    'links' => $this->tArr($page, 'products_links', $lang),
                ],
                'contact' => [
                    'title' => $this->t($page, 'contact_title', $lang),
                    'address_html' => $this->t($page, 'contact_address_html', $lang),
                    'phone_1' => $page->contact_phone_1,
                    'phone_2' => $page->contact_phone_2,
                    'email' => $page->contact_email,
                ],
                'follow' => [
                    'title' => $this->t($page, 'follow_title', $lang),
                    'links' => $this->tArr($page, 'social_links', $lang),
                ],

                'copyright' => $this->t($page, 'copyright_text', $lang),
            ],
        ]);
    }

    private function t($model, string $base, string $lang): ?string
    {
        $col = "{$base}_{$lang}";
        $fallback = "{$base}_es";
        return $model->{$col} ?: $model->{$fallback};
    }

    private function tArr($model, string $base, string $lang): array
    {
        $col = "{$base}_{$lang}";
        $fallback = "{$base}_es";

        $value = $model->{$col};
        if (is_array($value) && count($value)) return $value;

        $fb = $model->{$fallback};
        return is_array($fb) ? $fb : [];
    }

    private function img(?string $path): ?string
    {
        if (!$path) return null;
        if (preg_match('/^https?:\/\//i', $path)) return $path;
        return Storage::disk('public')->url($path);
    }
}
