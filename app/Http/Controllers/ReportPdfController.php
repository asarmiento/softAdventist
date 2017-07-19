<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;
use App\Entities\WeeklyIncome;
use App\Repositories\CheckExpenseRepository;
use App\Repositories\CheckRepository;
use App\Repositories\IncomeAccountRepository;
use App\Repositories\LocalFieldIncomeAccountRepository;
use App\Repositories\LocalFieldIncomeRepository;
use App\Repositories\WeeklyincomeRepository;
use App\Traits\ListInformMembersTraits;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Http\Request;

class ReportPdfController extends Controller
{

    use ListInformMembersTraits;

    //

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
     * ReportPdfController constructor.
     *
     * @param LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository
     * @param IncomeAccountRepository           $incomeAccountRepository
     * @param WeeklyincomeRepository            $weeklyincomeRepository
     * @param LocalFieldIncomeRepository        $localFieldIncomeRepository
     * @param CheckRepository                   $checkRepository
     * @param CheckExpenseRepository            $checkExpenseRepository
     */
    public function __construct(
        LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository,
        IncomeAccountRepository $incomeAccountRepository,
        WeeklyincomeRepository $weeklyincomeRepository,
        LocalFieldIncomeRepository $localFieldIncomeRepository,
        CheckRepository $checkRepository,
        CheckExpenseRepository $checkExpenseRepository
    ) {

        $this->localFieldIncomeAccountRepository = $localFieldIncomeAccountRepository;
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->weeklyincomeRepository = $weeklyincomeRepository;
        $this->localFieldIncomeRepository = $localFieldIncomeRepository;
        $this->checkRepository = $checkRepository;
        $this->checkExpenseRepository = $checkExpenseRepository;
    }


