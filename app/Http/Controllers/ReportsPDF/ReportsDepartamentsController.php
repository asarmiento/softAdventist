<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 30/08/2017
 * Time: 09:39 PM
 */

namespace App\Http\Controllers\ReportsPDF;


use App\Http\Controllers\ReportPdfController;
use App\Repositories\CheckExpenseRepository;
use App\Repositories\CheckRepository;
use App\Repositories\DepartamentRepository;
use App\Repositories\IncomeAccountRepository;
use App\Repositories\LocalFieldIncomeAccountRepository;
use App\Repositories\LocalFieldIncomeRepository;
use App\Repositories\WeeklyincomeRepository;
use Codedge\Fpdf\Facades\Fpdf;

/**
 * Class ReportsDepartamentsController
 * @package App\Http\Controllers\ReportsPDF
 */
class ReportsDepartamentsController extends ReportPdfController
{
    /**
     * @var DepartamentRepository
     */
    private $departamentRepository;
    /**
     * @var LocalFieldIncomeAccountRepository
     */
    private $localFieldIncomeAccountRepository;
    /**
     * @var IncomeAccountRepository
     */
    private $incomeAccountRepository;
    /**
     * @var WeeklyincomeRepository
     */
    private $weeklyincomeRepository;
    /**
     * @var LocalFieldIncomeRepository
     */
    private $localFieldIncomeRepository;
    /**
     * @var CheckRepository
     */
    private $checkRepository;
    /**
     * @var CheckExpenseRepository
     */
    private $checkExpenseRepository;

    /**
     * ReportsDepartamentsController constructor.
     * @param LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository
     * @param IncomeAccountRepository $incomeAccountRepository
     * @param WeeklyincomeRepository $weeklyincomeRepository
     * @param LocalFieldIncomeRepository $localFieldIncomeRepository
     * @param CheckRepository $checkRepository
     * @param CheckExpenseRepository $checkExpenseRepository
     * @param DepartamentRepository $departamentRepository
     */
    public function __construct(LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository,
                                IncomeAccountRepository $incomeAccountRepository,
                                WeeklyincomeRepository $weeklyincomeRepository,
                                LocalFieldIncomeRepository $localFieldIncomeRepository,
                                CheckRepository $checkRepository,
                                CheckExpenseRepository $checkExpenseRepository, DepartamentRepository $departamentRepository)
    {
        parent::__construct($localFieldIncomeAccountRepository, $incomeAccountRepository, $weeklyincomeRepository, $localFieldIncomeRepository, $checkRepository, $checkExpenseRepository);
        $this->departamentRepository = $departamentRepository;
        $this->localFieldIncomeAccountRepository = $localFieldIncomeAccountRepository;
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->weeklyincomeRepository = $weeklyincomeRepository;
        $this->localFieldIncomeRepository = $localFieldIncomeRepository;
        $this->checkRepository = $checkRepository;
        $this->checkExpenseRepository = $checkExpenseRepository;
    }

    /**
     * ----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-08-30
     * @TimeCreate: 9:41pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * @param string $orientacion
     * @param string $page
     * @param $title
     * @param $date
     * @var ${TYPE_NAME}
     * ----------------------------------------------------------------------
     * @return string
     * ----------------------------------------------------------------------
     *
     */
    public function headerChurch($orientacion = 'P', $page = 'letter', $title, $date)
    {
        return parent::headerChurch($orientacion, $page, $title, $date); // TODO: Change the autogenerated stub
    }

    public function pdfSummaryMoveDepartament($token)
    {
        try {
            $departamen = $this->departamentRepository->token($token);
            $this->headerChurch('p', 'letter', 'Resumen Del Departamento '.$departamen->listDepartament->name, '2017-08-30');

            $pdf = Fpdf::Ln();
            $pdf .= Fpdf::SetX(5);
            $pdf .= Fpdf::SetFont('Arial', 'B', 14);
            $pdf .= Fpdf::Cell(160, 7, 'Departamento: ' . $departamen->listDepartament->name, 0, 0, 'L');
            $pdf .= Fpdf::Cell(40, 7, 'Saldo Disponible: ' . number_format($departamen->balance, 2), 0, 1, 'R');
            $pdf .= Fpdf::SetFont('Arial', 'B', 12);
            $pdf .= Fpdf::Ln();
            $pdf .= Fpdf::SetX(15);
            $pdf .= Fpdf::Cell(100, 7, 'Nombre de Cuentas', 0, 0, 'L');
            $pdf .= Fpdf::Cell(40, 7, 'Salidas', 0, 0, 'C');
            $pdf .= Fpdf::Cell(40, 7, 'Ingresos', 0, 1, 'C');
            foreach ($departamen->incomeAccounts AS $incomeAccount):
                $pdf .= Fpdf::SetFont('Arial', 'I', 12);
                foreach ($incomeAccount->expensesAccounts AS $expenseAccount):
                    $pdf .= Fpdf::SetX(15);
                    $pdf .= Fpdf::Cell(100, 7, $expenseAccount->name, 0, 0, 'L');
                    $pdf .= Fpdf::Cell(40, 7, number_format($expenseAccount->balance, 2), 0, 0, 'C');
                    $pdf .= Fpdf::Cell(40, 7, '', 0, 1, 'C');
                endforeach;
                $pdf .= Fpdf::SetX(25);
                $pdf .= Fpdf::Cell(90, 7, $incomeAccount->name, 0, 0, 'L');
                $pdf .= Fpdf::Cell(40, 7, '', 0, 0, 'C');
                $pdf .= Fpdf::Cell(40, 7, number_format($incomeAccount->balance, 2), 0, 1, 'C');
            endforeach;
            $pdf .= Fpdf::SetFont('Arial', 'B', 13);
            $pdf .= Fpdf::SetX(25);
            $pdf .= Fpdf::Cell(90, 7, 'Total:', 0, 0, 'L');
            $pdf .= Fpdf::Cell(40, 7, number_format($incomeAccount->expensesAccounts()->sum('balance'), 2), 0, 0, 'C');
            $pdf .= Fpdf::Cell(40, 7, number_format($departamen->incomeAccounts()->sum('balance'), 2), 0, 1, 'C');
            $this->sacr();
            Fpdf::Output('Informe-gastos.pdf', 'I');
            exit;
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }
}