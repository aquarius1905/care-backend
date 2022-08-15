<?php

namespace App\Console\Commands;

use App\Models\VisitDatetime;
use App\Mail\VisitDatetimeReminderMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class VisitDatetimeReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visit_datetime:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $visit_datetimes = VisitDatetime::with(['care_receiver'])
            ->wheredate('date', $tomorrow)
            ->get();
        if ($visit_datetimes->count() == 0) {
            return;
        }

        $from_email = config('mail.from.address');

        foreach ($visit_datetimes as $visit_datetime) {
            // 訪問前日メールを送信
            Mail::to($visit_datetime->getKeyPersonEmail())
                ->send(new VisitDatetimeReminderMail($visit_datetime, $from_email));
        }
    }
}
