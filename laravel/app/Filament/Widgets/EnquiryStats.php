<?php

namespace App\Filament\Widgets;

use App\Models\Batch;
use App\Models\Enquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EnquiryStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $new = Enquiry::where('status', 'new')->count();
        $week = Enquiry::where('created_at', '>=', now()->subWeek())->count();
        $enrolled = Enquiry::where('status', 'enrolled')->count();

        $batch = Batch::upcoming()->where('is_featured', true)->orderBy('starts_at')->first();

        return [
            Stat::make('New enquiries', $new)
                ->description($new ? 'Waiting to be contacted' : 'All caught up')
                ->color($new > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-inbox-arrow-down'),

            Stat::make('Enquiries this week', $week)
                ->description('Last 7 days')
                ->color('primary')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('Enrolled', $enrolled)
                ->description('Converted from enquiries')
                ->color('success')
                ->icon('heroicon-o-academic-cap'),

            Stat::make('Next batch', $batch?->starts_at?->diffForHumans() ?? 'Not set')
                ->description($batch ? $batch->title.' — '.$batch->seats_left.' seats left' : 'No featured batch')
                ->color($batch ? 'warning' : 'gray')
                ->icon('heroicon-o-calendar-days'),
        ];
    }
}
