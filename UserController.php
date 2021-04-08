/** REVIEWS
  * First the variable $user used in the if is not declared becouse the function only receive a $request  
  * I use ->imput for request
  * Supposed that method isAdmin() is declared 
  *
  *
  *
**/
<?php
class UserController
{
	public function update(Request $request)
	{
    $user = User::find($request->input('user_id');

		if ($user->isAdmin()) {

			if ($request->input('mark_as_active')) {		
				$user->active = true;
				$user->save();		
			} elseif ( $request->input('mark_as_inactiveactive') ) {
				$user->active = false;
				$user->save();
			} elseif ($request->input('first_name') || $request->input('last_name') || $request->input('address') ) {
				$user->first_name = $request->input('first_name') ? $request->input('first_name') : $user->first_name;
				$user->last_name = $request->input('last_name') ? $request->input('last_name') : $user->last_name;
				$user->address = $request->input('address') ? $request->input('address') : $user->address;
				$user->save();
			} 

			return redirect()->back();

		} else {
			abort(400, “you do not have access”);
		}
	}
}
