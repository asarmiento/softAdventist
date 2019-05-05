<?php


namespace App\Http\Controllers\ReportsPDF;


use App\Entities\Church;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;

class ReportsClubesController extends Controller
{

    public function listChruchClub()
    {
        // $data  = $request->all();
        $churches = Church::whereHas('district',function ($e){
            $e->where('local_field_id',userCampo());
        })->whereHas('members',function ($c){
            $c->where('type',true);
        })->with('members')->get();
        $i = 0;

        foreach ($churches AS $church):
            $this->header('L', $church->name);

            $pdf = Fpdf::SetFont('Arial', 'B', 12);
            $pdf .= Fpdf::Cell(10, 7, utf8_decode('N°'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(80, 7, utf8_decode('Nombre'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(25, 7, utf8_decode('Fecha Nac.'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(65, 7, utf8_decode('Email'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(25, 7, utf8_decode('Teléfono'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(30, 7, utf8_decode('Estado Civil'), 1, 0, 'C');
            $pdf .= Fpdf::Cell(20, 7, utf8_decode('T/S.'), 1, 1, 'C');
            foreach ($church->members->where('type',true) AS $member):
                $i++;
                $pdf = Fpdf::SetFont('Arial', 'I', 12);
                $pdf .= Fpdf::Cell(10, 7, utf8_decode($i), 1, 0, 'C');
                $pdf .= Fpdf::Cell(80, 7, utf8_decode($member->name .' '.$member->last), 1, 0, 'L');
                $pdf .= Fpdf::Cell(25, 7, utf8_decode($member->birthdate), 1, 0, 'C');
                $pdf .= Fpdf::Cell(65, 7, utf8_decode($member->email), 1, 0, 'C');
                $pdf .= Fpdf::Cell(25, 7, utf8_decode($member->phone), 1, 0, 'C');
                $pdf .= Fpdf::Cell(30, 7, utf8_decode($member->civil_status), 1, 0, 'C');
                $pdf .= Fpdf::Cell(20, 7, utf8_decode($member->blood_type), 1, 1, 'C');
                endforeach;

        endforeach;
        Fpdf::Output('Listas de Clubes.pdf', 'i');
        exit;

    }

    public function header($orientacion, $church)
    {
        $pdf = Fpdf::AddPage($orientacion, 'letter');
        $pdf .= Fpdf::SetFont('Arial', 'B', 16);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Asociación Central Sur de Costa Rica de los Adventista del Séptimo Día'),
            0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', '', 12);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Apartado 10113-1000 San José, Costa Rica'), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Teléfonos: 2224-8311 Fax:2225-0665'), 0, 1, 'C');
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('acscrtesoreria07@gmail.com acscr_tesoreria@hotmail.com'), 0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', 'B', 16);
        $pdf .= Fpdf::Cell(0, 7, utf8_decode('Lista de Clubes'), 0, 1, 'C');
        $pdf .= Fpdf::SetFont('Arial', '', 12);
        $pdf .= Fpdf::Setx(5);
        $pdf .= Fpdf::Cell(130, 7, 'Iglesia: ' . utf8_decode(ucwords($church)), 0, 0, 'L');
        $pdf .= Fpdf::Cell(30, 7, utf8_decode('Fecha de Impresión:  ' . Carbon::now()->toDateString()), 0, 1, 'L');

        return $pdf;
    }
}
