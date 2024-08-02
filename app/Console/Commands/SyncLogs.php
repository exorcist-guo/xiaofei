<?php

namespace App\Console\Commands;

use App\IntegralLogs;
use App\Member;
use App\PvLogs;
use Illuminate\Console\Command;

class SyncLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sync-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步日志表到总订单';

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

        while(1){
            for($i=0;$i<20;$i++){
                $list = IntegralLogs::setSuffix($i)->where('bid',0)->limit(10)->get();
                foreach ($list as $log){
                    $data = [
                        'member_id' => $log->member_id,
                        'action' => $log->action,
                        'amount' => $log->amount,
                        'balance_before' => $log->balance_before,
                        'balance_after' => $log->balance_after,
                        'remark' => $log->remark,
                        'related_id' => $log->related_id,
                        'created_at' => $log->created_at,
                        'updated_at' => $log->updated_at,
                    ];
                    $log->bid = IntegralLogs::insertGetId($data);
                    $log->save();
                }

                $list = PvLogs::setSuffix($i)->where('bid',0)->limit(10)->get();
                foreach ($list as $log){
                    $data = [
                        'member_id' => $log->member_id,
                        'action' => $log->action,
                        'amount' => $log->amount,
                        'balance_before' => $log->balance_before,
                        'balance_after' => $log->balance_after ,
                        'remark' => $log->remark ,
                        'related_id' => $log->related_id,
                        'created_at' => $log->created_at,
                        'updated_at' => $log->updated_at,
                    ];
                    $log->bid = PvLogs::insertGetId($data);
                    $log->save();
                }
                usleep(10000);
            }
        }
    }
}
