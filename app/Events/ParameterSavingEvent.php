<?php

namespace App\Events;

use App\Parameter;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ParameterSavingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $parameter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Parameter $parameter)
    {
        $this->parameter = $parameter;
        //dd($parameter->toArray());

    }


}
