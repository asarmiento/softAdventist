<?php
/**
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 8/9/17
 * Time: 15:55
 */

namespace App\Http\Controllers\LocalField;


use App\Http\Controllers\Controller;
use App\Repositories\LocalFiledRepository;

class LocalFieldController extends Controller
{
    /**
     * @var LocalFiledRepository
     */
    private $localFiledRepository;

    /**
     * LocalFieldController constructor.
     *
     * @param LocalFiledRepository $localFiledRepository
     */
    public function __construct(LocalFiledRepository $localFiledRepository)
    {

        $this->localFiledRepository = $localFiledRepository;
    }

    public function index()
    {
        return $this->localFiledRepository->listSelectsSinFilterChurch();
    }
}