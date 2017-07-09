<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportPdfController extends Controller
{
    //
    public function infoSemanal($data)
    {
        $date = new Carbon($data);
        $orientacion = $this->columnAccounts($date);

        $this->header($date->format('d-m-Y'),$orientacion);
        $pdf    = Fpdf::SetFont('Arial','B',7);
        $pdf    .= Fpdf::SetX(5);
        $pdf  .= Fpdf::Cell(5,7,utf8_decode('N°'),1,0,'C');
        $pdf  .= Fpdf::Cell(40,7,utf8_decode('Nombres'),1,0,'C');
        $pdf  .= Fpdf::Cell(13,7,utf8_decode('Recibo N°'),1,0,'C');
        $pdf  .= Fpdf::Cell(13,7,utf8_decode('Total'),1,0,'C');
        $i=0;
        $fixs = $this->typeIncomeRepository->getModel()->whereHas('incomes',function ($q) use ($date){
            $q->where('date',$date->format('Y-m-d'));
        })->get();
        foreach($fixs AS $fix): $i++;
            $pdf  .= Fpdf::Cell(13,7,substr(utf8_decode($fix->abreviation),0,8),1,0,'C');
        endforeach;
        $pdf  .= Fpdf::ln();
        $e =0;
        $fin = 0;
        /* INICIO DE CUERPO */
        $miembros = $this->incomeRepository->getModel()->where('date',$date->format('Y-m-d'))->groupBy('numberOf')->get();
        $pdf    .= Fpdf::SetFont('Arial','B',17);
        $pdf    .= Fpdf::SetTextColor(242,66,21);
        if($miembros[0]->numeration > 0 && $miembros[0]->numeration < 10):
            $pdf    .= Fpdf::Text(158,27,utf8_decode('N° ').'0000'.$miembros[0]->numeration,'B',7);
        elseif ($miembros[0]->numeration > 10 && $miembros[0]->numeration < 100):
            $pdf    .= Fpdf::Text(158,27,utf8_decode('N° ').'000'.$miembros[0]->numeration,'B',7);
        elseif ($miembros[0]->numeration > 100 && $miembros[0]->numeration < 1000):
            $pdf    .= Fpdf::Text(158,27,utf8_decode('N° ').'00'.$miembros[0]->numeration,'B',7);
        endif;
        $pdf    .= Fpdf::SetTextColor(0,0,0);
        $pdf  .= Fpdf::SetFont('Arial','I',7);

        foreach($miembros AS $miembro):

            if($miembro->members):
                $e++;
                $pdf  .= Fpdf::SetX(5);
                $pdf  .= Fpdf::Cell(5,7,utf8_decode($e),1,0,'C');
                $pdf  .= Fpdf::Cell(40,7,substr(utf8_decode($miembro->members->completo()),0,30),1,0,'L');
                $pdf  .= Fpdf::Cell(13,7,$miembro->numberOf,1,0,'C');
                $total = $numberOf = $this->incomeRepository->getModel()->where('numberOf',$miembro->numberOf)->sum('balance');
                $fin += $total;
                $pdf  .= Fpdf::Cell(13,7,number_format($total,2),1,0,'C');

                foreach($fixs AS $fix):
                    $amount = $this->incomeRepository->incomeDateMember($miembro->members->id,$date->format('Y-m-d'))
                        ->where('type_income_id',$fix->id)->where('numberOf',$miembro->numberOf)->sum('balance');
                    $pdf  .= Fpdf::Cell(13,7,number_format($amount,2),1,0,'C');
                endforeach;
                $pdf  .= Fpdf::ln();
            endif;
        endforeach;
        /*fIN DE CUERPO*/
        $pdf  .= Fpdf::SetFont('Arial','B',6.5);
        $pdf  .= Fpdf::SetX(5);
        $pdf  .= Fpdf::Cell(58,7,'TOTALES _  _  _  _  _  _',0,0,'R');
        $pdf  .= Fpdf::Cell(13,7,number_format($fin,2),1,0,'R');
        foreach($fixs AS $fix):
            $amount=  $this->incomeRepository->twoWhereList('type_income_id',$fix->id,'date',$date->format('Y-m-d'),'balance');
            $pdf  .= Fpdf::Cell(13,7,number_format($amount,2),1,0,'C');
        endforeach;
        $pdf  .= Fpdf::ln();
        $pdf  .= Fpdf::ln();
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
        $Y= Fpdf::GetY();
        $pdf .= $this->footer($date,$orientacion,$y);
        $pdf .= $this->firmas($orientacion,$date,$Y);
        Fpdf::Output('Informe-Semanal: '.$date.'.pdf','I');
        exit;
    }
    public function header($data,$orientacion)
    {
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
        $pdf .= Fpdf::Cell(0,7,'Iglesia:  Quepos                                                            Fecha:  '.$data,0,1,'L');
        return $pdf;
    }

    private function columnAccounts($date)
    {
        $internal = InternalControl::where('church_id',1)->where('saturday',$date->format('Y-m-d'))->first();
        echo json_encode($internal->localFieldIncomeAccounts()->groupBy('local_field_income_account_id')->count());
        die;
        if($fixs <= 10):
            $orientacion = 'P';
        else:
            $orientacion = 'L';
        endif;
    }
}
