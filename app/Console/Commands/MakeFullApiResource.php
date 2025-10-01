<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeFullApiResource extends Command
{
    protected $signature = 'make:api-resource {name} {--folder=Api}';
    protected $description = 'Generate Model + Migration + API Controller (in custom folder using controller.model.api.stub) + Requests + Resource';

    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->option('folder') ?: 'Api';

        // 1) Model + Migration + Controller(API) + Requests
        Artisan::call('make:model', [
            'name' => $name,
            '--migration' => true,
            '--controller' => true,
            '--api' => true,
            '--requests' => true,
        ]);

        // 2) Resource
        Artisan::call('make:resource', [
            'name' => $name . 'Resource',
        ]);

        // 3) نقل الكونترولر إلى المجلد المحدد وتعديل الـ namespace
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        $targetFolder = app_path("Http/Controllers/{$folder}");
        $targetPath = $targetFolder . "/{$name}Controller.php";

        if (!is_dir($targetFolder)) {
            mkdir($targetFolder, 0755, true);
        }

        if (file_exists($controllerPath)) {
            rename($controllerPath, $targetPath);

            $content = file_get_contents($targetPath);
            $content = str_replace(
                "namespace App\Http\Controllers;",
                "namespace App\Http\Controllers\\{$folder};",
                $content
            );
            file_put_contents($targetPath, $content);

            $this->info("📂 Controller moved to {$folder} folder: {$targetPath}");
        } else {
            $this->warn("⚠️ Controller not found at {$controllerPath}");
        }

        $this->info("✅ Full API Resource [$name] generated successfully in {$folder} folder!");
    }
}
