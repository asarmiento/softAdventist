<?php

namespace App\Http\Controllers\LocalField;

use App\Repositories\BankLocalFieldRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankLocalFieldController extends Controller
{

    /**
     * @var BankLocalFieldRepository
     */
    private $bankLocalFieldRepository;


    /**
     * BankLocalFieldController constructor.
     *
     * @param BankLocalFieldRepository $bankLocalFieldRepository
     */
    public function __construct(BankLocalFieldRepository $bankLocalFieldRepository)
    {

        $this->bankLocalFieldRepository = $bankLocalFieldRepository;
    }


    public function listBankLocalField()
    {
        return $this->bankLocalFieldRepository->listRelationSelects('localField');
    }



}
