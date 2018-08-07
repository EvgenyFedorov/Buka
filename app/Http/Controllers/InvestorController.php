<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 08.02.2018
 * Time: 16:26
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IUsersRole;
use App\Http\Requests\Request;
use App\Models\FevActivity;
use App\Models\FevBusinessmanProject;
use App\Models\FevInvestmentProject;
use App\Models\FevTicket;
//use Illuminate\Routing\Controller;
use App\Models\FevUser;
use App\Models\FevProject;
use App\Http\Controllers\ErrorsController;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\ApiController;
use App\Models\FevEmailSend;
use App\User;
use App\Models\LoadFileImg;

class InvestorController extends Controller implements IUsersRole{

    private $user;
    private $request;
    private $url;
    private $user_info;
    private $projects_info;
    private $dialogs_info;

    public $advert_id = null;
    public $count_file_limit = 1;
    public $file_dir = 'adverts_investor/';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /*public function __construct(Request $request = null){

        $this->request = $request;
        $this->user = $request->user();

    }*/

    public function passwordsIdentical($input){

        return ($input['passw_investor'] == $input['passw2_investor']) ? true : false;

    }

    public function getTrueIsEmailExist($email){

        $email_exist = FevUser::userEmailExist([
            ['email', '=', $email]
        ]);

        return ($email_exist) ? true : false;

    }

    public function setRequest($request){

        $this->request = $request;

    }

    public function setUserInfo(){

        $this->user = $this->request->user();

    }

    public function initAdvertCreate(){

        self::setUserInfo();
        self::getUser();

        $projects = $this->getProjects();
        $activity_type = $this->getActivityTypes();
        $count_adverts = count($projects);
        $count_dialogs = $this->getCountDialogs();

        return view('investor.advert-create', [
            //'projects' => $projects,
            'activities' => $activity_type,
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs
        ]);

    }

    public function initAdverts(){

        self::setUserInfo();
        self::getUser();

        $projects = $this->getProjects();
        $count_adverts = count($projects);
        $count_dialogs = $this->getCountDialogs();

        return view('investor.adverts', [
            'projects' => $projects,
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs
        ]);

    }

    public function initAdvertsOnId($idp){

        self::setUserInfo();
        self::getUser();

        $projects = $this->getProjectOnId($idp);
        $img = LoadFileImg::getImgOnPath(
            $projects[0]->img_investor_proj,
            $this->user->id
        );
        $activity_type = $this->getActivityTypeOnId($projects[0]->id_investor_activity);
        $sub_activity_type = $this->getSubActivityContent($projects[0]->id_investor_sub_activities);

        $count_adverts = $this->getCountProjects();
        $count_dialogs = $this->getCountDialogs();

        return view('investor.advert-one', [
            'projects' => $projects[0],
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs,
            'activity' => $activity_type[0],
            'sub_activity' => $sub_activity_type,
            'img' => isset($img[0]) ? $img[0] : false
        ]);

    }

    public function initDialogs(){

        self::setUserInfo();
        self::getUser();

        $dialogs = $this->getDialogs();
        $count_adverts = $this->getCountProjects();
        $count_dialogs = count($dialogs);

        //print '<pre>';
        //print_r($dialogs);
        //print '</pre>';

        return view('investor.dialogs', [
            'dialogs' => $dialogs,
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs
        ]);

    }

    public function initDialogsOnId($idd){

        self::setUserInfo();
        self::getUser();

        $dialog = $this->getDialogOnId($idd);
        $count_adverts = $this->getCountProjects();
        $count_dialogs = $this->getCountDialogs();

        print_r($this->user_info);

        return view('investor.dialog-one', [
            'dialog' => $dialog,
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs,
            'user_info' => $this->user_info,
        ]);

    }

    public function initPaymentAdvertOnId($idp){

        self::setUserInfo();
        self::getUser();

        $projects = $this->getProjectOnId($idp);
        $count_adverts = $this->getCountProjects();
        $count_dialogs = $this->getCountDialogs();

        return view('investor.advert-payment', [
            'projects' => $projects[0],
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs,
        ]);

    }

