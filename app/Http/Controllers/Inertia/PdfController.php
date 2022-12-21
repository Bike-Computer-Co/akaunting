<?php

namespace App\Http\Controllers\Inertia;

use App\Models\FirmRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class PdfController extends BaseController
{
    private function recuringArray($firmRegistration): array
    {
        $name = $firmRegistration->founder_name;
        $address = $firmRegistration->founder_address;
        $embg = $firmRegistration->founder_embg;
        $date = Carbon::parse(Carbon::now()->toDateTimeString())->format('d-m-Y');
        $firm_name = $firmRegistration->firm_name;
        if ($firmRegistration->headquartersSettlement) {
            $municipality = 'Скопје';
        } else {
            $municipality = $firmRegistration->headquartersMunicipality->name;
        }

        return compact(['name', 'embg', 'address', 'date', 'firm_name', 'municipality']);
    }

    public function certifiedSignaturePdf(FirmRegistration $firmRegistration): Response
    {
        $name = $firmRegistration->founder_name;
        $splited_name = explode(' ', $name);
        if(sizeof($splited_name) != 0){
            $name_fliped = array_reverse($splited_name);
            $name = implode(' ',$name_fliped);
        }

        $embg = $firmRegistration->founder_embg;
        $firm_name = $firmRegistration->firm_name;
        if ($firmRegistration->headquartersSettlement) {
            $municipality = 'Скопје';
        } else {
            $municipality = $firmRegistration->headquartersMunicipality->name;
        }

        $pdf = PDF::loadView('auto-generated-files/certified-signature-pdf', compact(['name', 'embg', 'firm_name', 'municipality']));

        return $pdf->stream();
    }

    public function statment1(FirmRegistration $firmRegistration): Response
    {
        $recuring_array = $this->recuringArray($firmRegistration);

        $recuring_array['firm_address'] = $firmRegistration->headquarters_address;
        $recuring_array['occupation_code'] = $firmRegistration->occupation_code;
        $recuring_array['id_number'] = $firmRegistration->founder_id_number;

        $pdf = PDF::loadView('auto-generated-files/statement-1', $recuring_array);

        return $pdf->stream();
    }

    public function statment2(FirmRegistration $firmRegistration): Response
    {
        $pdf = PDF::loadView('auto-generated-files/statement-2', $this->recuringArray($firmRegistration));

        return $pdf->stream();
    }

    public function statment3(FirmRegistration $firmRegistration): Response
    {
        $pdf = PDF::loadView('auto-generated-files/statement-3', $this->recuringArray($firmRegistration));

        return $pdf->stream();
    }

    public function statment4(FirmRegistration $firmRegistration): Response
    {
        $pdf = PDF::loadView('auto-generated-files/statement-4', $this->recuringArray($firmRegistration));

        return $pdf->stream();
    }

    public function powerOfAttorney(FirmRegistration $firmRegistration): Response
    {
        $recuring_array = $this->recuringArray($firmRegistration);
        $recuring_array['id_number'] = $firmRegistration->founder_id_number;

        $pdf = PDF::loadView('auto-generated-files/power-of-attorney', $recuring_array);

        return $pdf->stream();
    }

    public function decision(FirmRegistration $firmRegistration): Response
    {
        $pdf = PDF::loadView('auto-generated-files/decision', $this->recuringArray($firmRegistration));

        return $pdf->stream();
    }
}
