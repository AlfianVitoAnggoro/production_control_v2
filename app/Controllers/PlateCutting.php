<?php

namespace App\Controllers;

use App\Models\M_Plate;
use App\Models\M_PlateCutting;
use App\Models\M_PlateInput;
use App\Models\M_Team;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPUnit\Framework\countOf;

class PlateCutting extends BaseController
{
    protected $plateModel;
    protected $teamModel;
    protected $plateInputModel;
    protected $platecuttingModel;
    public function __construct()
    {
        $this->plateModel = new M_Plate();
        $this->teamModel = new M_Team();
        $this->plateInputModel = new M_PlateInput();
        $this->platecuttingModel = new M_PlateCutting();
    }
    public function platecutting_view()
    {
        $session = \Config\Services::session();
        $platecutting = $this->platecuttingModel->findAll();
        $dates = array_column($platecutting, "date");
        $lines = array_column($platecutting, "line");
        $shifts = array_column($platecutting, "shift");
        array_multisort($dates, SORT_DESC, $lines, SORT_ASC, $shifts, SORT_ASC, $platecutting);
        $plateInput = $this->plateInputModel->findAll();
        $team = $this->teamModel->findAll();
        $status = $session->get();
        $data = [
            'platecutting' => $platecutting,
            'plateinput' => $plateInput,
            'session' => $status,
            'team' => $team
        ];
        return view('pages/plate_cutting/platecutting_view', $data);
    }

    public function getPlate()
    {
        $plate = $this->plateModel->findAll();
        return $plate;
    }

