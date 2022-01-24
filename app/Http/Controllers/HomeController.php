<?php

namespace App\Http\Controllers;

use App\Interfaces\CompanyRepoInterface;
use App\Interfaces\ContactRepoInterface;

class HomeController extends Controller
{
    private $contactRepo,$companyRepo;
    public function __construct(ContactRepoInterface $contactRepo,CompanyRepoInterface $companyRepo)
    {
        $this->contactRepo=$contactRepo;
        $this->companyRepo=$companyRepo;
    }
    public function index()
    {
        return view('home',['title'=>'Mini-CRM','companies'=>$this->companyRepo->getModel(),'contacts'=>$this->contactRepo->getModel()]);
    }
}
