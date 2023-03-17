<?php

namespace App\Controllers;

use App\Models\M_Envelope;
use App\Models\M_EnvelopeInput;
use App\Models\M_Plate;
use App\Models\M_Separator;

use function PHPUnit\Framework\countOf;

class Envelope extends BaseController
{
    protected $separatorModel;
    protected $envelopeModel;
    protected $plateModel;
    protected $envelopeinputModel;
    public function __construct()
    {
        $this->separatorModel = new M_Separator();
        $this->envelopeModel = new M_Envelope();
        $this->envelopeinputModel = new M_EnvelopeInput();
        $this->plateModel = new M_Plate();
    }
    public function envelope_view()
    {
        $envelope = $this->envelopeModel->findAll();
        $envelopeinput = $this->envelopeinputModel->findAll();
        $dates = array_column($envelope, "date");
        $lines = array_column($envelope, "line");
        array_multisort($lines, SORT_ASC, $dates, SORT_ASC, $envelope);
        $data = [
            'envelope' => $envelope,
            'envelopeinput' => $envelopeinput,
        ];
        return view('pages/envelope/envelope_view', $data);
    }

    public function add_envelope()
    {
        $plate = $this->plateModel->findAll();
        $separator = $this->separatorModel->findAll();
        $data = [
            'plate' => $plate,
            'separator' => $separator
        ];
        return view('pages/envelope/add_envelope', $data);
    }

    public function save()
    {
        $envelope = $this->envelopeModel->findAll();
        $date = $this->request->getVar('date');
        $line = $this->request->getVar('line');
        $shift = $this->request->getVar('shift');
        $plate = $this->request->getVar('plate');
        $hasil_produksi = $this->request->getVar('hasil_produksi');
        $separator = $this->request->getVar('separator');
        $melintir_bending = $this->request->getVar('melintir_bending');
        $terpotong = $this->request->getVar('terpotong');
        $rontok = $this->request->getVar('rontok');
        $tersangkut = $this->request->getVar('tersangkut');
        $persentase_reject_akumulatif = $this->request->getVar('persentase_reject_akumulatif');
        if ($line !== NULL || $plate !== NULL) {
            $id = count($envelope) + 1;
            $data_envelope[] = array(
                'id' => $id,
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'id_envelopeinput' => $id
            );
            for ($i = 0; $i < count($plate); $i++) {
                $data_envelopeinput[] = array(
                    'id' => $id,
                    'id_envelope' => $id,
                    'plate' => $plate[$i],
                    'hasil_produksi' => $hasil_produksi[$i],
                    'separator' => $separator[$i],
                    'melintir_bending' => $melintir_bending[$i] !== NULL ? $melintir_bending[$i] : 0,
                    'terpotong' => $terpotong[$i] !== NULL ? $terpotong[$i] : 0,
                    'rontok' => $rontok[$i] !== NULL ? $rontok[$i] : 0,
                    'tersangkut' => $tersangkut[$i] !== NULL  ? $tersangkut[$i] : 0,
                    'persentase_reject_akumulatif' => $persentase_reject_akumulatif[$i] !== NULL  ? $persentase_reject_akumulatif[$i] : 0,
                );
            }
            $this->envelopeModel->insertBatch($data_envelope);
            $this->envelopeinputModel->insertBatch($data_envelopeinput);
        }
        return redirect()->to('/lhp/envelope');
    }
}
