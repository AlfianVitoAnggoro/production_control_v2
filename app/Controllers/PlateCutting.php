<?php

namespace App\Controllers;

use App\Models\M_Plate;
use App\Models\M_PlateCutting;
use App\Models\M_PlateInput;

use function PHPUnit\Framework\countOf;

class PlateCutting extends BaseController
{
    protected $plateModel;
    protected $plateInputModel;
    protected $platecuttingModel;
    public function __construct()
    {
        $this->plateModel = new M_Plate();
        $this->plateInputModel = new M_PlateInput();
        $this->platecuttingModel = new M_PlateCutting();
    }
    public function platecutting_view()
    {
        $platecutting = $this->platecuttingModel->findAll();
        $dates = array_column($platecutting, "date");
        $lines = array_column($platecutting, "line");
        array_multisort($lines, SORT_ASC, $dates, SORT_ASC, $platecutting);
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
        $data = [
            'plate' => $plate
        ];
        return view('pages/plate_cutting/add_platecutting', $data);
    }

    public function save()
    {
        $platecutting_pos = $this->platecuttingModel->findAll();
        $date_pos = $this->request->getVar('date_pos');
        $line_pos = $this->request->getVar('line_pos');
        $shift_pos = $this->request->getVar('shift_pos');
        $plate_pos = [];
        $hasil_produksi_pos = [];
        $terpotong_panel_pos = [];
        $tersangkut_panel_pos = [];
        $overbrush_panel_pos = [];
        $rontok_panel_pos = [];
        $lug_patah_panel_pos = [];
        $patah_kaki_panel_pos = [];
        $patah_frame_panel_pos = [];
        $bolong_panel_pos = [];
        $bending_panel_pos = [];
        $lengket_terpotong_panel_pos = [];
        $terpotong_kg_pos = [];
        $tersangkut_kg_pos = [];
        $overbrush_kg_pos = [];
        $rontok_kg_pos = [];
        $lug_patah_kg_pos = [];
        $patah_kaki_kg_pos = [];
        $patah_frame_kg_pos = [];
        $bolong_kg_pos = [];
        $bending_kg_pos = [];
        $lengket_terpotong_kg_pos = [];
        $persentase_reject_internal_pos = [];
        $persentase_reject_eksternal_pos = [];
        $persentase_reject_akumulatif_pos = [];
        if ($line_pos !== NULL) {
            for ($i = 0; $i < count($line_pos); $i++) {
                array_push($plate_pos, $this->request->getVar('plate_' . $i . '_pos'));
                array_push($hasil_produksi_pos, $this->request->getVar('hasil_produksi_' . $i . '_pos'));
                array_push($terpotong_panel_pos, $this->request->getVar('terpotong_panel_' . $i . '_pos'));
                array_push($tersangkut_panel_pos, $this->request->getVar('tersangkut_panel_' . $i . '_pos'));
                array_push($overbrush_panel_pos, $this->request->getVar('overbrush_panel_' . $i . '_pos'));
                array_push($rontok_panel_pos, $this->request->getVar('rontok_panel_' . $i . '_pos'));
                array_push($lug_patah_panel_pos, $this->request->getVar('lug_patah_panel_' . $i . '_pos'));
                array_push($patah_kaki_panel_pos, $this->request->getVar('patah_kaki_panel_' . $i . '_pos'));
                array_push($patah_frame_panel_pos, $this->request->getVar('patah_frame_panel_' . $i . '_pos'));
                array_push($bolong_panel_pos, $this->request->getVar('bolong_panel_' . $i . '_pos'));
                array_push($bending_panel_pos, $this->request->getVar('bending_panel_' . $i . '_pos'));
                array_push($lengket_terpotong_panel_pos, $this->request->getVar('lengket_terpotong_panel_' . $i . '_pos'));
                array_push($terpotong_kg_pos, $this->request->getVar('terpotong_kg_' . $i . '_pos'));
                array_push($tersangkut_kg_pos, $this->request->getVar('tersangkut_kg_' . $i . '_pos'));
                array_push($overbrush_kg_pos, $this->request->getVar('overbrush_kg_' . $i . '_pos'));
                array_push($rontok_kg_pos, $this->request->getVar('rontok_kg_' . $i . '_pos'));
                array_push($lug_patah_kg_pos, $this->request->getVar('lug_patah_kg_' . $i . '_pos'));
                array_push($patah_kaki_kg_pos, $this->request->getVar('patah_kaki_kg_' . $i . '_pos'));
                array_push($patah_frame_kg_pos, $this->request->getVar('patah_frame_kg_' . $i . '_pos'));
                array_push($bolong_kg_pos, $this->request->getVar('bolong_kg_' . $i . '_pos'));
                array_push($bending_kg_pos, $this->request->getVar('bending_kg_' . $i . '_pos'));
                array_push($lengket_terpotong_kg_pos, $this->request->getVar('lengket_terpotong_kg_' . $i . '_pos'));
                array_push($persentase_reject_internal_pos, $this->request->getVar('persentase_reject_internal_' . $i . '_pos'));
                array_push($persentase_reject_eksternal_pos, $this->request->getVar('persentase_reject_eksternal_' . $i . '_pos'));
                array_push($persentase_reject_akumulatif_pos, $this->request->getVar('persentase_reject_akumulatif_' . $i . '_pos'));
            }
            $sumx = count($platecutting_pos) + 1;
            for ($i = 0; $i < count($line_pos); $i++) {
                $id = $sumx + $i;
                $data_platecutting_pos[] = array(
                    'id' => $id,
                    'date' => $date_pos[$i],
                    'line' => $line_pos[$i],
                    'shift' => $shift_pos[$i],
                    'id_plateinput' => $id,
                );
                for ($j = 0; $j < count($plate_pos[$i]); $j++) {
                    $data_plate_pos[] = array(
                        'id' => $id,
                        'id_platecutting' => $id,
                        'plate' => $plate_pos[$i][$j],
                        'hasil_produksi' => $hasil_produksi_pos[$i][$j],
                        'terpotong_panel' => ($terpotong_panel_pos[$i] !== NULL ? $terpotong_panel_pos[$i][$j] !== NULL : 0) ? $terpotong_panel_pos[$i][$j] : 0,
                        'tersangkut_panel' => ($tersangkut_panel_pos[$i] !== NULL ? $tersangkut_panel_pos[$i][$j] !== NULL : 0)  ? $tersangkut_panel_pos[$i][$j] : 0,
                        'overbrush_panel' => ($overbrush_panel_pos[$i] !== NULL ? $overbrush_panel_pos[$i][$j] !== NULL : 0) ? $overbrush_panel_pos[$i][$j] : 0,
                        'rontok_panel' => ($rontok_panel_pos[$i] !== NULL ? $rontok_panel_pos[$i][$j] !== NULL : 0) ? $rontok_panel_pos[$i][$j] : 0,
                        'lug_patah_panel' => ($lug_patah_panel_pos[$i] !== NULL ? $lug_patah_panel_pos[$i][$j] !== NULL : 0) ? $lug_patah_panel_pos[$i][$j] : 0,
                        'patah_kaki_panel' => ($patah_kaki_panel_pos[$i] !== NULL ? $patah_kaki_panel_pos[$i][$j] !== NULL : 0) ? $patah_kaki_panel_pos[$i][$j] : 0,
                        'patah_frame_panel' => ($patah_frame_panel_pos[$i] !== NULL ? $patah_frame_panel_pos[$i][$j] !== NULL : 0) ? $patah_frame_panel_pos[$i][$j] : 0,
                        'bolong_panel' => ($bolong_panel_pos[$i] !== NULL ? $bolong_panel_pos[$i][$j] !== NULL : 0) ? $bolong_panel_pos[$i][$j] : 0,
                        'bending_panel' => ($bending_panel_pos[$i] !== NULL ? $bending_panel_pos[$i][$j] !== NULL : 0) ? $bending_panel_pos[$i][$j] : 0,
                        'lengket_terpotong_panel' => ($lengket_terpotong_panel_pos[$i] !== NULL ? $lengket_terpotong_panel_pos[$i][$j] !== NULL : 0) ? $lengket_terpotong_panel_pos[$i][$j] : 0,
                        'terpotong_kg' => $terpotong_kg_pos[$i] !== NULL ? $terpotong_kg_pos[$i][$j] : 0,
                        'tersangkut_kg' => $tersangkut_kg_pos[$i] !== NULL ? $tersangkut_kg_pos[$i][$j] : 0,
                        'overbrush_kg' => $overbrush_kg_pos[$i] !== NULL ? $overbrush_kg_pos[$i][$j] : 0,
                        'rontok_kg' => $rontok_kg_pos[$i] !== NULL ? $rontok_kg_pos[$i][$j] : 0,
                        'lug_patah_kg' => $lug_patah_kg_pos[$i] !== NULL ? $lug_patah_kg_pos[$i][$j] : 0,
                        'patah_kaki_kg' => $patah_kaki_kg_pos[$i] !== NULL ? $patah_kaki_kg_pos[$i][$j] : 0,
                        'patah_frame_kg' => $patah_frame_kg_pos[$i] !== NULL ? $patah_frame_kg_pos[$i][$j] : 0,
                        'bolong_kg' => $bolong_kg_pos[$i] !== NULL ? $bolong_kg_pos[$i][$j] : 0,
                        'bending_kg' => $bending_kg_pos[$i] !== NULL ? $bending_kg_pos[$i][$j] : 0,
                        'lengket_terpotong_kg' => $lengket_terpotong_kg_pos[$i] !== NULL ? $lengket_terpotong_kg_pos[$i][$j] : 0,
                        'persentase_reject_internal' => $persentase_reject_internal_pos[$i] !== NULL ? $persentase_reject_internal_pos[$i][$j] : 0,
                        'persentase_reject_eksternal' => $persentase_reject_eksternal_pos[$i] !== NULL ? $persentase_reject_eksternal_pos[$i][$j] : 0,
                        'persentase_reject_akumulatif' => $persentase_reject_akumulatif_pos[$i] !== NULL ? $persentase_reject_akumulatif_pos[$i][$j] : 0,
                    );
                }
            };


            $this->platecuttingModel->insertBatch($data_platecutting_pos);
            $this->plateInputModel->insertBatch($data_plate_pos);
        }

        $platecutting_neg = $this->platecuttingModel->findAll();
        $date_neg = $this->request->getVar('date_neg');
        $line_neg = $this->request->getVar('line_neg');
        $shift_neg = $this->request->getVar('shift_neg');
        $plate_neg = [];
        $hasil_produksi_neg = [];
        $terpotong_panel_neg = [];
        $tersangkut_panel_neg = [];
        $overbrush_panel_neg = [];
        $rontok_panel_neg = [];
        $lug_patah_panel_neg = [];
        $patah_kaki_panel_neg = [];
        $patah_frame_panel_neg = [];
        $bolong_panel_neg = [];
        $bending_panel_neg = [];
        $lengket_terpotong_panel_neg = [];
        $terpotong_kg_neg = [];
        $tersangkut_kg_neg = [];
        $overbrush_kg_neg = [];
        $rontok_kg_neg = [];
        $lug_patah_kg_neg = [];
        $patah_kaki_kg_neg = [];
        $patah_frame_kg_neg = [];
        $bolong_kg_neg = [];
        $bending_kg_neg = [];
        $lengket_terpotong_kg_neg = [];
        $persentase_reject_internal_neg = [];
        $persentase_reject_eksternal_neg = [];
        $persentase_reject_akumulatif_neg = [];
        if ($line_neg !== NULL) {
            for ($i = 0; $i < count($line_neg); $i++) {
                array_push($plate_neg, $this->request->getVar('plate_' . $i . '_neg'));
                array_push($hasil_produksi_neg, $this->request->getVar('hasil_produksi_' . $i . '_neg'));
                array_push($terpotong_panel_neg, $this->request->getVar('terpotong_panel_' . $i . '_neg'));
                array_push($tersangkut_panel_neg, $this->request->getVar('tersangkut_panel_' . $i . '_neg'));
                array_push($overbrush_panel_neg, $this->request->getVar('overbrush_panel_' . $i . '_neg'));
                array_push($rontok_panel_neg, $this->request->getVar('rontok_panel_' . $i . '_neg'));
                array_push($lug_patah_panel_neg, $this->request->getVar('lug_patah_panel_' . $i . '_neg'));
                array_push($patah_kaki_panel_neg, $this->request->getVar('patah_kaki_panel_' . $i . '_neg'));
                array_push($patah_frame_panel_neg, $this->request->getVar('patah_frame_panel_' . $i . '_neg'));
                array_push($bolong_panel_neg, $this->request->getVar('bolong_panel_' . $i . '_neg'));
                array_push($bending_panel_neg, $this->request->getVar('bending_panel_' . $i . '_neg'));
                array_push($lengket_terpotong_panel_neg, $this->request->getVar('lengket_terpotong_panel_' . $i . '_neg'));
                array_push($terpotong_kg_neg, $this->request->getVar('terpotong_kg_' . $i . '_neg'));
                array_push($tersangkut_kg_neg, $this->request->getVar('tersangkut_kg_' . $i . '_neg'));
                array_push($overbrush_kg_neg, $this->request->getVar('overbrush_kg_' . $i . '_neg'));
                array_push($rontok_kg_neg, $this->request->getVar('rontok_kg_' . $i . '_neg'));
                array_push($lug_patah_kg_neg, $this->request->getVar('lug_patah_kg_' . $i . '_neg'));
                array_push($patah_kaki_kg_neg, $this->request->getVar('patah_kaki_kg_' . $i . '_neg'));
                array_push($patah_frame_kg_neg, $this->request->getVar('patah_frame_kg_' . $i . '_neg'));
                array_push($bolong_kg_neg, $this->request->getVar('bolong_kg_' . $i . '_neg'));
                array_push($bending_kg_neg, $this->request->getVar('bending_kg_' . $i . '_neg'));
                array_push($lengket_terpotong_kg_neg, $this->request->getVar('lengket_terpotong_kg_' . $i . '_neg'));
                array_push($persentase_reject_internal_neg, $this->request->getVar('persentase_reject_internal_' . $i . '_neg'));
                array_push($persentase_reject_eksternal_neg, $this->request->getVar('persentase_reject_eksternal_' . $i . '_neg'));
                array_push($persentase_reject_akumulatif_neg, $this->request->getVar('persentase_reject_akumulatif_' . $i . '_neg'));
            }
            $sumx = count($platecutting_neg) + 1;
            for ($i = 0; $i < count($line_neg); $i++) {
                $id = $sumx + $i;
                $data_platecutting_neg[] = array(
                    'id' => $id,
                    'date' => $date_neg[$i],
                    'line' => $line_neg[$i],
                    'shift' => $shift_neg[$i],
                    'id_plateinput' => $id,
                );
                for ($j = 0; $j < count($plate_neg[$i]); $j++) {
                    $data_plate_neg[] = array(
                        'id' => $id,
                        'id_platecutting' => $id,
                        'plate' => $plate_neg[$i][$j],
                        'hasil_produksi' => $hasil_produksi_neg[$i][$j],
                        'terpotong_panel' => ($terpotong_panel_neg[$i] !== NULL ? $terpotong_panel_neg[$i][$j] !== NULL : 0) ? $terpotong_panel_neg[$i][$j] : 0,
                        'tersangkut_panel' => ($tersangkut_panel_neg[$i] !== NULL ? $tersangkut_panel_neg[$i][$j] !== NULL : 0)  ? $tersangkut_panel_neg[$i][$j] : 0,
                        'overbrush_panel' => ($overbrush_panel_neg[$i] !== NULL ? $overbrush_panel_neg[$i][$j] !== NULL : 0) ? $overbrush_panel_neg[$i][$j] : 0,
                        'rontok_panel' => ($rontok_panel_neg[$i] !== NULL ? $rontok_panel_neg[$i][$j] !== NULL : 0) ? $rontok_panel_neg[$i][$j] : 0,
                        'lug_patah_panel' => ($lug_patah_panel_neg[$i] !== NULL ? $lug_patah_panel_neg[$i][$j] !== NULL : 0) ? $lug_patah_panel_neg[$i][$j] : 0,
                        'patah_kaki_panel' => ($patah_kaki_panel_neg[$i] !== NULL ? $patah_kaki_panel_neg[$i][$j] !== NULL : 0) ? $patah_kaki_panel_neg[$i][$j] : 0,
                        'patah_frame_panel' => ($patah_frame_panel_neg[$i] !== NULL ? $patah_frame_panel_neg[$i][$j] !== NULL : 0) ? $patah_frame_panel_neg[$i][$j] : 0,
                        'bolong_panel' => ($bolong_panel_neg[$i] !== NULL ? $bolong_panel_neg[$i][$j] !== NULL : 0) ? $bolong_panel_neg[$i][$j] : 0,
                        'bending_panel' => ($bending_panel_neg[$i] !== NULL ? $bending_panel_neg[$i][$j] !== NULL : 0) ? $bending_panel_neg[$i][$j] : 0,
                        'lengket_terpotong_panel' => ($lengket_terpotong_panel_neg[$i] !== NULL ? $lengket_terpotong_panel_neg[$i][$j] !== NULL : 0) ? $lengket_terpotong_panel_neg[$i][$j] : 0,
                        'terpotong_kg' => $terpotong_kg_neg[$i] !== NULL ? $terpotong_kg_neg[$i][$j] : 0,
                        'tersangkut_kg' => $tersangkut_kg_neg[$i] !== NULL ? $tersangkut_kg_neg[$i][$j] : 0,
                        'overbrush_kg' => $overbrush_kg_neg[$i] !== NULL ? $overbrush_kg_neg[$i][$j] : 0,
                        'rontok_kg' => $rontok_kg_neg[$i] !== NULL ? $rontok_kg_neg[$i][$j] : 0,
                        'lug_patah_kg' => $lug_patah_kg_neg[$i] !== NULL ? $lug_patah_kg_neg[$i][$j] : 0,
                        'patah_kaki_kg' => $patah_kaki_kg_neg[$i] !== NULL ? $patah_kaki_kg_neg[$i][$j] : 0,
                        'patah_frame_kg' => $patah_frame_kg_neg[$i] !== NULL ? $patah_frame_kg_neg[$i][$j] : 0,
                        'bolong_kg' => $bolong_kg_neg[$i] !== NULL ? $bolong_kg_neg[$i][$j] : 0,
                        'bending_kg' => $bending_kg_neg[$i] !== NULL ? $bending_kg_neg[$i][$j] : 0,
                        'lengket_terpotong_kg' => $lengket_terpotong_kg_neg[$i] !== NULL ? $lengket_terpotong_kg_neg[$i][$j] : 0,
                        'persentase_reject_internal' => $persentase_reject_internal_neg[$i] !== NULL ? $persentase_reject_internal_neg[$i][$j] : 0,
                        'persentase_reject_eksternal' => $persentase_reject_eksternal_neg[$i] !== NULL ? $persentase_reject_eksternal_neg[$i][$j] : 0,
                        'persentase_reject_akumulatif' => $persentase_reject_akumulatif_neg[$i] !== NULL ? $persentase_reject_akumulatif_neg[$i][$j] : 0,
                    );
                }
            };


            $this->platecuttingModel->insertBatch($data_platecutting_neg);
            $this->plateInputModel->insertBatch($data_plate_neg);
        }
        return redirect()->to('/lhp/platecutting');
    }
}