    public function add_platecutting($id)
    {
        $platecutting = $this->platecuttingModel->find($id);
        $plateinput = $this->plateInputModel->where('id_platecutting', $id)->findAll();
        $plate = $this->plateModel->findAll();
        $team = $this->teamModel->findAll();
        $data = [
            'platecutting' => $platecutting,
            'plateinput' => $plateinput,
            'plate' => $plate,
            'team' => $team
        ];
        return view('pages/plate_cutting/add_platecutting', $data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');
        $plateinput = $this->plateInputModel->where('id_platecutting', $id)->findAll();
        $id_plateinputDBPOS = $this->request->getVar('id_plateinput_pos');
        $id_plateinputDBNEG = $this->request->getVar('id_plateinput_neg');
        $date = $this->request->getVar('date');
        $line = $this->request->getVar('line');
        $shift = $this->request->getVar('shift');
        $team = $this->request->getVar('team');
        $plate_pos = $this->request->getVar('plate_pos');
        $hasil_produksi_pos = $this->request->getVar('hasil_produksi_pos');
        $terpotong_panel_pos = $this->request->getVar('terpotong_panel_pos');
        $tersangkut_panel_pos = $this->request->getVar('tersangkut_panel_pos');
        $overbrush_panel_pos = $this->request->getVar('overbrush_panel_pos');
        $rontok_panel_pos = $this->request->getVar('rontok_panel_pos');
        $lug_patah_panel_pos = $this->request->getVar('lug_patah_panel_pos');
        $patah_kaki_panel_pos = $this->request->getVar('patah_kaki_panel_pos');
        $patah_frame_panel_pos = $this->request->getVar('patah_frame_panel_pos');
        $bolong_panel_pos = $this->request->getVar('bolong_panel_pos');
        $bending_panel_pos = $this->request->getVar('bending_panel_pos');
        $lengket_terpotong_panel_pos = $this->request->getVar('lengket_terpotong_panel_pos');
        $terpotong_kg_pos = $this->request->getVar('terpotong_kg_pos');
        $tersangkut_kg_pos = $this->request->getVar('tersangkut_kg_pos');
        $overbrush_kg_pos = $this->request->getVar('overbrush_kg_pos');
        $rontok_kg_pos = $this->request->getVar('rontok_kg_pos');
        $lug_patah_kg_pos = $this->request->getVar('lug_patah_kg_pos');
        $patah_kaki_kg_pos = $this->request->getVar('patah_kaki_kg_pos');
        $patah_frame_kg_pos = $this->request->getVar('patah_frame_kg_pos');
        $bolong_kg_pos = $this->request->getVar('bolong_kg_pos');
        $bending_kg_pos = $this->request->getVar('bending_kg_pos');
        $lengket_terpotong_kg_pos = $this->request->getVar('lengket_terpotong_kg_pos');
        $persentase_reject_internal_pos = $this->request->getVar('persentase_reject_internal_pos');
        $persentase_reject_eksternal_pos = $this->request->getVar('persentase_reject_eksternal_pos');
        $persentase_reject_akumulatif_pos = $this->request->getVar('persentase_reject_akumulatif_pos');
        $plate_neg = $this->request->getVar('plate_neg');
        $hasil_produksi_neg = $this->request->getVar('hasil_produksi_neg');
        $terpotong_panel_neg = $this->request->getVar('terpotong_panel_neg');
        $tersangkut_panel_neg = $this->request->getVar('tersangkut_panel_neg');
        $overbrush_panel_neg = $this->request->getVar('overbrush_panel_neg');
        $rontok_panel_neg = $this->request->getVar('rontok_panel_neg');
        $lug_patah_panel_neg = $this->request->getVar('lug_patah_panel_neg');
        $patah_kaki_panel_neg = $this->request->getVar('patah_kaki_panel_neg');
        $patah_frame_panel_neg = $this->request->getVar('patah_frame_panel_neg');
        $bolong_panel_neg = $this->request->getVar('bolong_panel_neg');
        $bending_panel_neg = $this->request->getVar('bending_panel_neg');
        $lengket_terpotong_panel_neg = $this->request->getVar('lengket_terpotong_panel_neg');
        $terpotong_kg_neg = $this->request->getVar('terpotong_kg_neg');
        $tersangkut_kg_neg = $this->request->getVar('tersangkut_kg_neg');
        $overbrush_kg_neg = $this->request->getVar('overbrush_kg_neg');
        $rontok_kg_neg = $this->request->getVar('rontok_kg_neg');
        $lug_patah_kg_neg = $this->request->getVar('lug_patah_kg_neg');
        $patah_kaki_kg_neg = $this->request->getVar('patah_kaki_kg_neg');
        $patah_frame_kg_neg = $this->request->getVar('patah_frame_kg_neg');
        $bolong_kg_neg = $this->request->getVar('bolong_kg_neg');
        $bending_kg_neg = $this->request->getVar('bending_kg_neg');
        $lengket_terpotong_kg_neg = $this->request->getVar('lengket_terpotong_kg_neg');
        $persentase_reject_internal_neg = $this->request->getVar('persentase_reject_internal_neg');
        $persentase_reject_eksternal_neg = $this->request->getVar('persentase_reject_eksternal_neg');
        $persentase_reject_akumulatif_neg = $this->request->getVar('persentase_reject_akumulatif_neg');
        $barcode_pos = $this->request->getVar('barcode_pos');
        $act_pos = $this->request->getVar('act_pos');
        $deviasi_pos = $this->request->getVar('deviasi_pos');
        $barcode_neg = $this->request->getVar('barcode_neg');
        $act_neg = $this->request->getVar('act_neg');
        $deviasi_neg = $this->request->getVar('deviasi_neg');

        $plateinputnew = [];
        $data_plate_new_pos = [];
        $data_plate_new_neg = [];
        if ($id === NULL) {
            $platecutting = $this->platecuttingModel->findAll();
            $data_platecutting[] = array(
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'team' => $team,
                'status' => 'pending',
            );
            $this->platecuttingModel->insertBatch($data_platecutting);
            $newid = $this->platecuttingModel->insertID();
            return redirect()->to(base_url('platecutting/add_platecutting/' . $newid));
        } else {
            $data_platecutting[] = array(
                'id' => $id,
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'team' => $team,
                'status' => 'pending',
            );
            $this->platecuttingModel->updateBatch($data_platecutting, 'id');
            for ($i = 0; $i < ($id_plateinputDBPOS !== NULL ? count($id_plateinputDBPOS) : 0); $i++) {
                if ($plate_pos[$i] !== "") {
                    if ($id_plateinputDBPOS[$i] === "") {
                        $data_plate_new_pos[] = array(
                            'id_platecutting' => $id,
                            'plate' => $plate_pos[$i],
                            'barcode' => ($barcode_pos[$i] !== NULL ? $barcode_pos[$i] !== NULL : 0) ? $barcode_pos[$i] : 0,
                            'act' => ($act_pos[$i] !== NULL ? $act_pos[$i] !== NULL : 0) ? $act_pos[$i] : 0,
                            'deviasi' => ($deviasi_pos[$i] !== NULL ? $deviasi_pos[$i] !== NULL : '+ 0') ? $deviasi_pos[$i] : '+ 0',
                            'hasil_produksi' => ($hasil_produksi_pos[$i] !== NULL ? $hasil_produksi_pos[$i] !== NULL : 0) ? $hasil_produksi_pos[$i] : 0,
                            'terpotong_panel' => ($terpotong_panel_pos[$i] !== NULL ? $terpotong_panel_pos[$i] !== NULL : 0) ? $terpotong_panel_pos[$i] : 0,
                            'tersangkut_panel' => ($tersangkut_panel_pos[$i] !== NULL ? $tersangkut_panel_pos[$i] !== NULL : 0)  ? $tersangkut_panel_pos[$i] : 0,
                            'overbrush_panel' => ($overbrush_panel_pos[$i] !== NULL ? $overbrush_panel_pos[$i] !== NULL : 0) ? $overbrush_panel_pos[$i] : 0,
                            'rontok_panel' => ($rontok_panel_pos[$i] !== NULL ? $rontok_panel_pos[$i] !== NULL : 0) ? $rontok_panel_pos[$i] : 0,
                            'lug_patah_panel' => ($lug_patah_panel_pos[$i] !== NULL ? $lug_patah_panel_pos[$i] !== NULL : 0) ? $lug_patah_panel_pos[$i] : 0,
                            'patah_kaki_panel' => ($patah_kaki_panel_pos[$i] !== NULL ? $patah_kaki_panel_pos[$i] !== NULL : 0) ? $patah_kaki_panel_pos[$i] : 0,
                            'patah_frame_panel' => ($patah_frame_panel_pos[$i] !== NULL ? $patah_frame_panel_pos[$i] !== NULL : 0) ? $patah_frame_panel_pos[$i] : 0,
                            'bolong_panel' => ($bolong_panel_pos[$i] !== NULL ? $bolong_panel_pos[$i] !== NULL : 0) ? $bolong_panel_pos[$i] : 0,
                            'bending_panel' => ($bending_panel_pos[$i] !== NULL ? $bending_panel_pos[$i] !== NULL : 0) ? $bending_panel_pos[$i] : 0,
                            'lengket_terpotong_panel' => ($lengket_terpotong_panel_pos[$i] !== NULL ? $lengket_terpotong_panel_pos[$i] !== NULL : 0) ? $lengket_terpotong_panel_pos[$i] : 0,
                            'terpotong_kg' => $terpotong_kg_pos[$i] !== NULL ? $terpotong_kg_pos[$i] : 0,
                            'tersangkut_kg' => $tersangkut_kg_pos[$i] !== NULL ? $tersangkut_kg_pos[$i] : 0,
                            'overbrush_kg' => $overbrush_kg_pos[$i] !== NULL ? $overbrush_kg_pos[$i] : 0,
                            'rontok_kg' => $rontok_kg_pos[$i] !== NULL ? $rontok_kg_pos[$i] : 0,
                            'lug_patah_kg' => $lug_patah_kg_pos[$i] !== NULL ? $lug_patah_kg_pos[$i] : 0,
                            'patah_kaki_kg' => $patah_kaki_kg_pos[$i] !== NULL ? $patah_kaki_kg_pos[$i] : 0,
                            'patah_frame_kg' => $patah_frame_kg_pos[$i] !== NULL ? $patah_frame_kg_pos[$i] : 0,
                            'bolong_kg' => $bolong_kg_pos[$i] !== NULL ? $bolong_kg_pos[$i] : 0,
                            'bending_kg' => $bending_kg_pos[$i] !== NULL ? $bending_kg_pos[$i] : 0,
                            'lengket_terpotong_kg' => $lengket_terpotong_kg_pos[$i] !== NULL ? $lengket_terpotong_kg_pos[$i] : 0,
                            'persentase_reject_internal' => $persentase_reject_internal_pos[$i] !== NULL ? $persentase_reject_internal_pos[$i] : 0,
                            'persentase_reject_eksternal' => $persentase_reject_eksternal_pos[$i] !== NULL ? $persentase_reject_eksternal_pos[$i] : 0,
                            'persentase_reject_akumulatif' => $persentase_reject_akumulatif_pos[$i] !== NULL ? $persentase_reject_akumulatif_pos[$i] : 0,
                        );
                    } else {
                        $plateinputnew[$id_plateinputDBPOS[$i]] = $id_plateinputDBPOS[$i];
                        $data_plate_old_pos[] = array(
                            'id' => $id_plateinputDBPOS[$i],
                            'plate' => $plate_pos[$i],
                            'barcode' => ($barcode_pos[$i] !== NULL ? $barcode_pos[$i] !== NULL : 0) ? $barcode_pos[$i] : 0,
                            'act' => ($act_pos[$i] !== NULL ? $act_pos[$i] !== NULL : 0) ? $act_pos[$i] : 0,
                            'deviasi' => ($deviasi_pos[$i] !== NULL ? $deviasi_pos[$i] !== NULL : '+ 0') ? $deviasi_pos[$i] : '+ 0',
                            'hasil_produksi' => ($hasil_produksi_pos[$i] !== NULL ? $hasil_produksi_pos[$i] !== NULL : 0) ? $hasil_produksi_pos[$i] : 0,
                            'terpotong_panel' => ($terpotong_panel_pos[$i] !== NULL ? $terpotong_panel_pos[$i] !== NULL : 0) ? $terpotong_panel_pos[$i] : 0,
                            'tersangkut_panel' => ($tersangkut_panel_pos[$i] !== NULL ? $tersangkut_panel_pos[$i] !== NULL : 0)  ? $tersangkut_panel_pos[$i] : 0,
                            'overbrush_panel' => ($overbrush_panel_pos[$i] !== NULL ? $overbrush_panel_pos[$i] !== NULL : 0) ? $overbrush_panel_pos[$i] : 0,
                            'rontok_panel' => ($rontok_panel_pos[$i] !== NULL ? $rontok_panel_pos[$i] !== NULL : 0) ? $rontok_panel_pos[$i] : 0,
                            'lug_patah_panel' => ($lug_patah_panel_pos[$i] !== NULL ? $lug_patah_panel_pos[$i] !== NULL : 0) ? $lug_patah_panel_pos[$i] : 0,
                            'patah_kaki_panel' => ($patah_kaki_panel_pos[$i] !== NULL ? $patah_kaki_panel_pos[$i] !== NULL : 0) ? $patah_kaki_panel_pos[$i] : 0,
                            'patah_frame_panel' => ($patah_frame_panel_pos[$i] !== NULL ? $patah_frame_panel_pos[$i] !== NULL : 0) ? $patah_frame_panel_pos[$i] : 0,
                            'bolong_panel' => ($bolong_panel_pos[$i] !== NULL ? $bolong_panel_pos[$i] !== NULL : 0) ? $bolong_panel_pos[$i] : 0,
                            'bending_panel' => ($bending_panel_pos[$i] !== NULL ? $bending_panel_pos[$i] !== NULL : 0) ? $bending_panel_pos[$i] : 0,
                            'lengket_terpotong_panel' => ($lengket_terpotong_panel_pos[$i] !== NULL ? $lengket_terpotong_panel_pos[$i] !== NULL : 0) ? $lengket_terpotong_panel_pos[$i] : 0,
                            'terpotong_kg' => $terpotong_kg_pos[$i] !== NULL ? $terpotong_kg_pos[$i] : 0,
                            'tersangkut_kg' => $tersangkut_kg_pos[$i] !== NULL ? $tersangkut_kg_pos[$i] : 0,
                            'overbrush_kg' => $overbrush_kg_pos[$i] !== NULL ? $overbrush_kg_pos[$i] : 0,
                            'rontok_kg' => $rontok_kg_pos[$i] !== NULL ? $rontok_kg_pos[$i] : 0,
                            'lug_patah_kg' => $lug_patah_kg_pos[$i] !== NULL ? $lug_patah_kg_pos[$i] : 0,
                            'patah_kaki_kg' => $patah_kaki_kg_pos[$i] !== NULL ? $patah_kaki_kg_pos[$i] : 0,
                            'patah_frame_kg' => $patah_frame_kg_pos[$i] !== NULL ? $patah_frame_kg_pos[$i] : 0,
                            'bolong_kg' => $bolong_kg_pos[$i] !== NULL ? $bolong_kg_pos[$i] : 0,
                            'bending_kg' => $bending_kg_pos[$i] !== NULL ? $bending_kg_pos[$i] : 0,
                            'lengket_terpotong_kg' => $lengket_terpotong_kg_pos[$i] !== NULL ? $lengket_terpotong_kg_pos[$i] : 0,
                            'persentase_reject_internal' => $persentase_reject_internal_pos[$i] !== NULL ? $persentase_reject_internal_pos[$i] : 0,
                            'persentase_reject_eksternal' => $persentase_reject_eksternal_pos[$i] !== NULL ? $persentase_reject_eksternal_pos[$i] : 0,
                            'persentase_reject_akumulatif' => $persentase_reject_akumulatif_pos[$i] !== NULL ? $persentase_reject_akumulatif_pos[$i] : 0,
                        );
                        $this->plateInputModel->updateBatch($data_plate_old_pos, 'id');
                    }
                }
            }
            if (count($data_plate_new_pos) > 0) {
                $this->plateInputModel->insertBatch($data_plate_new_pos);
            }
            for ($i = 0; $i < ($id_plateinputDBNEG !== NULL ? count($id_plateinputDBNEG) : 0); $i++) {
                if ($plate_neg[$i] !== "") {
                    if ($id_plateinputDBNEG[$i] === "") {
                        $data_plate_new_neg[] = array(
                            'id_platecutting' => $id,
                            'plate' => $plate_neg[$i],
                            'barcode' => ($barcode_neg[$i] !== NULL ? $barcode_neg[$i] !== NULL : 0) ? $barcode_neg[$i] : 0,
                            'act' => ($act_neg[$i] !== NULL ? $act_neg[$i] !== NULL : 0) ? $act_neg[$i] : 0,
                            'deviasi' => ($deviasi_neg[$i] !== NULL ? $deviasi_neg[$i] !== NULL : '+ 0') ? $deviasi_neg[$i] : '+ 0',
                            'hasil_produksi' => ($hasil_produksi_neg[$i] !== NULL ? $hasil_produksi_neg[$i] !== NULL : 0) ? $hasil_produksi_neg[$i] : 0,
                            'terpotong_panel' => ($terpotong_panel_neg[$i] !== NULL ? $terpotong_panel_neg[$i] !== NULL : 0) ? $terpotong_panel_neg[$i] : 0,
                            'tersangkut_panel' => ($tersangkut_panel_neg[$i] !== NULL ? $tersangkut_panel_neg[$i] !== NULL : 0)  ? $tersangkut_panel_neg[$i] : 0,
                            'overbrush_panel' => ($overbrush_panel_neg[$i] !== NULL ? $overbrush_panel_neg[$i] !== NULL : 0) ? $overbrush_panel_neg[$i] : 0,
                            'rontok_panel' => ($rontok_panel_neg[$i] !== NULL ? $rontok_panel_neg[$i] !== NULL : 0) ? $rontok_panel_neg[$i] : 0,
                            'lug_patah_panel' => ($lug_patah_panel_neg[$i] !== NULL ? $lug_patah_panel_neg[$i] !== NULL : 0) ? $lug_patah_panel_neg[$i] : 0,
                            'patah_kaki_panel' => ($patah_kaki_panel_neg[$i] !== NULL ? $patah_kaki_panel_neg[$i] !== NULL : 0) ? $patah_kaki_panel_neg[$i] : 0,
                            'patah_frame_panel' => ($patah_frame_panel_neg[$i] !== NULL ? $patah_frame_panel_neg[$i] !== NULL : 0) ? $patah_frame_panel_neg[$i] : 0,
                            'bolong_panel' => ($bolong_panel_neg[$i] !== NULL ? $bolong_panel_neg[$i] !== NULL : 0) ? $bolong_panel_neg[$i] : 0,
                            'bending_panel' => ($bending_panel_neg[$i] !== NULL ? $bending_panel_neg[$i] !== NULL : 0) ? $bending_panel_neg[$i] : 0,
                            'lengket_terpotong_panel' => ($lengket_terpotong_panel_neg[$i] !== NULL ? $lengket_terpotong_panel_neg[$i] !== NULL : 0) ? $lengket_terpotong_panel_neg[$i] : 0,
                            'terpotong_kg' => $terpotong_kg_neg[$i] !== NULL ? $terpotong_kg_neg[$i] : 0,
                            'tersangkut_kg' => $tersangkut_kg_neg[$i] !== NULL ? $tersangkut_kg_neg[$i] : 0,
                            'overbrush_kg' => $overbrush_kg_neg[$i] !== NULL ? $overbrush_kg_neg[$i] : 0,
                            'rontok_kg' => $rontok_kg_neg[$i] !== NULL ? $rontok_kg_neg[$i] : 0,
                            'lug_patah_kg' => $lug_patah_kg_neg[$i] !== NULL ? $lug_patah_kg_neg[$i] : 0,
                            'patah_kaki_kg' => $patah_kaki_kg_neg[$i] !== NULL ? $patah_kaki_kg_neg[$i] : 0,
                            'patah_frame_kg' => $patah_frame_kg_neg[$i] !== NULL ? $patah_frame_kg_neg[$i] : 0,
                            'bolong_kg' => $bolong_kg_neg[$i] !== NULL ? $bolong_kg_neg[$i] : 0,
                            'bending_kg' => $bending_kg_neg[$i] !== NULL ? $bending_kg_neg[$i] : 0,
                            'lengket_terpotong_kg' => $lengket_terpotong_kg_neg[$i] !== NULL ? $lengket_terpotong_kg_neg[$i] : 0,
                            'persentase_reject_internal' => $persentase_reject_internal_neg[$i] !== NULL ? $persentase_reject_internal_neg[$i] : 0,
                            'persentase_reject_eksternal' => $persentase_reject_eksternal_neg[$i] !== NULL ? $persentase_reject_eksternal_neg[$i] : 0,
                            'persentase_reject_akumulatif' => $persentase_reject_akumulatif_neg[$i] !== NULL ? $persentase_reject_akumulatif_neg[$i] : 0,
                        );
                    } else {
                        $plateinputnew[$id_plateinputDBNEG[$i]] = $id_plateinputDBNEG[$i];
                        $data_plate_old_neg[] = array(
                            'id' => $id_plateinputDBNEG[$i],
                            'plate' => $plate_neg[$i],
                            'barcode' => ($barcode_neg[$i] !== NULL ? $barcode_neg[$i] !== NULL : 0) ? $barcode_neg[$i] : 0,
                            'act' => ($act_neg[$i] !== NULL ? $act_neg[$i] !== NULL : 0) ? $act_neg[$i] : 0,
                            'deviasi' => ($deviasi_neg[$i] !== NULL ? $deviasi_neg[$i] !== NULL : '+ 0') ? $deviasi_neg[$i] : '+ 0',
                            'hasil_produksi' => ($hasil_produksi_neg[$i] !== NULL ? $hasil_produksi_neg[$i] !== NULL : 0) ? $hasil_produksi_neg[$i] : 0,
                            'terpotong_panel' => ($terpotong_panel_neg[$i] !== NULL ? $terpotong_panel_neg[$i] !== NULL : 0) ? $terpotong_panel_neg[$i] : 0,
                            'tersangkut_panel' => ($tersangkut_panel_neg[$i] !== NULL ? $tersangkut_panel_neg[$i] !== NULL : 0)  ? $tersangkut_panel_neg[$i] : 0,
                            'overbrush_panel' => ($overbrush_panel_neg[$i] !== NULL ? $overbrush_panel_neg[$i] !== NULL : 0) ? $overbrush_panel_neg[$i] : 0,
                            'rontok_panel' => ($rontok_panel_neg[$i] !== NULL ? $rontok_panel_neg[$i] !== NULL : 0) ? $rontok_panel_neg[$i] : 0,
                            'lug_patah_panel' => ($lug_patah_panel_neg[$i] !== NULL ? $lug_patah_panel_neg[$i] !== NULL : 0) ? $lug_patah_panel_neg[$i] : 0,
                            'patah_kaki_panel' => ($patah_kaki_panel_neg[$i] !== NULL ? $patah_kaki_panel_neg[$i] !== NULL : 0) ? $patah_kaki_panel_neg[$i] : 0,
                            'patah_frame_panel' => ($patah_frame_panel_neg[$i] !== NULL ? $patah_frame_panel_neg[$i] !== NULL : 0) ? $patah_frame_panel_neg[$i] : 0,
                            'bolong_panel' => ($bolong_panel_neg[$i] !== NULL ? $bolong_panel_neg[$i] !== NULL : 0) ? $bolong_panel_neg[$i] : 0,
                            'bending_panel' => ($bending_panel_neg[$i] !== NULL ? $bending_panel_neg[$i] !== NULL : 0) ? $bending_panel_neg[$i] : 0,
                            'lengket_terpotong_panel' => ($lengket_terpotong_panel_neg[$i] !== NULL ? $lengket_terpotong_panel_neg[$i] !== NULL : 0) ? $lengket_terpotong_panel_neg[$i] : 0,
                            'terpotong_kg' => $terpotong_kg_neg[$i] !== NULL ? $terpotong_kg_neg[$i] : 0,
                            'tersangkut_kg' => $tersangkut_kg_neg[$i] !== NULL ? $tersangkut_kg_neg[$i] : 0,
                            'overbrush_kg' => $overbrush_kg_neg[$i] !== NULL ? $overbrush_kg_neg[$i] : 0,
                            'rontok_kg' => $rontok_kg_neg[$i] !== NULL ? $rontok_kg_neg[$i] : 0,
                            'lug_patah_kg' => $lug_patah_kg_neg[$i] !== NULL ? $lug_patah_kg_neg[$i] : 0,
                            'patah_kaki_kg' => $patah_kaki_kg_neg[$i] !== NULL ? $patah_kaki_kg_neg[$i] : 0,
                            'patah_frame_kg' => $patah_frame_kg_neg[$i] !== NULL ? $patah_frame_kg_neg[$i] : 0,
                            'bolong_kg' => $bolong_kg_neg[$i] !== NULL ? $bolong_kg_neg[$i] : 0,
                            'bending_kg' => $bending_kg_neg[$i] !== NULL ? $bending_kg_neg[$i] : 0,
                            'lengket_terpotong_kg' => $lengket_terpotong_kg_neg[$i] !== NULL ? $lengket_terpotong_kg_neg[$i] : 0,
                            'persentase_reject_internal' => $persentase_reject_internal_neg[$i] !== NULL ? $persentase_reject_internal_neg[$i] : 0,
                            'persentase_reject_eksternal' => $persentase_reject_eksternal_neg[$i] !== NULL ? $persentase_reject_eksternal_neg[$i] : 0,
                            'persentase_reject_akumulatif' => $persentase_reject_akumulatif_neg[$i] !== NULL ? $persentase_reject_akumulatif_neg[$i] : 0,
                        );
                        $this->plateInputModel->updateBatch($data_plate_old_neg, 'id');
                    }
                }
            }
            if (count($data_plate_new_neg) > 0) {
                $this->plateInputModel->insertBatch($data_plate_new_neg);
            }
        }
        foreach ($plateinput as $pi) {
            if ($plateinputnew !== NULL) {
                if (!array_key_exists($pi['id'], $plateinputnew)) {
                    $this->plateInputModel->delete($pi['id']);
                }
            } else {
                $this->plateInputModel->delete($pi['id']);
            }
        }
        return redirect()->to(base_url('platecutting/add_platecutting/' . $id));
    }

    public function detail_platecutting($id)
    {
        $session = \Config\Services::session();
        $status = $session->get('level');
        if ($status !== 1) {
            return redirect()->to(base_url('/platecutting'));
        }
        $plate = $this->plateModel->findAll();
        $team = $this->teamModel->findAll();
        $platecutting = $this->platecuttingModel->find($id);
        $plateinput = $this->plateInputModel->where('id_platecutting', $id)->findAll();
        $data = [
            'plate' => $plate,
            'team' => $team,
            'platecutting' => $platecutting,
            'plateinput' => $plateinput
        ];

        return view('pages/plate_cutting/detail_platecutting', $data);
    }

    public function edit()
    {
        $id_platecutting = $this->request->getVar('id_platecutting');
        $id_plateinputDBPOS = $this->request->getVar('id_plateinputDBPOS');
        $id_plateinputDBNEG = $this->request->getVar('id_plateinputDBNEG');
        // $id_plateinputDBPOS = $this->request->getVar('id_plateinput_pos');
        // $id_plateinputDBNEG = $this->request->getVar('id_plateinput_neg');
        $edit = $this->request->getVar('edit');
        $reject = $this->request->getVar('rejected');
        $approve = $this->request->getVar('approved');
        $date = $this->request->getVar('date');
        $line = $this->request->getVar('line');
        $shift = $this->request->getVar('shift');
        $team = $this->request->getVar('team');
        $plate_pos = $this->request->getVar('plate_pos');
        $hasil_produksi_pos = $this->request->getVar('hasil_produksi_pos');
        $terpotong_panel_pos = $this->request->getVar('terpotong_panel_pos');
        $tersangkut_panel_pos = $this->request->getVar('tersangkut_panel_pos');
        $overbrush_panel_pos = $this->request->getVar('overbrush_panel_pos');
        $rontok_panel_pos = $this->request->getVar('rontok_panel_pos');
        $lug_patah_panel_pos = $this->request->getVar('lug_patah_panel_pos');
        $patah_kaki_panel_pos = $this->request->getVar('patah_kaki_panel_pos');
        $patah_frame_panel_pos = $this->request->getVar('patah_frame_panel_pos');
        $bolong_panel_pos = $this->request->getVar('bolong_panel_pos');
        $bending_panel_pos = $this->request->getVar('bending_panel_pos');
        $lengket_terpotong_panel_pos = $this->request->getVar('lengket_terpotong_panel_pos');
        $terpotong_kg_pos = $this->request->getVar('terpotong_kg_pos');
        $tersangkut_kg_pos = $this->request->getVar('tersangkut_kg_pos');
        $overbrush_kg_pos = $this->request->getVar('overbrush_kg_pos');
        $rontok_kg_pos = $this->request->getVar('rontok_kg_pos');
        $lug_patah_kg_pos = $this->request->getVar('lug_patah_kg_pos');
        $patah_kaki_kg_pos = $this->request->getVar('patah_kaki_kg_pos');
        $patah_frame_kg_pos = $this->request->getVar('patah_frame_kg_pos');
        $bolong_kg_pos = $this->request->getVar('bolong_kg_pos');
        $bending_kg_pos = $this->request->getVar('bending_kg_pos');
        $lengket_terpotong_kg_pos = $this->request->getVar('lengket_terpotong_kg_pos');
        $persentase_reject_internal_pos = $this->request->getVar('persentase_reject_internal_pos');
        $persentase_reject_eksternal_pos = $this->request->getVar('persentase_reject_eksternal_pos');
        $persentase_reject_akumulatif_pos = $this->request->getVar('persentase_reject_akumulatif_pos');
        $plate_neg = $this->request->getVar('plate_neg');
        $hasil_produksi_neg = $this->request->getVar('hasil_produksi_neg');
        $terpotong_panel_neg = $this->request->getVar('terpotong_panel_neg');
        $tersangkut_panel_neg = $this->request->getVar('tersangkut_panel_neg');
        $overbrush_panel_neg = $this->request->getVar('overbrush_panel_neg');
        $rontok_panel_neg = $this->request->getVar('rontok_panel_neg');
        $lug_patah_panel_neg = $this->request->getVar('lug_patah_panel_neg');
        $patah_kaki_panel_neg = $this->request->getVar('patah_kaki_panel_neg');
        $patah_frame_panel_neg = $this->request->getVar('patah_frame_panel_neg');
        $bolong_panel_neg = $this->request->getVar('bolong_panel_neg');
        $bending_panel_neg = $this->request->getVar('bending_panel_neg');
        $lengket_terpotong_panel_neg = $this->request->getVar('lengket_terpotong_panel_neg');
        $terpotong_kg_neg = $this->request->getVar('terpotong_kg_neg');
        $tersangkut_kg_neg = $this->request->getVar('tersangkut_kg_neg');
        $overbrush_kg_neg = $this->request->getVar('overbrush_kg_neg');
        $rontok_kg_neg = $this->request->getVar('rontok_kg_neg');
        $lug_patah_kg_neg = $this->request->getVar('lug_patah_kg_neg');
        $patah_kaki_kg_neg = $this->request->getVar('patah_kaki_kg_neg');
        $patah_frame_kg_neg = $this->request->getVar('patah_frame_kg_neg');
        $bolong_kg_neg = $this->request->getVar('bolong_kg_neg');
        $bending_kg_neg = $this->request->getVar('bending_kg_neg');
        $lengket_terpotong_kg_neg = $this->request->getVar('lengket_terpotong_kg_neg');
        $persentase_reject_internal_neg = $this->request->getVar('persentase_reject_internal_neg');
        $persentase_reject_eksternal_neg = $this->request->getVar('persentase_reject_eksternal_neg');
        $persentase_reject_akumulatif_neg = $this->request->getVar('persentase_reject_akumulatif_neg');
        $barcode_pos = $this->request->getVar('barcode_pos');
        $act_pos = $this->request->getVar('act_pos');
        $deviasi_pos = $this->request->getVar('deviasi_pos');
        $barcode_neg = $this->request->getVar('barcode_neg');
        $act_neg = $this->request->getVar('act_neg');
        $deviasi_neg = $this->request->getVar('deviasi_neg');

        if ($edit !== NULL) {
            $data_platecutting[] = array(
                'id' => $id_platecutting,
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'team' => $team,
                'status' => 'pending',
            );
            $this->platecuttingModel->updateBatch($data_platecutting, 'id');
            for ($i = 0; $i < ($id_plateinputDBPOS !== NULL ? count($id_plateinputDBPOS) : 0); $i++) {
                if ($plate_pos[$i] !== NULL) {
                    $data_plate_pos[] = array(
                        'id' => $id_plateinputDBPOS[$i],
                        'plate' => $plate_pos[$i],
                        'barcode' => $barcode_pos[$i] !== NULL ? $barcode_pos[$i] : 0,
                        'act' => $act_pos[$i] !== NULL ? $act_pos[$i] : 0,
                        'deviasi' => $deviasi_pos[$i] !== NULL ? $deviasi_pos[$i] : '+ 0',
                        'hasil_produksi' => $hasil_produksi_pos[$i] !== NULL ? $hasil_produksi_pos[$i] : 0,
                        'terpotong_panel' => $terpotong_panel_pos[$i] !== NULL ? $terpotong_panel_pos[$i] : 0,
                        'tersangkut_panel' => $tersangkut_panel_pos[$i] !== NULL ? $tersangkut_panel_pos[$i] : 0,
                        'overbrush_panel' => $overbrush_panel_pos[$i] !== NULL ? $overbrush_panel_pos[$i] : 0,
                        'rontok_panel' => $rontok_panel_pos[$i] !== NULL ? $rontok_panel_pos[$i] : 0,
                        'lug_patah_panel' => $lug_patah_panel_pos[$i] !== NULL ? $lug_patah_panel_pos[$i] : 0,
                        'patah_kaki_panel' => $patah_kaki_panel_pos[$i] !== NULL ? $patah_kaki_panel_pos[$i] : 0,
                        'patah_frame_panel' => $patah_frame_panel_pos[$i] !== NULL ? $patah_frame_panel_pos[$i] : 0,
                        'bolong_panel' => $bolong_panel_pos[$i] !== NULL ? $bolong_panel_pos[$i] : 0,
                        'bending_panel' => $bending_panel_pos[$i] !== NULL ? $bending_panel_pos[$i] : 0,
                        'lengket_terpotong_panel' => $lengket_terpotong_panel_pos[$i] !== NULL ? $lengket_terpotong_panel_pos[$i] : 0,
                        'terpotong_kg' => $terpotong_kg_pos[$i] !== NULL ? $terpotong_kg_pos[$i] : 0,
                        'tersangkut_kg' => $tersangkut_kg_pos[$i] !== NULL ? $tersangkut_kg_pos[$i] : 0,
                        'overbrush_kg' => $overbrush_kg_pos[$i] !== NULL ? $overbrush_kg_pos[$i] : 0,
                        'rontok_kg' => $rontok_kg_pos[$i] !== NULL ? $rontok_kg_pos[$i] : 0,
                        'lug_patah_kg' => $lug_patah_kg_pos[$i] !== NULL ? $lug_patah_kg_pos[$i] : 0,
                        'patah_kaki_kg' => $patah_kaki_kg_pos[$i] !== NULL ? $patah_kaki_kg_pos[$i] : 0,
                        'patah_frame_kg' => $patah_frame_kg_pos[$i] !== NULL ? $patah_frame_kg_pos[$i] : 0,
                        'bolong_kg' => $bolong_kg_pos[$i] !== NULL ? $bolong_kg_pos[$i] : 0,
                        'bending_kg' => $bending_kg_pos[$i] !== NULL ? $bending_kg_pos[$i] : 0,
                        'lengket_terpotong_kg' => $lengket_terpotong_kg_pos[$i] !== NULL ? $lengket_terpotong_kg_pos[$i] : 0,
                        'persentase_reject_internal' => $persentase_reject_internal_pos[$i] !== NULL ? $persentase_reject_internal_pos[$i] : 0,
                        'persentase_reject_eksternal' => $persentase_reject_eksternal_pos[$i] !== NULL ? $persentase_reject_eksternal_pos[$i] : 0,
                        'persentase_reject_akumulatif' => $persentase_reject_akumulatif_pos[$i] !== NULL ? $persentase_reject_akumulatif_pos[$i] : 0,
                    );
                    $this->plateInputModel->updateBatch($data_plate_pos, 'id');
                }
            }
            for ($i = 0; $i < ($id_plateinputDBNEG !== NULL ? count($id_plateinputDBNEG) : 0); $i++) {
                if ($plate_neg[$i] !== NULL) {
                    $data_plate_neg[] = array(
                        'id' => $id_plateinputDBNEG[$i],
                        'plate' => $plate_neg[$i],
                        'barcode' => $barcode_neg[$i] !== NULL ? $barcode_neg[$i] : 0,
                        'act' => $act_neg[$i] !== NULL ? $act_neg[$i] : 0,
                        'deviasi' => $deviasi_neg[$i] !== NULL ? $deviasi_neg[$i] : '+ 0',
                        'hasil_produksi' => $hasil_produksi_neg[$i] !== NULL ? $hasil_produksi_neg[$i] : 0,
                        'terpotong_panel' => $terpotong_panel_neg[$i] !== NULL ? $terpotong_panel_neg[$i] : 0,
                        'tersangkut_panel' => $tersangkut_panel_neg[$i] !== NULL ? $tersangkut_panel_neg[$i] : 0,
                        'overbrush_panel' => $overbrush_panel_neg[$i] !== NULL ? $overbrush_panel_neg[$i] : 0,
                        'rontok_panel' => $rontok_panel_neg[$i] !== NULL ? $rontok_panel_neg[$i] : 0,
                        'lug_patah_panel' => $lug_patah_panel_neg[$i] !== NULL ? $lug_patah_panel_neg[$i] : 0,
                        'patah_kaki_panel' => $patah_kaki_panel_neg[$i] !== NULL ? $patah_kaki_panel_neg[$i] : 0,
                        'patah_frame_panel' => $patah_frame_panel_neg[$i] !== NULL ? $patah_frame_panel_neg[$i] : 0,
                        'bolong_panel' => $bolong_panel_neg[$i] !== NULL ? $bolong_panel_neg[$i] : 0,
                        'bending_panel' => $bending_panel_neg[$i] !== NULL ? $bending_panel_neg[$i] : 0,
                        'lengket_terpotong_panel' => $lengket_terpotong_panel_neg[$i] !== NULL ? $lengket_terpotong_panel_neg[$i] : 0,
                        'terpotong_kg' => $terpotong_kg_neg[$i] !== NULL ? $terpotong_kg_neg[$i] : 0,
                        'tersangkut_kg' => $tersangkut_kg_neg[$i] !== NULL ? $tersangkut_kg_neg[$i] : 0,
                        'overbrush_kg' => $overbrush_kg_neg[$i] !== NULL ? $overbrush_kg_neg[$i] : 0,
                        'rontok_kg' => $rontok_kg_neg[$i] !== NULL ? $rontok_kg_neg[$i] : 0,
                        'lug_patah_kg' => $lug_patah_kg_neg[$i] !== NULL ? $lug_patah_kg_neg[$i] : 0,
                        'patah_kaki_kg' => $patah_kaki_kg_neg[$i] !== NULL ? $patah_kaki_kg_neg[$i] : 0,
                        'patah_frame_kg' => $patah_frame_kg_neg[$i] !== NULL ? $patah_frame_kg_neg[$i] : 0,
                        'bolong_kg' => $bolong_kg_neg[$i] !== NULL ? $bolong_kg_neg[$i] : 0,
                        'bending_kg' => $bending_kg_neg[$i] !== NULL ? $bending_kg_neg[$i] : 0,
                        'lengket_terpotong_kg' => $lengket_terpotong_kg_neg[$i] !== NULL ? $lengket_terpotong_kg_neg[$i] : 0,
                        'persentase_reject_internal' => $persentase_reject_internal_neg[$i] !== NULL ? $persentase_reject_internal_neg[$i] : 0,
                        'persentase_reject_eksternal' => $persentase_reject_eksternal_neg[$i] !== NULL ? $persentase_reject_eksternal_neg[$i] : 0,
                        'persentase_reject_akumulatif' => $persentase_reject_akumulatif_neg[$i] !== NULL ? $persentase_reject_akumulatif_neg[$i] : 0,
                    );
                    $this->plateInputModel->updateBatch($data_plate_neg, 'id');
                }
            }
        } else if ($reject !== NULL) {
            $data_plateinput[] = array(
                'id' => $id_platecutting,
                'status' => $reject
            );
            $this->platecuttingModel->updateBatch($data_plateinput, 'id');
        } else if ($approve !== NULL) {
            $data_plateinput[] = array(
                'id' => $id_platecutting,
                'status' => $approve
            );
            $this->platecuttingModel->updateBatch($data_plateinput, 'id');
        }
        return redirect()->to(base_url('/platecutting'));
    }

    public function delete_platecutting()
    {
        $id_platecutting = $this->request->getVar('id_platecutting');
        $this->platecuttingModel->delete(['id' => $id_platecutting]);
        $this->plateInputModel->delete(['id_platecutting' => $id_platecutting]);

        return redirect()->to(base_url('/platecutting'));
    }

    public function download()
    {
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $platecutting = $this->platecuttingModel->where('date >=', $start_date)->where('date <=', $end_date)->findAll();
        $plateinput = $this->plateInputModel->findAll();
        $dates = array_column($platecutting, "date");
        $lines = array_column($platecutting, "line");
        $shift = array_column($platecutting, "shift");
        array_multisort($lines, SORT_ASC, $dates, SORT_ASC, $shift, SORT_ASC,  $platecutting);
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Menambahkan data ke worksheet
        $sheet = $spreadsheet->getActiveSheet();
        $data = array(
            array('', '', '', '', '', '', '', '', '', 'Jumlah NG (Panel)', '', '', '', '', '', '', '', '', '', 'Jumlah NG (Kg)'),
            array('', '', '', '', '', '', '', '', '', 'Internal', '', '', 'Eksternal', '', '', '', '', '', '', 'Internal', '', '', 'Eksternal'),
            array('Date', 'Line', 'Shift', 'Team', 'Plate', 'Barcode', 'Act', '🔺 Deviasi', 'Hasil Produksi', 'Terpotong', 'Tersangkut', 'Overbrush', 'Rontok', 'Lug Patah', 'Patah Kaki', 'Patah Frame', 'Bolong', 'Bending', 'Lengket Terpotong', 'Terpotong', 'Tersangkut', 'Overbrush', 'Rontok', 'Lug Patah', 'Patah Kaki', 'Patah Frame', 'Bolong', 'Bending', 'Lengket Terpotong', 'Persentase Reject Internal', 'Persentase Reject Eksternal', 'Persentase Reject Akumulatif', 'Status'),
        );
        $isExist = [];
        foreach ($platecutting as $pc) {
            // if ($pc['status'] === 'approved') {
            if (!array_key_exists($pc['id'], $isExist)) {
                foreach ($plateinput as $pi) {
                    if ($pc['id'] === $pi['id_platecutting']) {
                        $isExist[$pc['id']] = $pc['id'];
                        $data[] = array($pc['date'], $pc['line'], $pc['shift'], $pc['team'], $pi['plate'], $pi['barcode'], $pi['act'], $pi['deviasi'], $pi['hasil_produksi'], $pi['terpotong_panel'], $pi['tersangkut_panel'], $pi['overbrush_panel'], $pi['rontok_panel'], $pi['lug_patah_panel'], $pi['patah_kaki_panel'], $pi['patah_frame_panel'], $pi['bolong_panel'], $pi['bending_panel'], $pi['lengket_terpotong_panel'], $pi['terpotong_kg'], $pi['tersangkut_kg'], $pi['overbrush_kg'], $pi['rontok_kg'], $pi['lug_patah_kg'], $pi['patah_kaki_kg'], $pi['patah_frame_kg'], $pi['bolong_kg'], $pi['bending_kg'], $pi['lengket_terpotong_kg'], $pi['persentase_reject_internal'], $pi['persentase_reject_eksternal'], $pi['persentase_reject_akumulatif'], $pc['status']);
                    }
                }
            }
            // }
        };

        // Memasukkan data array ke dalam worksheet
        $sheet->fromArray($data);


        // Mengatur header respons HTTP
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        ob_end_clean();
        // Membuat objek Writer untuk menulis spreadsheet ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
