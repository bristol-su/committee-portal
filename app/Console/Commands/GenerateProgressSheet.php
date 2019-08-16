<?php

namespace App\Console\Commands;

use ActiveResource\ConnectionManager;
use App\Packages\ContactSheetUpload\SheetRow;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class GenerateProgressSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'progress:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the progress sheet and upload to google drive.';

    protected $generateSheet = true;

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
     * @return mixed
     */
    public function handle()
    {
        $this->warn('This feature relies on an implementation of the cache being in place (See PSR-6).');
        // TODO As above
        $sheetRows = new Collection;
        $roles = CommitteeRole::all()->sortBy(function ($role) {
            return $role->group->name;
        });
        // Gather together each of the sheet rows
        foreach ($roles as $role) {
            $student = Student::find($role->student_id);
            $sheetRows[] = new SheetRow($role->position, $student, $role->group, $role);
        }

        // Get any data to construct the rows in full
        $counter = 0;
        $sheetRows->each(function ($sheetRow) use (&$counter) {
            if ($sheetRow->generateData() === false) {
                $this->generateSheet = false;
                $counter++;
            }
            return $sheetRow;
        });

        // Create the raw data
        $rawData = [];
        $rawData[] = SheetRow::getHeaders();
        foreach ($sheetRows as $sheetRow) {
            $rawData[] = $sheetRow->getElements();
        }

        if ($this->generateSheet) {
            $this->uploadSheet($rawData);
        } else {
            $this->error('We\'re just collecting some student data (' . $counter . ' to collect). Please try again later.');
        }
    }

    public function uploadSheet($data)
    {
        $filename = sys_get_temp_dir() . '/' . Carbon::now()->format('dmyHis') . 'progress_sheet_generation.csv';
        $csv = Writer::createFromPath($filename, 'w+');
        $csv->insertAll($data);

        // Get the current file so we can overwrite it later
        $path = config('app.progress_sheet_drive_id');

        if (Storage::disk('google')->put($path, $csv, ['mimetype' => 'application/vnd.google-apps.spreadsheet'])) {
            $this->info('Successfully uploaded to Google Drive.');
        } else {
            $this->error('Sorry, an error occurred uploading the sheet to Google Drive');
        }
    }

}