    public function initSetting(){

        self::setUserInfo();
        self::getUser();

        $count_adverts = $this->getCountProjects();
        $count_dialogs = $this->getCountDialogs();

        return view('investor.setting', [
            'name' => $this->user_info[0]->user_info_name,
            'fname' => $this->user_info[0]->user_info_f_name,
            'email' => $this->user_info[0]->email,
            'phone' => $this->user_info[0]->user_info_phone,
            'money' => $this->user_info[0]->user_info_money_summ,
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs,
        ]);

    }
    public function initProfile(){

        self::setUserInfo();
        self::getUser();

        $count_adverts = $this->getCountProjects();
        $count_dialogs = $this->getCountDialogs();

        return view('investor.profile', [
            'count_adverts' => $count_adverts,
            'count_dialogs' => $count_dialogs,
        ]);

    }
    public function getSubActivityContent($ids){

        $sub_activities['input'] = '';

        $array_ids = explode(',', $ids);
        for($i = 0; $i <= count($array_ids); $i++){

            if(!empty($array_ids[$i])){

                $return = $this->getSubActivityTypeOnId($array_ids[$i]);
                $sub_activities['list'][$i]['id_sub_activitie'] = $return[0]->id_sub_activitie;
                $sub_activities['list'][$i]['name_sub_activitie'] = $return[0]->name_sub_activitie;

                $sub_activities['input'] .= '['.$return[0]->id_sub_activitie.'],';

            }

        }

        return $sub_activities;

    }

    public function getViewProgect($idp){

        if(!empty($idp)){

            $this->projects_info = $this->getProjectOnId($idp);

            return view('investor.project', [
                'project' => $this->projects_info,
            ]);

        }else{

            return ErrorsController::getError("Запрашиваемая страница не найдена!");

        }

    }

    public function getViewProjects(){

        $this->projects_info = $this->getProjects();

        return view('investor.projects', [
            'project' => $this->projects_info,
        ]);

    }

    public function getViewDialog($idd){

        if(!empty($idd)){

            $this->dialogs_info = $this->getProjectOnId($idp);

            return view('investor.project', [
                'project' => $this->projects_info,
            ]);

        }else{

            return ErrorsController::getError("Проекта не существует!");

        }

    }

    public function getActivityTypes(){

        return FevActivity::loadActivities([
            ['id_activitie', '>', '1']
        ],
            'id_activitie');

    }

    public function getActivityTypeOnId($ida){

        return FevActivity::loadActivities([
            ['id_activitie', $ida]
        ],
            'id_activitie');

    }

    public function getSubActivityTypes($ida = null){

        return FevActivity::loadSubActivities([
            ['id_activitie', $ida]
        ],
            'id_sub_activitie');

    }

    public function getSubActivityTypeOnId($idsa){

        return FevActivity::loadSubActivities([
            ['id_sub_activitie', $idsa]
        ],
            'id_sub_activitie');

    }

