<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class generateBulk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $total = 0;

    public string $type = '';

    public int $retry = 3;

    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(int $total, string $type)
    {
        $this->total = $total;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $categories = [];
        Log::info("{$this->type} and {$this->total}");
        if ($this->type == 'categories') {
            for ($i = 1; $i <= $this->total; $i++) {
                $categories[] = [
                    'name' => fake()->name,
                ];
            }

            Category::insert($categories);
        }
        if ($this->type == 'products') {
            $products = [];
            for ($i = 1; $i <= $this->total; $i++) {
                $products[] = [
                    'category_id' => 1,
                    'name' => fake()->name(),
                    'description' => fake()->text(),
                    'price' => fake()->randomDigit,
                ];
            }

            Product::insert($products);
        }
        Log::info('Data inserted successfully');
    }
}
