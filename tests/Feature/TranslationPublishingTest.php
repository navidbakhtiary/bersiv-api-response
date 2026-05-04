<?php

namespace NBDev\BersivApiResponse\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use NBDev\BersivApiResponse\Providers\BersivApiResponseServiceProvider;
use NBDev\BersivApiResponse\Tests\TestCase;

class TranslationPublishingTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BersivApiResponseServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        File::deleteDirectory($this->getPublishedTranslationPath());
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->getPublishedTranslationPath());

        parent::tearDown();
    }

    public function test_can_publish_translation_files(): void
    {
        $this->assertDirectoryExists($this->getPackageTranslationPath());
        $this->assertFileExists($this->getPackageTranslationPath('en/auths.php'));
        $this->assertFileExists($this->getPackageTranslationPath('en/messages.php'));

        $this->artisan('vendor:publish', [
            '--provider' => BersivApiResponseServiceProvider::class,
            '--tag' => 'bersiv-api-response-translations',
            '--force' => true,
        ])->assertExitCode(0);

        $this->assertFileExists($this->getPublishedTranslationPath('en/auths.php'));
        $this->assertFileExists($this->getPublishedTranslationPath('en/messages.php'));
    }

    public function test_published_translation_files_contain_expected_keys(): void
    {
        $this->artisan('vendor:publish', [
            '--provider' => BersivApiResponseServiceProvider::class,
            '--tag' => 'bersiv-api-response-translations',
            '--force' => true,
        ])->assertExitCode(0);

        $auths_path = $this->getPublishedTranslationPath('en/auths.php');
        $messages_path = $this->getPublishedTranslationPath('en/messages.php');

        $this->assertFileExists($auths_path);
        $this->assertFileExists($messages_path);

        $auths = require $auths_path;
        $messages = require $messages_path;

        $this->assertSame('Logged in successfully.', $auths['successful']['login']);
        $this->assertSame('Authentication is required.', $auths['failures']['unauthenticated']);
        $this->assertSame('Invalid input.', $messages['failures']['invalid_inputs']);
        $this->assertSame('Invalid captcha.', $messages['failures']['invalid_captcha']);
    }

    public function test_translation_publish_path_is_registered(): void
    {
        $paths = LaravelServiceProvider::pathsToPublish(
            BersivApiResponseServiceProvider::class,
            'bersiv-api-response-translations'
        );

        $normalized_paths = [];

        foreach ($paths as $source_path => $target_path) {
            $real_source_path = realpath($source_path);

            $this->assertIsString($real_source_path);

            $normalized_paths[$real_source_path] = $target_path;
        }

        $this->assertArrayHasKey($this->getPackageTranslationPath(), $normalized_paths);

        $this->assertSame(
            $this->getPublishedTranslationPath(),
            $normalized_paths[$this->getPackageTranslationPath()]
        );
    }

    public function test_can_load_namespaced_translations(): void
    {
        $this->assertSame(
            'Logged in successfully.',
            __('bersiv-api-response::auths.successful.login')
        );

        $this->assertSame(
            'Invalid input.',
            __('bersiv-api-response::messages.failures.invalid_inputs')
        );
    }

    private function getPackageTranslationPath(?string $file_name = null): string
    {
        $path = realpath(__DIR__.'/../../lang');

        $this->assertIsString($path);

        if ($file_name === null) {
            return $path;
        }

        return $path.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $file_name);
    }

    private function getPublishedTranslationPath(?string $file_name = null): string
    {
        $path = lang_path('vendor/bersiv-api-response');

        if ($file_name === null) {
            return $path;
        }

        return $path.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $file_name);
    }
}
