<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 07/09/2017
 * Time: 10:42 PM
 */

namespace App\Http\Controllers;
use App\Repositories\CountryRepository;


/**
 * Class CountryController
 * @package app\Http\Controllers
 */
class CountryController extends Controller
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * CountryController constructor.
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {

        $this->countryRepository = $countryRepository;
    }
    public function index()
    {
        return $this->countryRepository->listSelectsSinFilterChurch();
    }
}