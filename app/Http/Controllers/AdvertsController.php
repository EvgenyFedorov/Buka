<?php

namespace App\Http\Controllers;

use App\Models\FevBusinessmanProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ErrorsController;
use App\Models\FevInvestmentProject;
use App\Http\Controllers\InvestorController;

Class AdvertsController extends Controller
{
    private $user;
    private $request;
    private $input;
    private $investor = null;
    private $businessman = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $this->request->user();
        $this->input = $this->request->input();
    }

    public function initInvestorAdverts($menu = null){

        $projects = FevInvestmentProject::loadProjectsInPage([
            ['status_investor_proj', '<>', 3]
        ],
            'updated_at_investor_proj',
            '500');

        return view('adverts.investor-adverts', [
            'projects' => $projects,
        ]);

    }

    public function initBusinessmanAdverts($menu = null){

        $projects = FevBusinessmanProject::loadProjectsInPage([
            ['status_business_proj', '<>', 3]
        ],
            'updated_at_business_proj',
            '500');

        return view('adverts.business-adverts', [
            'projects' => $projects,
        ]);

    }

    public function initInvestorAdvertsOne($advert_id){

        $projects = FevInvestmentProject::loadProjectsInPageOne([
            ['id_investor_proj', '=', $advert_id],
            ['status_investor_proj', '<>', 3]
        ],
            'updated_at_investor_proj');

        if($projects[0]->type_investor_proj == '1'){

            $rand_min = 1;
            $rand_max = 15;

        }elseif($projects[0]->type_investor_proj == '2'){

            $rand_min = 1;
            $rand_max = 10;

        }else{

            $rand_min = 1;
            $rand_max = 3;

        }

        $data = array('id_advert' => $advert_id, 'views' => ($projects[0]->views_investor_proj + rand($rand_min, $rand_max)));

        FevInvestmentProject::updateProjectViews($data);

        $this->investor = new InvestorController();
        $sub_activity_type = $this->investor->getSubActivityContent($projects[0]->id_investor_sub_activities);

        $projects[0]->views_investor_proj = $data['views'];

        return view('adverts.investor-adverts-one', [
            'project' => $projects[0],
            'sub_activity' => $sub_activity_type,
            'user' => $this->user,
            //'user' => $this->user['id_group'],
        ]);

    }

    public function initBusinessmanAdvertsOne($advert_id){

        $projects = FevBusinessmanProject::loadProjectsInPageOne([
            ['id_business_proj', '=', $advert_id],
            ['status_business_proj', '<>', 3]
        ],
            'updated_at_business_proj');

        if($projects[0]->type_business_proj == '1'){

            $rand_min = 1;
            $rand_max = 15;

        }elseif($projects[0]->type_business_proj == '2'){

            $rand_min = 1;
            $rand_max = 10;

        }else{

            $rand_min = 1;
            $rand_max = 3;

        }

        $data = array('id_advert' => $advert_id, 'views' => ($projects[0]->views_business_proj + rand($rand_min, $rand_max)));

        FevBusinessmanProject::updateProjectViews($data);

        $this->businessman = new BusinessController();
        $sub_activity_type = $this->businessman->getSubActivityContent($projects[0]->id_business_sub_activities);

        $projects[0]->views_business_proj = $data['views'];

        return view('adverts.business-adverts-one', [
            'project' => $projects[0],
            'sub_activity' => $sub_activity_type,
            'user' => $this->user,
            //'user' => $this->user['id_group'],
        ]);

    }

}
