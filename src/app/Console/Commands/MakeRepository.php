<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a repository and interface';

    public function handle()
    {
        $name = $this->argument('name');

        $this->createDirectories();
        $this->createInterface($name);
        $this->createRepository($name);
        $this->registerBinding($name);

        $this->info("{$name} Repository and interface created successfully.");
    }

    private function createDirectories(): void
    {
        File::ensureDirectoryExists(app_path('Repositories/Contracts'));
        File::ensureDirectoryExists(app_path('Repositories/Eloquent'));
    }

    private function createInterface(string $name): void
    {
        $path = app_path("Repositories/Contracts/{$name}RepositoryInterface.php");

        $stub = <<<PHP
<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface {$name}RepositoryInterface
{
    public function all(): Collection;

    public function find(int \$id): Model;

    public function create(array \$data): Model;

    public function update(int \$id, array \$data): Model;

    public function delete(int \$id): void;

    public function paginate(int \$perPage = 15, ?int \$page = null): LengthAwarePaginator;
    
    public function setQueryFilters(array \$queryFilters): static;
}

PHP;

        File::put($path, $stub);
    }

    private function createRepository(string $name): void
    {
        $path = app_path("Repositories/Eloquent/{$name}Repository.php");

        $stub = <<<PHP
<?php

namespace App\Repositories\Eloquent;

use App\Models\\{$name};
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\\{$name}RepositoryInterface;

class {$name}Repository extends BaseRepository implements {$name}RepositoryInterface
{
    protected static function getModel(): {$name}
    {
        return new {$name}();
    }
}

PHP;

        File::put($path, $stub);
    }

    private function registerBinding(string $name): void
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');
        $binding = "\$this->app->bind(\\App\\Repositories\\Contracts\\{$name}RepositoryInterface::class, \\App\\Repositories\\Eloquent\\{$name}Repository::class);";

        if (!File::exists($providerPath)) {
            $this->warn("AppServiceProvider not found.");
            return;
        }

        $content = File::get($providerPath);

        if (str_contains($content, $binding)) {
            $this->warn("Binding already exists in AppServiceProvider.");
            return;
        }

        $pattern = '/public function register\(\)\s*:\s*void\s*\{\n/';
        $replacement = "public function register(): void\n    {\n        {$binding}\n";

        $updated = preg_replace($pattern, $replacement, $content);
        File::put($providerPath, $updated);
    }
}
