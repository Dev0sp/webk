<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table      = 'referral_code';
    protected $primaryKey = 'id_reff';
    protected $allowedFields = ['code', 'real_code', 'Referral', 'set_saldo', 'used_by', 'created_by'];
    protected $useTimestamps = true;

    public function getCode($limit = 10, $order_by = 'DESC')
    {
        $this->limit($limit);
        $this->orderBy($this->primaryKey, $order_by);
        return $this->get()->getResultObject();
    }

    public function useReferral($code, $username = true)
    {
        $code = $this->checkCode($code);
        //$username = $this->request->getPost('username');
        if ($code and $username) {
            $ok = $this->update($code->id_reff, ['used_by' => $username]);
            if ($ok) return true;
        }
        return false;
    }
   
    public function checkCode($code, $dehash = true)
    {
        $code = $dehash ? create_password($code, false) : $code;
        return $this->getWhere(['code' => $code])
            ->getRowObject();
    }
}
