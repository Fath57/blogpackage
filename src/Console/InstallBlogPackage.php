<?php

namespace Arafath57\BlogPackage\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBlogPackage extends Command
{
    //protected $hidden = true;
    protected $signature = "blogpackage:install";
    protected $description = "Install our blog package";

    public function handle(){
        $this->info("Installing BlogPackage");
        $this->info("Publishing configuration");

        if ($this->configExists('blogpackage.php')){
            $this->publishConfiguration();
            $this->info("Published configuration");
        }else{
            if ($this->shouldOverWriteConfig()){
                $this->info("Overwriting configuration files...");
                $this->publishConfiguration(true);
            }else{
                $this->info("Exiting, configuration  was not overwritten");
            }
        }
    }

    private function configExists($filename): bool
    {
        return File::exists(config_path($filename));
    }

    private function shouldOverWriteConfig(): bool
    {
        return $this->confirm("Config file already exist. Do you want to overwrite it?",false);
}
    private function publishConfiguration($forcePublish = false){
        $params = [
            "--provider"=>"Arafath57\\BlogPackage\\BlogPackageServiceProvider",
            "--tag"=>"config"
            ];

        if ($forcePublish){
            $params['--force'] = '';
        }
        $this->call("vendor:publish",$params);
}
}