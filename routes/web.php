<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/', function () use ($args) {//this will throuh error use k bad define argu ho
//     echo $args;
// });

// $args="hello world";
// $router->get('/', function () use ($args) {
//    echo $args;
// });

// $router->get('/user/{id}', function ($id) {//required parameters //argu lazmi pass krna hota//http://localhost/lumon/l5api/public/user/1
//     return 'User '.$id;
// });


// $router->get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {//passing more then one parameter of only numbers
//     //http://localhost/lumon/l5api/public/posts/1/comments/2


// return "post Id: ".$postId." And commented id: ".$commentId;
// });


// $router->get('loginuser[/{name}]', function ($name = null) {//optional parameters mrzi do ya na
// //1 e scope ma 2 routes k name same ni ho skty 
//     if($name==null)
//     return "no parameters given";
//     else
//     return $name;
// });


// $router->get('reguser/{name:[A-Za-z]+}', function ($name) {//regular expresion===> A sy Z ya a z koe b mixture pass kr skty ho or koe ni + mean mixture
//     //

//     return $name;
// });

// $router->get('regIdUser/{name:[0-9]+}', function ($id) {//regular expresion===> A sy Z ya a z koe b mixture pass kr skty ho or koe ni + mean mixture
//     //

//     return $id;
// });

// $router->get('profile', ['as' => 'myprofile', function () {//make another name of route
//     //

//     $url= route('myprofile');
//     return $url;
// }]);



//scope or routes //same name routes //routing in folder structure
// //url should be different controller name agr same hn tu un ko namespace krna ho ga
// $router->get('signupUser','userController@index');
// //1 above calll by//http://localhost/lumon/l5api/public/signupUser

// $router->group(['namespace' => 'Admin'], function() use ($router)
// {
//    $router->get('admin','userController@index');
   
// });
// //2 above call by http://localhost/lumon/l5api/public/admin

// // above both call the same controller but 1 sy open second is under namespace(folder)



// //agr routes name same hn tu but 1 user k andar ho dosra admin k ander tu user k har k saht user/somecontroller and admin k lia admin/saomecontroller likna para ga is ko ktm krny k lia prefix hota ha prifix ma folder ka name da dty hn or us k adar tmam controller usy k smjy jae gy or url ma phly admin ya user liko per route name

// //folder structure k hsab sy url bnaa ho tu
// $router->group(['prefix' => 'admin'], function () use ($router) {//will access admin folder controllers specify admin\routername
//     $router->get('signupUser', function () {
//         return "you are in admin folder";
//     });
//     // http://localhost/lumon/l5api/public/admin/signupUser
// });



// $router->post('/register','userController@register');
// $router->post('/login',['middleware'=>'auth','uses'=>'userController@login']);


$router->group(['prefix' => 'admin','middleware'=>['auth','role:admin']], function () use ($router) {//parameter send role assign admin to middleware to role//auth middleware e pass krna hota ha example hma lumon kud deta ha modification k lia role roleMiddleware ma jae ga
    $router->get('user', function () {
        return "you are  admin confirmed from middleware named as roleMiddleware";
    });
 
});


$router->get('profile',function(){
    return response()->json(array(
        ['message'=>'hello , Message'],
        ['message'=>'Bye, Message'],
        ['message'=>'GoodBye, Message']
    ));
});

$router->post('/register','userController@register');
$router->post('/login','userController@login');
$router->post('/edit/{id}','userController@edit');