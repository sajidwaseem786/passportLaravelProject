<?php 
namespace App\Policies;

class userPolicy{

    public function update($user, $chkedUser){

        return $user->role==$chkedUser->isAdmin();
    }



}
?>