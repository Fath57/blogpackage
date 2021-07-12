<?php

namespace Arafath57\BlogPackage\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Arafath57\BlogPackage\Tests\TestCase;

class MakeFooCommandTest extends TestCase
{
    /** @test */
    function it_creates_a_new_foo_class()
    {
        // destination path of the Foo class
        $fooClass = app_path('Foo/MyFooClass.php');

        // make sure we're starting from a clean state
        if (File::exists($fooClass)) {
            unlink($fooClass);
        }

        $this->assertFalse(File::exists($fooClass));

        // Run the make command
        Artisan::call('make:foo MyFooClass');

        // Assert a new file is created
        $this->assertTrue(File::exists($fooClass));

        // Assert the file contains the right contents
        $expectedContents = <<<CLASS
<?php

namespace App\Foo;

use Arafath57\BlogPackage\Foo;

class MyFooClass implements Foo
{
    public function myFoo()
    {
        // foo
    }
}
CLASS;

        $this->assertEquals($expectedContents, file_get_contents($fooClass));
    }
}
#