<?php

namespace App\Mail;

use App\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $employee;
    protected $request;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Employee $employee, Request $request)
    {
        $this->employee = $employee;
        $this->request  = $request;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.profile.changed')
                    ->with([
                               'employee' => $this->employee,
                               'request'  => $this->request,
                           ]);
    }

}