    public function checkDetail($token)
    {
        $data = $this->checkExpenseRepository->getModel()->where('reference', $token)->get();
        if ($data[0]->check_id) {
            $check = $this->checkRepository->find($data[0]->check_id);
            $data = $check->checkExpenses;
            $balance = $check->checkExpenses()->sum('balance');
        } else {
            //$data = $this->checkExpenseRepository->getModel()->where('reference',$token)->get();
            $balance = $this->checkExpenseRepository->getModel()->where('reference', $token)->sum('balance');
        }

        $pdf = Fpdf::AddPage('P', 'letter');
        $pdf .= Fpdf::SetFont('Arial', 'B', 16);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Iglesia Adventista del Séptimo Día de Quepos'), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Informe de Gastos'), 0, 1, 'C');
        if ($data[0]->check_id):
            $pdf .= Fpdf::Cell(0, 7, utf8_decode('Cheque # '.$check->number), 0, 1, 'C');
            $pdf .= Fpdf::Cell(0, 7, utf8_decode('Elaborado  '.$check->date), 0, 1, 'C');
            $pdf .= Fpdf::Ln();
            $pdf .= Fpdf::SetFont('Arial', 'B', 14);
            $pdf .= Fpdf::Cell(100, 7, utf8_decode('Beneficiario: '.$check->name), 0, 0, 'L');
            $pdf .= Fpdf::Cell(90, 7, utf8_decode('Valor:  '.number_format($check->balance, 2)), 0, 1, 'R');
        endif;
        $pdf .= Fpdf::Ln();
        $pdf .= Fpdf::SetFont('Arial', 'B', 12);
        $pdf .= Fpdf::Cell(10, 7, utf8_decode('#'), 1, 0, 'L');
        $pdf .= Fpdf::Cell(60, 7, utf8_decode('# Factura'), 1, 0, 'C');
        $pdf .= Fpdf::Cell(25, 7, utf8_decode('Fecha'), 1, 0, 'C');
        $pdf .= Fpdf::Cell(30, 7, utf8_decode('Monto'), 1, 0, 'C');
        $pdf .= Fpdf::Cell(71, 7, utf8_decode('Cuenta'), 1, 1, 'C');
        $pdf .= Fpdf::SetX(20);
        $pdf .= Fpdf::Cell(186, 7, utf8_decode('Detalle'), 1, 1, 'C');
        $i = 0;

        foreach ($data AS $expens) {
            $i++;
            $pdf .= Fpdf::SetFont('Arial', 'I', 12);
            $pdf .= Fpdf::Cell(10, 7, utf8_decode($i), 1, 0, 'L');
            $pdf .= Fpdf::Cell(60, 7, utf8_decode($expens->number), 1, 0, 'C');
            $pdf .= Fpdf::Cell(25, 7, utf8_decode($expens->date), 1, 0, 'C');
            $pdf .= Fpdf::Cell(30, 7, number_format($expens->balance, 2), 1, 0, 'C');
            $pdf .= Fpdf::Cell(71, 7, utf8_decode($expens->expenseAccount->name), 1, 1, 'C');
            $pdf .= Fpdf::SetX(20);
            $pdf .= Fpdf::SetFont('Arial', 'BI', 11);
            $pdf .= Fpdf::Cell(186, 7, utf8_decode($expens->detail), 1, 1, 'L');
        }
        $pdf .= Fpdf::Cell(95, 7, utf8_decode('Total:'), 1, 0, 'R');
        $pdf .= Fpdf::Cell(30, 7, number_format($balance, 2), 1, 0, 'C');
        $pdf .= Fpdf::Cell(71, 7, utf8_decode(''), 1, 1, 'C');

        $this->sacr();
        Fpdf::Output('Informe-gastos.pdf', 'I');
        exit;
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Aqui tenemos el informe semanal en pdf para las iglesias
     * @Pasos      :
     *
     * @param $date
     * ----------------------------------------------------------------------
     * ----------------------------------------------------------------------
     */
    public function infoSemanal($date)
    {
        //$date = new Carbon($data);

        $this->header($date);
        $pdf = Fpdf::SetFont('Arial', 'B', 7);
        $pdf .= Fpdf::SetX(5);
        $pdf .= Fpdf::Cell(5, 7, utf8_decode('N°'), 1, 0, 'C');
        $i = 0;
        $fixs = $this->titleInfo($date);
        foreach ($fixs AS $fix): $i++;
            if ($fix == 'Nombres'):
                $pdf .= Fpdf::Cell(40, 7, substr(utf8_decode($fix), 0, 8), 1, 0, 'C');
            else:
                $pdf .= Fpdf::Cell(13, 7, substr(utf8_decode($fix), 0, 8), 1, 0, 'C');
            endif;
        endforeach;
        $pdf .= Fpdf::ln();
        $e = 0;
        $fin = 0;
        /* NUMERACION DEL INFORME */
        $numeration = $this->numerationInfoPdf($date);
        $pdf .= Fpdf::SetFont('Arial', 'B', 17);
        $pdf .= Fpdf::SetTextColor(242, 66, 21);
        $pdf .= Fpdf::Text(158, 27, utf8_decode('N° ').$numeration, 'B', 7);
        $pdf .= Fpdf::SetTextColor(0, 0, 0);
        $pdf .= Fpdf::SetFont('Arial', 'I', 7);
        /*CONTENIDO DE SOBRES Y MIEMBROS*/
        $envelopes = $this->listMemberInforme($date);
        foreach ($envelopes AS $envelope):
            $pdf .= Fpdf::SetFont('Arial', 'I', 7);
            $e++;
            $pdf .= Fpdf::SetX(5);
            $pdf .= Fpdf::Cell(5, 5, utf8_decode($e), 1, 0, 'C');
            foreach ($envelope['datos'] AS $dato):
                if (strlen($dato) > 10):
                    $pdf .= Fpdf::Cell(40, 5, substr(utf8_decode($dato), 0, 31), 1, 0, 'L');
                else:
                    $pdf .= Fpdf::Cell(13, 5, (utf8_decode($dato)), 1, 0, 'C');
                endif;
            endforeach;
            $pdf .= Fpdf::ln();
        endforeach;
        /*fIN DE SOBRES Y MIEMBROS*/
        $pdf .= Fpdf::SetFont('Arial', 'B', 6.5);
        $pdf .= Fpdf::SetX(5);
        $pdf .= Fpdf::Cell(58, 7, 'TOTALES _  _  _  _  _  _', 0, 0, 'R');
        foreach ($this->totalesInforme($date) AS $total):
            $pdf .= Fpdf::Cell(13, 7, ($total), 1, 0, 'C');
        endforeach;
        $pdf .= Fpdf::ln();
        $pdf .= Fpdf::ln();
        $Y = Fpdf::GetY();

        $y = Fpdf::GetY();

        if ($y >= 210 && $y <= 220):
            $pdf .= Fpdf::ln();
            $pdf .= Fpdf::ln();
            $pdf .= Fpdf::ln();
            $pdf .= Fpdf::ln();
            $pdf .= Fpdf::ln();
            $pdf .= Fpdf::ln();
            $y = Fpdf::GetY();
        endif;

        $pdf .= $this->footer($date);
        Fpdf::SetY($Y);
        $pdf .= $this->firmas($date);
        $this->sacr();
        Fpdf::Output('Informe-Semanal: '.$date.'.pdf', 'I');
        exit;
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 3:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     *
     * @param $date
     * ----------------------------------------------------------------------
     *
     * @return string
     * ----------------------------------------------------------------------
     */
    public function header($date)
    {
        $orientacion = $this->columnAccounts($date);
        $pdf = Fpdf::AddPage($orientacion, 'letter');
        $pdf .= Fpdf::SetFont('Arial', 'B', 16);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Asociación Central Sur de Costa Rica de los Adventista del Séptimo Día'),
            0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', '', 12);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Apartado 10113-1000 San José, Costa Rica'), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Teléfonos: 2224-8311 Fax:2225-0665'), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('acscrtesoreria07@gmail.com acscr_tesoreria@hotmail.com'), 0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', 'B', 16);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Control Semanal de Diezmos y Ofrendas'), 0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', '', 12);
        $pdf .= Fpdf::Setx(5);
        $pdf .= Fpdf::Cell(0, 7,
            'Iglesia:  Quepos                                                            Fecha:  '.$date, 0, 1, 'L');

        return $pdf;
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 4:03pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     *
     * @param $date
     * ----------------------------------------------------------------------
     *
     * @return string
     * ----------------------------------------------------------------------
     */
    public function footer($date)
    {
        $envelopes = $this->countEnvelopeList($date);
        $pdf = Fpdf::SetFont('Arial', '', 8);
        $pdf .= Fpdf::Cell(45, 5, utf8_decode('DIEZMOS'), 0, 0, 'L');
        $tithes = $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes, 'diez');
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($tithes, 2), 0, 1, 'L');
        $offren = $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes, 'offren');
        $pdf .= Fpdf::Cell(45, 5, utf8_decode('20% MUNDIAL'), 0, 0, 'L');
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($offren / 2, 2), 0, 1, 'L');
        $pdf .= Fpdf::Cell(45, 5, utf8_decode('20% DESARROLLO'), 0, 0, 'L');
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($offren / 2, 2), 0, 1, 'L');
        $localfields = $this->localFieldIncomeAccountRepository->getType('temp');
        //aqui agregamos en el array los datos de las cuentas que van para el campo local
        foreach ($localfields AS $localfieldIncome):
            $list = $this->localFieldIncomeRepository->sumInEnvelope($envelopes, $localfieldIncome->id);
            if ($list > 0):
                $pdf .= Fpdf::Cell(45, 5, utf8_decode(strtoupper($localfieldIncome->name)), 0, 0, 'L');
                $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($list, 2), 0, 1, 'L');
            endif;
        endforeach;
        $campoLocal = $this->localFieldIncomeRepository->sumInInfo($envelopes);
        $pdf = Fpdf::SetFont('Arial', 'B', 9);
        $pdf .= Fpdf::Cell(60, 5, utf8_decode('TOTAL ASOCIACION'), 0, 0, 'L');
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($campoLocal, 2), 0, 1, 'L');
        $pdf .= Fpdf::ln();
        $pdf .= Fpdf::Cell(65, 5, utf8_decode('FONDOS LOCALES 60% PRESUPUESTO'), 0, 0, 'L');
        $church = $this->weeklyincomeRepository->sumInInfo($envelopes);
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('¢ ').number_format($church, 2), 0, 1, 'L');

        return $pdf;
    }


    public function firmas($date)
    {
        //
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('______________________________'), 0, 1, 'L');
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(50, 5, utf8_decode('Tesorero'), 0, 1, 'C');
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('______________________________'), 0, 1, 'L');
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(50, 5, utf8_decode('Pastor o Anciano'), 0, 1, 'C');
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(30, 5, utf8_decode('______________________________'), 0, 1, 'L');
        $pdf = Fpdf::SetX(120);
        $pdf .= Fpdf::Cell(50, 5, utf8_decode('Dir. Mayordomia o Diacono'), 0, 1, 'C');
        $pdf .= Fpdf::ln();
        $pdf .= Fpdf::Cell(40, 5, utf8_decode('Diccionario de Cuentas:'), 0, 0, 'L');
        $titles = $this->titleInfo($date);
        $i = 0;
        foreach ($titles as $title):$i++;
            if ($i > 5):
                $pdf .= Fpdf::Cell(40, 7, substr(utf8_decode($title), 0, 8).' = '.utf8_decode($title), 0, 'L');
            endif;
        endforeach;


    }


    private function columnAccounts($date)
    {
        $internal = InternalControl::where('church_id', 1)->where('saturday', $date)->first();
        $fixs = $internal->localFieldIncomeAccounts()->groupBy('local_field_income_account_id')->count();

        if ($fixs <= 10):
            $orientacion = 'P';
        else:
            $orientacion = 'L';
        endif;
    }


    public function sacr()
    {
        $pdf = Fpdf::SetCreator('Anwar Sarmiento Ramos');
        $pdf .= Fpdf::SetAuthor('Sistemas Amigables de Costa Rica SAOR S.A.');
        $pdf .= Fpdf::SetY(-35);
        // Select Arial italic 8
        $pdf .= Fpdf::SetFont('Arial', 'I', 8);
        // Print current and total page numbers
        $pdf .= Fpdf::Cell(0, 5, utf8_decode('Página '.Fpdf::PageNo()), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 5, utf8_decode('Cortesía Sistemas Amigables de Costa Rica SAOR S.A.'), 0, 0, 'C');

        return $pdf;
    }
}
