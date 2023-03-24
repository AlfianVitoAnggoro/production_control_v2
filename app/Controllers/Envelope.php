<?php

namespace App\Controllers;

use App\Models\M_Envelope;
use App\Models\M_EnvelopeInput;
use App\Models\M_Plate;
use App\Models\M_Separator;
use App\Models\M_Team;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPUnit\Framework\countOf;

class Envelope extends BaseController
{
    protected $separatorModel;
    protected $envelopeModel;
    protected $plateModel;
    protected $envelopeinputModel;
    protected $teamModel;
    public function __construct()
    {
        $this->separatorModel = new M_Separator();
        $this->envelopeModel = new M_Envelope();
        $this->envelopeinputModel = new M_EnvelopeInput();
        $this->plateModel = new M_Plate();
        $this->teamModel = new M_Team();
    }
    public function envelope_view()
    {
        $session = \Config\Services::session();
        $envelope = $this->envelopeModel->findAll();
        $envelopeinput = $this->envelopeinputModel->findAll();
        $dates = array_column($envelope, "date");
        $lines = array_column($envelope, "line");
        $shift = array_column($envelope, "shift");
        array_multisort($lines, SORT_ASC, $dates, SORT_ASC, $shift, SORT_ASC,  $envelope);
        $status = $session->get();
        $data = [
            'envelope' => $envelope,
            'envelopeinput' => $envelopeinput,
            'session' => $status,
        ];
        return view('pages/envelope/envelope_view', $data);
    }

    public function add_envelope()
    {
        $plate = $this->plateModel->findAll();
        $separator = $this->separatorModel->findAll();
        $team = $this->teamModel->findAll();
        $data = [
            'plate' => $plate,
            'separator' => $separator,
            'team' => $team
        ];
        return view('pages/envelope/add_envelope', $data);
    }

    public function save()
    {
        $envelopeinput = $this->envelopeinputModel->findAll();
        $date = $this->request->getVar('date');
        $line = $this->request->getVar('line');
        $shift = $this->request->getVar('shift');
        $team = $this->request->getVar('team');
        $plate = $this->request->getVar('plate');
        $hasil_produksi = $this->request->getVar('hasil_produksi');
        $separator = $this->request->getVar('separator');
        $melintir_bending = $this->request->getVar('melintir_bending');
        $terpotong = $this->request->getVar('terpotong');
        $rontok = $this->request->getVar('rontok');
        $tersangkut = $this->request->getVar('tersangkut');
        $persentase_reject_akumulatif = $this->request->getVar('persentase_reject_akumulatif');
        $envinput = count($envelopeinput) + 1;
        if ($line !== NULL || $plate !== NULL) {
            $id = 'D' . $date . 'L' . $line . 'S' . $shift;
            $data_envelope[] = array(
                'id' => $id,
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'team' => $team,
                'status' => 'pending'
            );
            for ($i = 0; $i < count($plate); $i++) {
                $id_envelopeinput = $envinput + $i;
                $data_envelopeinput[] = array(
                    'id' => $id_envelopeinput,
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
        return redirect()->to('/envelope');
    }

    public function detail_envelope($id)
    {
        $session = \Config\Services::session();
        $status = $session->get('level');
        if ($status !== 5) {
            return redirect()->to('/envelope');
        }
        $plate = $this->plateModel->findAll();
        $team = $this->teamModel->findAll();
        $envelope = $this->envelopeModel->find($id);
        $envelopeinput = $this->envelopeinputModel->where('id_envelope', $id)->findAll();
        $separator = $this->separatorModel->findAll();

        $data = [
            'plate' => $plate,
            'team' => $team,
            'separator' => $separator,
            'envelope' => $envelope,
            'envelopeinput' => $envelopeinput,
        ];

        return view('pages/envelope/detail_envelope', $data);
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $id_envelope = $this->request->getVar('id_envelope');
        $edit = $this->request->getVar('edit');
        $reject = $this->request->getVar('rejected');
        $approve = $this->request->getVar('approved');
        $plate = $this->request->getVar('plate');
        $hasil_produksi = $this->request->getVar('hasil_produksi');
        $separator = $this->request->getVar('separator');
        $melintir_bending = $this->request->getVar('melintir_bending');
        $terpotong = $this->request->getVar('terpotong');
        $rontok = $this->request->getVar('rontok');
        $tersangkut = $this->request->getVar('tersangkut');
        $persentase_reject_akumulatif = $this->request->getVar('persentase_reject_akumulatif');
        if ($edit !== NULL) {
            if ($plate !== NULL) {
                for ($i = 0; $i < count($plate); $i++) {
                    $data_envelopeinput[] = array(
                        'id' => $id[$i],
                        'plate' => $plate[$i],
                        'hasil_produksi' => $hasil_produksi[$i],
                        'separator' => $separator[$i],
                        'melintir_bending' => $melintir_bending[$i] !== NULL ? $melintir_bending[$i] : 0,
                        'terpotong' => $terpotong[$i] !== NULL ? $terpotong[$i] : 0,
                        'rontok' => $rontok[$i] !== NULL ? $rontok[$i] : 0,
                        'tersangkut' => $tersangkut[$i] !== NULL  ? $tersangkut[$i] : 0,
                        'persentase_reject_akumulatif' => $persentase_reject_akumulatif[$i] !== NULL  ? $persentase_reject_akumulatif[$i] : 0,
                    );
                    $this->envelopeinputModel->updateBatch($data_envelopeinput, 'id');
                }
            }
        } else if ($reject !== NULL) {
            $data_envelope[] = array(
                'id' => $id_envelope,
                'status' => $reject
            );
            $this->envelopeModel->updateBatch($data_envelope, 'id');
        } else if ($approve !== NULL) {
            $data_envelope[] = array(
                'id' => $id_envelope,
                'status' => $approve
            );
            $this->envelopeModel->updateBatch($data_envelope, 'id');
        }
        return redirect()->to('/envelope');
    }

    public function download()
    {
        $envelope = $this->envelopeModel->findAll();
        $envelopeinput = $this->envelopeinputModel->findAll();
        $dates = array_column($envelope, "date");
        $lines = array_column($envelope, "line");
        $shift = array_column($envelope, "shift");
        array_multisort($lines, SORT_ASC, $dates, SORT_ASC, $shift, SORT_ASC,  $envelope);
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Menambahkan data ke worksheet
        $sheet = $spreadsheet->getActiveSheet();
        $data = array(
            array('Date', 'Line', 'Shift', 'Team', 'Hasil Produksi', 'Separator', 'Melintir Bending', 'Terpotong', 'Rontok', 'Tersangkut', 'Persentase Reject Akumulatif')
        );
        $isExist = [];
        foreach ($envelope as $envl) {
            if ($envl['status'] === 'approved') {
                if (!array_key_exists($envl['id'], $isExist)) {
                    foreach ($envelopeinput as $ei) {
                        if ($envl['id'] === $ei['id_envelope']) {
                            $isExist[$envl['id']] = $envl['id'];
                            $data[] = array($envl['date'], $envl['line'], $envl['shift'], $envl['team'], $ei['hasil_produksi'], $ei['separator'], $ei['melintir_bending'], $ei['terpotong'], $ei['rontok'], $ei['tersangkut'], $ei['persentase_reject_akumulatif']);
                        }
                    }
                }
            }
        };

        // Memasukkan data array ke dalam worksheet
        $sheet->fromArray($data);


        // Mengatur header respons HTTP
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        // Membuat objek Writer untuk menulis spreadsheet ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
