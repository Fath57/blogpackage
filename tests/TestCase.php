<?php

namespace Arafath57\BlogPackage\Tests;


use Arafath57\BlogPackage\BlogPackageServiceProvider;
use Arafath57\BlogPackage\Calculator;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app): array
    {
        return [
            BlogPackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_fath_post_categories_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_fath_posts_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_fath_post_comments_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_fath_post_images_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';

        // run the up() method (perform the migration)
        (new \CreateFathPostCategoriesTable())->up();
        (new \CreateFathPostsTable())->up();
        (new \CreateFathPostCommentsTable())->up();
        (new \CreateFathPostImagesTable())->up();
        (new \CreateUsersTable)->up();
    }
}