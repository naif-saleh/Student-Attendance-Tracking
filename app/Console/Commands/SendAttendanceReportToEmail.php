<?php

namespace App\Console\Commands;

use App\Exports\AutomatedAttendanceExport;
use App\Mail\AttendanceReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
class SendAttendanceReportToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:send-report {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');

        $today = Carbon::today();
        $yasterday = Carbon::yesterday();

        if($type == 'daily'){
            $startDate = $yasterday;
            $endDate = $today;
        }elseif($type == 'weekly'){
            $startDate = $today->copy()->startOfWeek();
            $endDate = $today->copy()->endOfWeek();
        }else{
            Log::error('Invalid type provided. Please use "daily" or "weekly".');
            $this->error('Invalid type provided. Please use "daily" or "weekly".');
            return;
        }


        $fileName = 'attendance_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.xlsx';
        $filePath = "AttendanceReports/" . $fileName;

        Excel::store(new AutomatedAttendanceExport($startDate, $endDate), $filePath, 'public');
        Mail::to('naif.ecolor@gmail.com')->send(new AttendanceReportMail(
            $filePath,
            $type
        ));
        $this->info("{$type} Attendance report sent successfully!"); 



    }
}
