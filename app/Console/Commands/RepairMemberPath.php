<?php

namespace App\Console\Commands;

use App\IntegralLogs;
use App\Member;
use App\PvLogs;
use Illuminate\Console\Command;

class RepairMemberPath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:repair-path';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '修复用户层级关系';

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
        $list = Member::orderBy('id','asc')
//            ->where('id',13)
            ->get();
        foreach ($list as $user){
            $member = Member::find($user->id);
            $this->migrateMemberPath($member);
        }
    }

    public function migrateMemberPath($member)
    {
        $list = Member::wherePid($member->id)->get();
        foreach($list as $child) {
            $child->deep = $member->deep + 1;
            $child->path = $member->path? $member->path . $member->id.'/':'/'.$member->id.'/';
            $child->save();

            $this->migrateMemberPath($child);
        }
    }
}
