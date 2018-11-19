<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Member;

class MemberController extends BaseController
{
	public function info($id) {
		// return 'member-if='.$id;
		// return route('memberinfo');

		return Member::getMember();
		// return view('member/info', array(
		// 	'name' => 'shidun',
		// 	'age' => 18
		// ));
	}
}