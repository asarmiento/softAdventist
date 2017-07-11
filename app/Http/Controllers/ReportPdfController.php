<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;
use App\Entities\WeeklyIncome;
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
     * ReportPdfController constructor.
     *
     * @param LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository
     * @param IncomeAccountRepository           $incomeAccountRepository
     * @param WeeklyincomeRepository            $weeklyincomeRepository
     * @param LocalFieldIncomeRepository        $localFieldIncomeRepository
     */
    public function __construct(
        LocalFieldIncomeAccountRepository $localFieldIncomeAccountRepository,
        IncomeAccountRepository $incomeAccountRepository,
        WeeklyincomeRepository $weeklyincomeRepository,
        LocalFieldIncomeRepository $localFieldIncomeRepository
    ) {

        $this->localFieldIncomeAccountRepository = $localFieldIncomeAccountRepository;
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->weeklyincomeRepository = $weeklyincomeRepository;
        $this->localFieldIncomeRepository = $localFieldIncomeRepository;
    }


    public function infoSemanal($date)
    {
        //$date = new Carbon($data);


        $this->header($date);
        $pdf    = Fpdf::SetFont('Arial','B',7);
        $pdf    .= Fpdf::SetX(5);
        $pdf  .= Fpdf::Cell(5,7,utf8_decode('N°'),1,0,'C');
        $i=0;
        $fixs = $this->titleInfo($date);
        foreach($fixs AS $fix): $i++;
            if($fix=='Nombres'):
                $pdf  .= Fpdf::Cell(40,7,substr(utf8_decode($fix),0,8),1,0,'C');
            else:
                $pdf  .= Fpdf::Cell(13,7,substr(utf8_decode($fix),0,8),1,0,'C');
            endif;
        endforeach;
        $pdf  .= Fpdf::ln();
        $e =0;
        $fin = 0;
        /* NUMERACION DEL INFORME */
        $numeration = $this->numerationInfoPdf($date);
        $pdf    .= Fpdf::SetFont('Arial','B',17);
        $pdf    .= Fpdf::SetTextColor(242,66,21);
        $pdf    .= Fpdf::Text(158,27,utf8_decode('N° ').$numeration,'B',7);
        $pdf    .= Fpdf::SetTextColor(0,0,0);
        $pdf  .= Fpdf::SetFont('Arial','I',7);
        /*CONTENIDO DE SOBRES Y MIEMBROS*/
        $envelopes = $this->listMemberInforme($date);
        foreach($envelopes AS $envelope):
            $pdf  .= Fpdf::SetFont('Arial','I',7);
               $e++;
                $pdf  .= Fpdf::SetX(5);
                $pdf  .= Fpdf::Cell(5,5,utf8_decode($e),1,0,'C');
                foreach ($envelope['datos'] AS $dato):
                    if(strlen($dato)>10 ):
                        $pdf  .= Fpdf::Cell(40,5,(utf8_decode($dato)),1,0,'L');
                    else:
                        $pdf  .= Fpdf::Cell(13,5,(utf8_decode($dato)),1,0,'C');
                    endif;
                endforeach;
                $pdf  .= Fpdf::ln();
        endforeach;
        /*fIN DE SOBRES Y MIEMBROS*/
        $pdf  .= Fpdf::SetFont('Arial','B',6.5);
        $pdf  .= Fpdf::SetX(5);
        $pdf  .= Fpdf::Cell(58,7,'TOTALES _  _  _  _  _  _',0,0,'R');
        foreach ($this->totalesInforme($date) AS $total):
            $pdf  .= Fpdf::Cell(13,7,($total),1,0,'C');
        endforeach;
        $pdf  .= Fpdf::ln();
        $pdf  .= Fpdf::ln();
        $Y= Fpdf::GetY();


        $y     = Fpdf::GetY();

        if($y >=210 && $y <=220):
            $pdf  .= Fpdf::ln();
            $pdf  .= Fpdf::ln();
            $pdf  .= Fpdf::ln();
            $pdf  .= Fpdf::ln();
            $pdf  .= Fpdf::ln();
            $pdf  .= Fpdf::ln();
            $y     = Fpdf::GetY();
        endif;

        $pdf .= $this->footer($date);
        Fpdf::SetY($Y);
        $pdf .= $this->firmas($date);
        Fpdf::Output('Informe-Semanal: '.$date.'.pdf','I');
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
     * @param $date
     * ----------------------------------------------------------------------
     *
     * @return string
     * ----------------------------------------------------------------------
     */
    public function header($date)
    {
        $orientacion = $this->columnAccounts($date);
        $pdf  = Fpdf::AddPage($orientacion,'letter');
        $pdf .= Fpdf::SetFont('Arial','B',16);
        $pdf .= Fpdf::Cell(0,7,utf8_decode('Asociación Central Sur de Costa Rica de los Adventista del Séptimo Día'),0,1,'C');
        $pdf .= Fpdf::SetFont('Arial','',12);
        $pdf .= Fpdf::Cell(0,7,utf8_decode('Apartado 10113-1000 San José, Costa Rica'),0,1,'C');
        $pdf .= Fpdf::Cell(0,7,utf8_decode('Teléfonos: 2224-8311 Fax:2225-0665'),0,1,'C');
        $pdf .= Fpdf::Cell(0,7,utf8_decode('acscrtesoreria07@gmail.com acscr_tesoreria@hotmail.com'),0,1,'C');
        $pdf .= Fpdf::SetFont('Arial','B',16);
        $pdf .= Fpdf::Cell(0,7,utf8_decode('Control Semanal de Diezmos y Ofrendas'),0,1,'C');
        $pdf .= Fpdf::SetFont('Arial','',12);
        $pdf .= Fpdf::Setx(5);
        $pdf .= Fpdf::Cell(0,7,'Iglesia:  Quepos                                                            Fecha:  '.$date,0,1,'L');
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
     * @param $date
     * ----------------------------------------------------------------------
     *
     * @return string
     * ----------------------------------------------------------------------
     */
    public function footer($date)
    {
        $envelopes = $this->countEnvelopeList($date);
        $pdf = Fpdf::SetFont('Arial','',8);
        $pdf  .= Fpdf::Cell(45,5,utf8_decode('DIEZMOS'),0,0,'L');
        $tithes = $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes,'diez');
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($tithes,2),0,1,'L');
        $offren = $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes,'offren');
        $pdf  .= Fpdf::Cell(45,5,utf8_decode('20% MUNDIAL'),0,0,'L');
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($offren/2,2),0,1,'L');
        $pdf  .= Fpdf::Cell(45,5,utf8_decode('20% DESARROLLO'),0,0,'L');
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($offren/2,2),0,1,'L');
        $localfields = $this->localFieldIncomeAccountRepository->getType('temp');
        //aqui agregamos en el array los datos de las cuentas que van para el campo local
        foreach ($localfields AS $localfieldIncome):
            $list = $this->localFieldIncomeRepository->sumInEnvelope($envelopes,$localfieldIncome->id);
            if($list > 0):
                $pdf  .= Fpdf::Cell(45,5,utf8_decode(strtoupper($localfieldIncome->name)),0,0,'L');
                $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($list,2),0,1,'L');
            endif;
        endforeach;
        $campoLocal = $this->localFieldIncomeRepository->sumInInfo($envelopes);
        $pdf = Fpdf::SetFont('Arial','B',9);
        $pdf  .= Fpdf::Cell(60,5,utf8_decode('TOTAL ASOCIACION'),0,0,'L');
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($campoLocal,2),0,1,'L');
        $pdf  .= Fpdf::ln();
        $pdf  .= Fpdf::Cell(65,5,utf8_decode('FONDOS LOCALES 60% PRESUPUESTO'),0,0,'L');
        $church = $this->weeklyincomeRepository->sumInInfo($envelopes);
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('¢ ').number_format($church,2),0,1,'L');
        return $pdf;
    }
    public function firmas($date)
    {
        //
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('______________________________'),0,1,'L');
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(50,5,utf8_decode('Tesorero'),0,1,'C');
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('______________________________'),0,1,'L');
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(50,5,utf8_decode('Pastor o Anciano'),0,1,'C');
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(30,5,utf8_decode('______________________________'),0,1,'L');
        $pdf = Fpdf::SetX(120);
        $pdf  .= Fpdf::Cell(50,5,utf8_decode('Dir. Mayordomia o Diacono'),0,1,'C');
        $pdf  .= Fpdf::ln();
        $pdf  .= Fpdf::Cell(40,5,utf8_decode('Diccionario de Cuentas:'),0,0,'L');
        $titles = $this->titleInfo($date);
        $i=0;
        foreach ($titles as $title):$i++;
            if($i>5):
            $pdf  .= Fpdf::Cell(40,7,substr(utf8_decode($title),0,8) .' = '.
                utf8_decode($title),0,'L');
            endif;
        endforeach;


    }
    private function columnAccounts($date)
    {
        $internal = InternalControl::where('church_id',1)->where('saturday',$date)->first();
        $fixs = $internal->localFieldIncomeAccounts()->groupBy('local_field_income_account_id')->count();

        if($fixs <= 10):
            $orientacion = 'P';
        else:
            $orientacion = 'L';
        endif;
    }
}
