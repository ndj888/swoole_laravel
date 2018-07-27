<?php

namespace App\Console\Commands;

use com_jjcbs\lib\ServiceFactory;
use ext\lib\framework\MyLaravel;
use ext\lib\framework\MyLaravelS;
use ext\service\TcpClientService;
use Hhxsv5\LaravelS\Illuminate\LaravelSCommand;
use Hhxsv5\LaravelS\LaravelS;
use Illuminate\Console\Command;

class MyLaravelSwooleCommand extends LaravelSCommand
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = (string)$this->argument('action');
        if (!in_array($action, $this->actions, true)) {
            $this->warn(sprintf('LaravelS: action %s is not available, only support %s', $action, implode('|', $this->actions)));
            return;
        }

        $this->isLumen = stripos($this->getApplication()->getVersion(), 'Lumen') !== false;
        $this->loadConfigManually();

        $this->{$action}();
    }

    protected function start()
    {
        $this->outputLogo();

        $svrConf = config('laravels');
        $basePath = array_get($svrConf, 'laravel_base_path', base_path());
        if (empty($svrConf['swoole']['document_root'])) {
            $svrConf['swoole']['document_root'] = $basePath . '/public';
        }
        if (empty($svrConf['process_prefix'])) {
            $svrConf['process_prefix'] = $basePath;
        }
        if (!empty($svrConf['events'])) {
            if (empty($svrConf['swoole']['task_worker_num']) || $svrConf['swoole']['task_worker_num'] <= 0) {
                $this->error('LaravelS: Asynchronous event listening needs to set task_worker_num > 0');
                return;
            }
        }

        $laravelConf = [
            'root_path' => $basePath,
            'static_path' => $svrConf['swoole']['document_root'],
            'register_providers' => array_unique((array)array_get($svrConf, 'register_providers', [])),
            'is_lumen' => $this->isLumen,
            '_SERVER' => $_SERVER,
            '_ENV' => $_ENV,
        ];

//        if (file_exists($svrConf['swoole']['pid_file'])) {
//            $pid = (int)file_get_contents($svrConf['swoole']['pid_file']);
//            if ($this->killProcess($pid, 0)) {
//                $this->warn(sprintf('LaravelS: PID[%s] is already running at %s:%s.', $pid, $svrConf['listen_ip'], $svrConf['listen_port']));
//                return;
//            }
//        }

        // start rpc client
        $com_jjcbs_tcpClient = ServiceFactory::getInstance(TcpClientService::class);
        $com_jjcbs_tcpClient->getRpcClient()->start();
        $laravels = new MyLaravelS($svrConf , $laravelConf , $com_jjcbs_tcpClient);
        $laravels->run();
//        go(function() use($laravelConf,$svrConf,$laravels){
//            // Implements gracefully reload, avoid including laravel's files before worker start
////            $cmd = sprintf('%s %s/GoLaravelS.php', PHP_BINARY, base_path('vendor/hhxsv5/laravel-s/src'));
////            $ret = $this->popen($cmd, json_encode(compact('svrConf', 'laravelConf')));
////            if ($ret === false) {
////                $this->error('LaravelS: popen ' . $cmd . ' failed');
////                return;
////            }
//
//            $pidFile = empty($svrConf['swoole']['pid_file']) ? storage_path('laravels.pid') : $svrConf['swoole']['pid_file'];
//            $fptf = fopen($pidFile , 'w+');
//
//            // Make sure that master process started
//            $time = 0;
//            while (!file_exists($pidFile) && $time <= 20) {
//                \co::sleep(100);
//                $time++;
//            }
//            if (file_exists($pidFile)) {
//                $this->info(sprintf('LaravelS: PID[%s] is running at %s:%s.', \co::fread($fptf), $svrConf['listen_ip'], $svrConf['listen_port']));
//            } else {
//                $this->error(sprintf('LaravelS: PID file[%s] does not exist.', $pidFile));
//            }
//        });

    }


}
