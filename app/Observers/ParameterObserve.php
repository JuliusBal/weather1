<?php

namespace App\Observers;

use App\Mail\SendWindChangeMail;
use App\Parameter;

class ParameterObserve
{
    /**
     * Handle the parameter "created" event.
     *
     * @param  \App\Parameter $parameter
     * @return void
     */
    public function created(Parameter $parameter)
    {
        //
    }

    /**
     * Handle the parameter "updated" event.
     *
     * @param  \App\Parameter $parameter
     * @return void
     */
    public function updated(Parameter $parameter)
    {

    }

    /**
     * Handle the parameter "deleted" event.
     *
     * @param  \App\Parameter $parameter
     * @return void
     */
    public function deleted(Parameter $parameter)
    {
        //
    }

    /**
     * Handle the parameter "restored" event.
     *
     * @param  \App\Parameter $parameter
     * @return void
     */
    public function restored(Parameter $parameter)
    {
        //
    }

    /**
     * Handle the parameter "force deleted" event.
     *
     * @param  \App\Parameter $parameter
     * @return void
     */
    public function forceDeleted(Parameter $parameter)
    {
        //
    }
}
