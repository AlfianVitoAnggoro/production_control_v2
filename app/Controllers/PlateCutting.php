<?php

namespace App\Controllers;

use App\Models\M_Plate;
use App\Models\M_PlateCutting;
use App\Models\M_PlateInput;
use App\Models\M_Team;

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
        $platecutting = $this->platecuttingModel->findAll();
        $dates = array_column($platecutting, "date");
        $lines = array_column($platecutting, "line");
        $shifts = array_column($platecutting, "shift");
        array_multisort($dates, SORT_ASC, $lines, SORT_ASC, $shifts, SORT_ASC, $platecutting);
        $plateInput = $this->plateInputModel->findAll();
        $data = [
            'platecutting' => $platecutting,
            'plateinput' => $plateInput
        ];
        return view('pages/plate_cutting/platecutting_view', $data);
    }

    public function getPlate()
    {
        $plate = $this->plateModel->findAll();
        return $plate;
    }

    public function add_platecutting()
    {
        $plate = $this->plateModel->findAll();
        $team = $this->teamModel->findAll();
        $data = [
            'plate' => $plate,
            'team' => $team
        ];
        return view('pages/plate_cutting/add_platecutting', $data);
    }

    public function save()
    {
        // $platecutting_pos = $this->platecuttingModel->findAll();
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
        if ($line !== NULL) {
            $id = 'D' . $date . 'L' . $line . 'S' . $shift;
            $data_platecutting[] = array(
                'id' => $id,
                'date' => $date,
                'line' => $line,
                'shift' => $shift,
                'team' => $team,
                'id_plateinput' => $id,
            );
            if ($plate_pos !== NULL) {
                for ($i = 0; $i < count($plate_pos); $i++) {
                    $data_plate_pos[] = array(
                        'id' => $id,
                        'id_platecutting' => $id,
                        'plate' => $plate_pos[$i],
                        'hasil_produksi' => $hasil_produksi_pos[$i],
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
                }
                $this->plateInputModel->insertBatch($data_plate_pos);
            }
            if ($plate_neg !== NULL) {
                for ($i = 0; $i < count($plate_neg); $i++) {
                    $data_plate_neg[] = array(
                        'id' => $id,
                        'id_platecutting' => $id,
                        'plate' => $plate_neg[$i],
                        'hasil_produksi' => $hasil_produksi_neg[$i],
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
                }
                $this->plateInputModel->insertBatch($data_plate_neg);
            }
            $this->platecuttingModel->insertBatch($data_platecutting);
        }
        return redirect()->to('/lhp/platecutting');
    }
}
