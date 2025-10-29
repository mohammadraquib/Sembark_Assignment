<?php

namespace App\Http\Controllers;

use App\Helpers\DateRange;
use App\Models\ShortUrl;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function process(Request $request)
    {
        $dateRange = DateRange::getDates($request->input('range'));
        if(auth()->user()->isSuperAdmin()) {
            $short_urls = ShortUrl::latest()->with('user')->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end']);
        } else if(auth()->user()->isAdmin()) {
            $team_members = auth()->user()->users()->pluck('id')->push(auth()->user()->id);
            $short_urls = ShortUrl::latest()->whereIn('user_id', $team_members)->with('user')->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end']);
        } else {
            $short_urls = auth()->user()->urls()->with('user')->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end']);
        }
        return response()->stream(function () use ($short_urls) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Short URL', 'Long URL', 'Hits', 'Created By', 'Created At']);
            $short_urls->chunk(200, function ($items) use ($handle) {
                foreach($items as $item) {
                    fputcsv($handle, [route('shorturl', ['shorturl' => $item,]), $item->url, $item->hits, $item->user->name, $item->created_at]);
                }
            });
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="short_links.csv"'
        ]);
    }

}
