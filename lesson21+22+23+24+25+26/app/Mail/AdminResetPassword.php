<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetPassword extends Mailable {
	use Queueable, SerializesModels;
	protected $data = [];
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($data = []) {
		$this->data = $data;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('admin.emails.admin_reset_password')
		            ->subject('Reset Admin Account')
		            ->with('data', $this->data);
	}
}
