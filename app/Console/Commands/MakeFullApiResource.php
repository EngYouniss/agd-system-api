<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeFullApiResource extends Command
{
    /**
     * اسم الأمر اللي رح تستخدمه
     */
    protected $signature = 'make:api-resource {name}';

    /**
     * وصف قصير للأمر
     */
    protected $description = 'Generate Model + Migration + API Controller + Requests + Resource in one command';

    /**
     * تنفيذ الأمر
     */
    public function handle()
    {
        $name = $this->argument('name');

        // 1) Model + Migration + Controller(API) + Requests
        Artisan::call('make:model', [
            'name' => $name,
            '-mcr' => true,
            '--api' => true,
            '--requests' => true,
        ]);

        // 2) Resource
        Artisan::call('make:resource', [
            'name' => $name.'Resource',
        ]);

        $this->info("✅ Full API Resource [$name] generated successfully!");
    }
}