    public function getProjects(){

        // TODO: Implement getProjects() method.

        // 1 аргумент - where, 2 аргумент - order by, 3 аргумент - limit
        return FevInvestmentProject::loadProjects([
                ['id_user_investor_proj', $this->user->id]
            ],
            'updated_at_investor_proj',
            '100');

    }
    public function getCountProjects(){

        // TODO: Implement getProjects() method.

        // 1 аргумент - where
        return FevInvestmentProject::loadCountProjects([
            ['id_user_investor_proj', $this->user->id]
        ]);

    }
    public function getInvestorProjectPhone($idp){

        return FevInvestmentProject::loadProjectsInPageOne([
            ['id_investor_proj', '=', $idp],
            ['status_investor_proj', '<>', 3]
        ],
            'updated_at_investor_proj');

    }
    public function getBusinessProjectPhone($idp){

        return FevBusinessmanProject::loadProjectsInPageOne([
            ['id_business_proj', '=', $idp],
            ['status_business_proj', '<>', 3]
        ],
            'updated_at_business_proj');

    }
    public function getInvestorProjectForDialog($idp){

        return FevInvestmentProject::loadProjectsInPageOne([
            ['id_investor_proj', '=', $idp],
            ['status_investor_proj', '<>', 3]
        ],
            'updated_at_investor_proj');

    }
    public function getBusinessProjectForDialog($idp){

        return FevBusinessmanProject::loadProjectsInPageOne([
            ['id_business_proj', '=', $idp],
            ['status_business_proj', '<>', 3]
        ],
            'updated_at_business_proj');

    }
    public function getProjectOnId($idp){

        // TODO: Implement getProjectOnId() method.

        // 1 аргумент - where, 2 аргумент - order by
        return FevInvestmentProject::loadProject([
                ['id_user_investor_proj', $this->user->id],
                ['id_investor_proj', $idp],
            ],
            'id_investor_proj');

    }
    public function paymentInProfile($input, $api){

        $array_sum = array(1 => 1499, 2 => 900, 3 => 500);

        if(isset($array_sum[$input['type_adverts']]) AND !empty($array_sum[$input['type_adverts']])){

            if($this->user_info[0]->user_info_money_summ >= $array_sum[$input['type_adverts']]){

                $sum_update = ($this->user_info[0]->user_info_money_summ - $array_sum[$input['type_adverts']]);

                $update = FevUser::updateUserInfoTbl($this->user->id, array(
                    'user_info_money_summ' => $sum_update
                ));

                return ($update) ? true : false;

            }else{

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'На вашем счете недостаточно средств!');

                return false;

            }

        }else{

            $api->setData('error_status', 'true');
            $api->setData('error_message', 'Передан не правильный параметр!');

            return false;

        }

    }
    public function getCountDialogs(){

        // TODO: Implement getProjects() method.

        // 1 аргумент - where
        return FevTicket::loadCountDialog([
            ['id_from_user', $this->user->id]
        ],[
            ['id_to_user', $this->user->id]
        ]);

    }
    public function getDialogs(){

        // TODO: Implement getDialogs() method.
        return FevTicket::loadDialogs([
            ['id_from_user', $this->user->id]
        ],[
            ['id_to_user', $this->user->id]
        ],
            'updated_ticket_at',
            '100');

    }
    public function getDialogOnId($idd){

        // TODO: Implement getDialogOnId() method.
        // 1 аргумент - where, 2 аргумент - order by
        return FevTicket::loadDialog([
            ['id_ticket', $idd],
            ['id_from_user', $this->user->id],
        ],[
            ['id_ticket', $idd],
            ['id_to_user', $this->user->id],
        ],
            'created_message_at');

    }
    public function getUserId(){

        return $this->user->id;

    }
    public function getUser($idu = null){

        // TODO: Implement getUser() method.

        if($idu === null)
            $this->user_info = FevUser::getUserInfoOnId($this->user->id);
        else
            $this->user_info = FevUser::getUserInfoOnId($idu);

    }
    public function getUserInfo(){

        return $this->user_info;

    }
    public function setProject($input){

        $input['id_user'] = $this->user->id;
        $input['sub_activity'] = str_replace('[', '', str_replace(']', '', $input['sub_activity']));
        $this->advert_id = FevInvestmentProject::addProject($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function updateProject($input){

        $input['id_user'] = $this->user->id;
        $input['sub_activity'] = str_replace('[', '', str_replace(']', '', $input['sub_activity']));
        $this->advert_id = FevInvestmentProject::updateProject($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function updateProjectImg($input){

        $input['id_user'] = $this->user->id;
        $this->advert_id = FevInvestmentProject::updateProjectImg($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function updateProjectStatus($input, $status){

        $input['id_user'] = $this->user->id;
        $input['status'] = $status;
        $this->advert_id = FevInvestmentProject::updateProjectStatus($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function updateProjectFeedBacks($input){

        $this->advert_id = FevInvestmentProject::updateProjectFeedBack($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function updateProjectViews($input){

        $this->advert_id = FevInvestmentProject::updateProjectFeedBack($input);

        return ($this->advert_id) ? $this->advert_id : false;

    }
    public function setMessage($data){

        $id_message = FevTicket::addMessage(array(
            'id_from_user' => $this->user->id,
            'id_ticket' => $data['id_dialog'],
            'message' => $data['message']
        ));

        return ($id_message) ? $id_message : false;

    }
    public function setDialog($data){

        // TODO: Implement setDialog() method.

        $id_ticket = FevTicket::addDialog(array(
            'id_from_user' => $this->user->id,
            'id_to_user' => $data['id_to_user'],
            'id_advert' => $data['id_advert'],
            'theme' => $data['theme']
        ));

        $id_message = FevTicket::addMessage(array(
            'id_from_user' => $this->user->id,
            'id_ticket' => $id_ticket,
            'message' => $data['message']
        ));

        return ($id_ticket AND $id_message) ? $id_ticket : false;

    }
    public function setUser(){

        // TODO: Implement setUser() method.

    }

    public function registration($input){

        $email = new FevEmailSend();
        $email->data_email['confirm_link'] = FevUser::getGenerationCode(10, 15);
        $email->email_title = "Подтверждение регистрации";
        //$email->email_address_to = $input['real_email'];

        //$email->tmp_email = (isset($input['cart_reg']) ? "emailto.confirm-email-reg-cart" : "emailto.confirm-email-reg");
        $invite_code = FevUser::getGenerationCode(10, 15);

        $registration_user_id = FevUser::createUser(array(
            'email' => $input['mail_investor'],
            'password' => $input['passw_investor'],
            'confirm_link' => $email->data_email['confirm_link'],
            'invite_code' => $invite_code,
            'user_ranks' => $input['tarif_investor'],
            'id_group' => 2,
        ));

        $add_user_info = FevUser::addUserInfo(array(
            'id' => $registration_user_id,
            'name' => $input['name_investor'],
            'fname' => $input['fname_investor'],
            'user_phone' => $input['phone_investor'],
            'user_info_money_summ' => '0',
        ));

        return ($add_user_info) ? true : false;

    }

}