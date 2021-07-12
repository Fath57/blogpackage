<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{


    /** @test */
/*    function the_install_command_copies_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('blogpackage.php'))) {
            unlink(config_path('blogpackage.php'));
        }

        $this->assertFalse(File::exists(config_path('blogpackage.php')));

        Artisan::call('blogpackage:install');

        $this->assertTrue(File::exists(config_path('blogpackage.php')));
    }*/

    /** @test */


/*    function when_a_config_file_is_present_users_can_choose_to_not_overwrite_it(){

        // Given we have already have an existing config file
        File::put(config_path('blogpackage.php'),"Test content");
        $this->assertTrue(File::exists(config_path('blogpackage.php')));

        //when we run the install command
        $command = $this->artisan('blogpackage:install');

        //we expect a warning that our configuration file exist
        $command->expectsOutput("Existing configuration was not overwritten");
        //Asset tha the original content of the config remain
        $this->assertEquals(file_get_contents(config_path("blogpackage.php")),"Test content");
        //clean up
        unlink(config_path('blogpackage.php'));
    }*/

    /** @test */

/*    function when_a_config_file_is_present_users_can_choose_to_overwrite_it(){
        //Given we have already have config file
        File::put(config_path('blogpackage.php'),"Test content");
        $this->assertTrue(File::exists(config_path("blogpackage.php")));

        //when we run the install command
        $command = $this->artisan('blogpackage:install');
        $command->expectsQuestion(
            'Config file already exist. Do you want to overwrite it?',
            //When answered with yes
            'yes'
        );
        $command->expectsoutput('Overwriting configuration file...');
        //Assert that the original contents are overwritten
        $this->assertEquals(
            file_get_contents(config_path("blogpackage.php")),
            file_get_contents(__DIR__."/../config/config.php")
        );

        //clean up
        unlink(config_path("blogpackage.php"));
    }*/
}
