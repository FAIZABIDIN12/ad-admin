<?php

namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\TroubleModel;
use App\Models\RoomModel;

class TroubleController extends Controller
{
    public function index()
    {
        $troubleModel = new TroubleModel();
        $data['troubles'] = $troubleModel->findAll();
        return view('admin/trouble_kamar', $data);
    }

    public function solved($id)
    {
        $troubleModel = new TroubleModel();
        $data = $troubleModel->find($id);

        if($data) {
            $troubleModel->set(['is_done' => true])->where('id', $id)->update();

            $roomModel = new RoomModel();
            $room = $roomModel->where('no_kamar', $data['no_kamar'])->find();

            if($room) {
                $roomModel->where('no_kamar', $data['no_kamar'])->set(['status' => 'ready'])->update();
            }
        }

        return redirect()->to(base_url('/admin/trouble-kamar'));        
    }

    public function progress()
    {
        $id = $this->request->getPost('id');
        $progress = $this->request->getPost('progress');


        $troubleModel = new TroubleModel();
        $data = $troubleModel->find($id);

        if($data) {
            $troubleModel->set(['progress' => $progress])->where('id', $id)->update();
        }

        return redirect()->to(base_url('/admin/trouble-kamar'));      
    }
}
