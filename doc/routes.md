!!! attention simple view / GET page
!!! note form
!!! todo interactive routes
!!! danger delete routes

## Public

!!! attention home 
    - Http Verb : ANY
    - Name : home
    - Description : homepage
    - Controller : src/Controller/Openspace/IndexController.php
    - Method : index
    - View : templates/public/index.html.twig
    - Entity : 

!!! note login
    - Http Verb : [GET|POST]
    - Name : security_login
    - Controller : src/Controller/SecurityController.php
    - Method : login
    - View : templates/security/login.html.twig
    - Entity : User

!!! todo logout
    - Http Verb : ANY
    - Name : security_logout
    - Controller : src/Controller/SecurityController.php
    - Method : logout
    - View : //
    - Entity : //

!!! note signup
    - Http Verb : [GET|POST]
    - Name : member_signup
    - Controller : src/Controller/MemberController.php
    - Method : signup
    - View : templates/member/signup.html.twig
    - Entity : User

!!! attention signup success
    - Http Verb : [GET]
    - Name : member_signup_success
    - Description : renders a bravo page when signup is done properly
    - Controller : src/Controller/MemberController.php
    - Method : signupSuccess
    - View : templates/member/signup-success.html.twig
    - Entity : //

___
## Privé

!!! attention /me/
    - Http Verb : [GET]
    - Name : dashboard_index
    - Description : index page for the user's private space
    - Controller : src/Controller/Dashboard/DashboardController.php
    - Method : index
    - View : templates/dashboard/index.html.twig
    - Entity : User

!!! attention /me/profile
    - Http Verb : [GET]
    - Name : dashboard_profile
    - Description : user profile
    - Controller : src/Controller/Dashboard/DashboardController.php
    - Method : profile
    - View : templates/dashboard/profile.html.twig
    - Entity : User

!!! note /me/profile-edit
    - Http Verb : [GET|POST]
    - Name : dashboard_profile_edit
    - Description : profile edit
    - Controller : src/Controller/Dashboard/DashboardController.php
    - Method : profileEdit
    - View : templates/dashboard/profile-edit.html.twig
    - Entity : User

!!! danger /me/avatar-delete
    - Http Verb : [GET]
    - Name : dashboard_avatar_edit
    - Description : delete the user's avatar path and file 
    - Controller : src/Controller/Dashboard/DashboardController.php
    - Method : deleteAvatar
    - View : //
    - Entity : User


!!! attention /me/plants/
    - Http Verb : [GET]
    - Name : dashboard_plants
    - Description : see plant list
    - Controller : src/Controller/Dashboard/PlantController.php
    - Method : index
    - View : templates/dashboard/plant/index.html.twig
    - Entity : Plant

!!! note /me/plants/new
    - Http Verb : [GET|POST]
    - Name : dashboard_plant_new
    - Description : add a new plant
    - Controller : src/Controller/Dashboard/PlantController.php
    - Method : new
    - View : templates/dashboard/plant/new.html.twig
    - Entity : Plant

!!! attention /me/plants/{id}
    - Http Verb : [GET]
    - Name : dashboard_plant_show
    - Description : see plant infos
    - Controller : src/Controller/Dashboard/PlantController.php
    - Method : show
    - View : templates/dashboard/plant/show.html.twig
    - Entity : Plant

!!! danger /me/plants/{id}
    - Http Verb : [POST]
    - Name : dashboard_plant_delete
    - Description : delete a plant
    - Controller : src/Controller/Dashboard/PlantController.php
    - Method : delete
    - View : //
    - Entity : Plant

!!! note /me/plants/{id}/edit
    - Http Verb : [GET|POST]
    - Name : dashboard_plant_edit
    - Description : edit plant infos
    - Controller : src/Controller/Dashboard/PlantController.php
    - Method : edit
    - View : templates/dashboard/plant/edit.html.twig
    - Entity : Plant


!!! attention /me/plants/{plantId}/photos/
    - Http Verb : [GET]
    - Name : dashboard_plant_pictures
    - Description : list of pictures for one plant
    - Controller : src/Controller/Dashboard/PictureController.php
    - Method : index
    - View : templates/dashboard/picture/index.html.twig
    - Entity : Plant, Picture

!!! note /me/plants/{plantId}/photos/new
    - Http Verb : [GET|POST]
    - Name : dashboard_picture_new   
    - Description : add a new picture 
    - Controller : src/Controller/Dashboard/PictureController.php
    - Method : new
    - View : templates/dashboard/picture/new.html.twig
    - Entity : Plant, Picture

!!! attention /me/plants/{plantId}/photos/{id}
    - Http Verb : [GET]
    - Name : dashboard_picture_show
    - Description : picture infos
    - Controller : src/Controller/Dashboard/PictureController.php
    - Method : show
    - View : templates/dashboard/picture/show.html.twig
    - Entity : Plant, Picture

!!! danger /me/plants/{plantId}/photos/{id}
    - Http Verb : [POST]
    - Name : dashboard_picture_delete
    - Description : delete a picture
    - Controller : src/Controller/Dashboard/PictureController.php
    - Method : delete
    - View : //
    - Entity : Plant, Picture

!!! note /me/plants/{plantId}/photos/{id}/edit
    - Http Verb : [GET|POST]
    - Name : dashboard_picture_edit
    - Description : edit picture infos
    - Controller : src/Controller/Dashboard/PictureController.php
    - Method : edit
    - View : templates/dashboard/picture/edit.html.twig
    - Entity : Plant, Picture

!!! todo /me/plants/set-cover/{plantId}/{pictureId}
    - HTTP Verb : [GET]
    - Name : dashboard_plant_setcover
    - Description : set cover for the plant folders
    - Methods : setCover
    - View : // (json)
    - Entity : Plant, Picture

## Useless 

!!! attention /users
    - HTTP Verb : [GET]
    - Name : members_index
    - Description : list the members
    - Controller : src/Controller/Openspace/UserController.php
    - Methods : index
    - View : //
    - Entity : User

!!! attention /users/show"
    - HTTP Verb : [GET]
    - Name : user_show
    - Description : show infos of one user
    - Controller : src/Controller/Openspace/UserController.php
    - Methods : show
    - View : // 
    - Entity : User

!!! attention /{userId}/plants"
    - HTTP Verb : [GET]
    - Name : user_plants
    - Description : shows all the plants of 1 user (public version)
    - Controller : src/Controller/Openspace/UserController.php
    - Methods : showUserPlants
    - View : // 
    - Entity : User, Plant

!!! attention /{userId}/plant/{plantId}/photos"
    - HTTP Verb : [GET]
    - Name : user_plant_pictures
    - Description : shows a plant gallery (public version)
    - Controller : src/Controller/Openspace/UserController.php
    - Methods : showUserPlantPictures
    - View : // 
    - Entity : User, Plant, Picture
