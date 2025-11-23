<?php

namespace App\Http\Controllers;

use App\Models\DisasterEvent;
use App\Models\DisasterAlert;
use App\Models\DisasterMonitoringLog;
use App\Models\DisasterReport;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class DisasterRssController extends Controller
{
    public function index(): Response
    {
        $barangayName = config('barangay.name', 'Barangay');
        $rss = Cache::remember('disaster_rss_' . config('barangay.id'), 300, function () use ($barangayName) {
            $events = DisasterEvent::with(['disasterType'])
                ->orderBy('start_date', 'desc')
                ->limit(20)
                ->get();

            $alerts = DisasterAlert::with(['disasterEvent', 'issuedBy'])
                ->where('is_active', true)
                ->orderBy('issued_at', 'desc')
                ->limit(20)
                ->get();

            $logs = DisasterMonitoringLog::with(['disasterEvent', 'loggedBy'])
                ->orderBy('logged_at', 'desc')
                ->limit(20)
                ->get();

            $reports = DisasterReport::with(['disasterEvent', 'generatedBy'])
                ->orderBy('report_date', 'desc')
                ->limit(20)
                ->get();

            $items = collect()
                ->merge($events->map(function($event) {
                    return [
                        'title' => 'Disaster Event: ' . $event->title,
                        'description' => $event->description ?? 'No description',
                        'link' => route('disaster-management') . '?event=' . $event->id,
                        'pubDate' => $event->start_date->format('D, d M Y H:i:s \G\M\T'),
                        'category' => $event->disasterType->name,
                    ];
                }))
                ->merge($alerts->map(function($alert) {
                    return [
                        'title' => 'Alert: ' . $alert->title,
                        'description' => $alert->message,
                        'link' => route('disaster-alert') . '?alert=' . $alert->id,
                        'pubDate' => $alert->issued_at->toRssString(),
                        'category' => 'Alert - ' . ucfirst($alert->alert_type),
                    ];
                }))
                ->merge($logs->map(function($log) {
                    return [
                        'title' => 'Update: ' . $log->title,
                        'description' => $log->description,
                        'link' => route('disaster-monitoring') . '?log=' . $log->id,
                        'pubDate' => $log->logged_at->toRssString(),
                        'category' => 'Monitoring - ' . ucfirst(str_replace('_', ' ', $log->log_type)),
                    ];
                }))
                ->merge($reports->map(function($report) {
                    return [
                        'title' => 'Report: ' . $report->title,
                        'description' => strip_tags($report->content),
                        'link' => route('disaster-report') . '?report=' . $report->id,
                        'pubDate' => $report->report_date->toRssString(),
                        'category' => 'Report - ' . ucfirst($report->report_type),
                    ];
                }))
                ->sortByDesc('pubDate')
                ->take(50);

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<rss version="2.0">' . "\n";
            $xml .= '  <channel>' . "\n";
            $xml .= '    <title>' . htmlspecialchars($barangayName . ' - Disaster Management RSS Feed') . '</title>' . "\n";
            $xml .= '    <link>' . url('/') . '</link>' . "\n";
            $xml .= '    <description>Consolidated RSS feed for disaster events, alerts, monitoring updates, and reports</description>' . "\n";
            $xml .= '    <language>en-us</language>' . "\n";
            $xml .= '    <lastBuildDate>' . now()->format('D, d M Y H:i:s \G\M\T') . '</lastBuildDate>' . "\n";
            $xml .= '    <pubDate>' . now()->format('D, d M Y H:i:s \G\M\T') . '</pubDate>' . "\n";

            foreach ($items as $item) {
                $xml .= '    <item>' . "\n";
                $xml .= '      <title>' . htmlspecialchars($item['title']) . '</title>' . "\n";
                $xml .= '      <description><![CDATA[' . $item['description'] . ']]></description>' . "\n";
                $xml .= '      <link>' . htmlspecialchars($item['link']) . '</link>' . "\n";
                $xml .= '      <pubDate>' . $item['pubDate'] . '</pubDate>' . "\n";
                $xml .= '      <category>' . htmlspecialchars($item['category']) . '</category>' . "\n";
                $xml .= '    </item>' . "\n";
            }

            $xml .= '  </channel>' . "\n";
            $xml .= '</rss>';

            return $xml;
        });

        return response($rss, 200)
            ->header('Content-Type', 'application/rss+xml; charset=utf-8');
    }
}

