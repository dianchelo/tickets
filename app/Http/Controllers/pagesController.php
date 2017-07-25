<?php

namespace App\Http\Controllers;

class PagesController extends Controller {

	public function getIndex() {
		# process variable data or params
		# talk to the model
		# receive from model
		# compile or process data from the model if needed
		#pass that data to the correct view

		return view('pages.welcome');

	}

	public function getAbout() {
		$first = "Dianchelo";
		$last = "Bazoer";
		$full = $first . " " . $last;
		$email = "dbazoer@gmail.com";

		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $full;

		return view('pages.about')->withData($data);

	}

	public function getContact() {
		return view('pages.contact');
	}

	

}

