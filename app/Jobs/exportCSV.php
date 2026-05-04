<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class exportCSV implements ShouldQueue
{
    use Queueable;

    public string $type = '';

    public int $retry = 3;

    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Type: {$this->type}");
        $storageDisk = Storage::disk('local');
        if ($this->type === 'categories') {
            $categories = Category::all()->toArray();
            $handler = 'categories.csv';
            $csvFile = fopen($handler, 'w+');
            $header = array_keys((array) $categories[0]);
            fputcsv($csvFile, $header);

            foreach ($categories as $category) {
                fputcsv($csvFile, (array) $category);
            }

            fclose($csvFile);
            $output = stream_get_contents($csvFile);
            $storageDisk->putFileAs('categories.csv', $output);
        }
    }
}
