<?php
	
	namespace App\Mail;
	
	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;
	
	class InfosChurchsLocalField extends Mailable
	{
		use Queueable, SerializesModels;
		
		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			//
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build()
		{
			return $this->view('emails.infoLocalFields')
				->from(userChurch()->email, userChurch()->name)
				->subject('Informes de '.userChurch()->name)
				->attach(route('reportWeekly','eyJpdiI6InFRWllYcytCRkFVd2M2QWg5MmQ1THc9PSIsInZhbHVlIjoibkhxblM4R1lLTGtTNmIwMWkxR296VG1MOEZRRFhwK1NKMlIyXC9lbnZSTFU9IiwibWFjIjoiZmRmYmU2MDk4NjRkNWQ2ZmEzYzVmMzE4NDQzZjRkZWUyZTkwYTcwYTM5ZWYwOGNiZmY5ZTBkOGU3YTgwMjY0YSJ9'));
		}
	}
