<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command db backup description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $backupFolderName = 'backup';
        // check if the backup folder exists
        if(!Storage::exists($backupFolderName)){
            Storage::makeDirectory($backupFolderName);
        }
        // get the current time as the file namem
        $fileName = $this->anticipate('What is your backup name?',[date('Y-m-d-H-i-s'),'backup'],date('Y-m-d-H-i-s'));
        $path =storage_path('app/'.$backupFolderName);
        $path = str_replace('\\', '/', $path);
        $fileFullPath =  $path. "/" . $fileName.'.gz';

        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD')
                . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE')
                . "  | gzip.exe > ". $fileFullPath;

        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
    }
}
