<?php
require_once __DIR__ . '/../dao/PaintingDao.php';  

class PaintingService
{
    protected $dao;

    public function __construct()
    {
        $this->dao = new PaintingDao(); 
    }

    public function getPaintings()
    {
        return $this->dao->getAllPaintings();
    }

    public function createPainting($data)
    {
        return $this->dao->addPainting($data);
    }

    public function updatePainting($paintingId, $data)
    {
        return $this->dao->updatePainting($paintingId, $data);
    }

    public function deletePainting($paintingId)
    {
        return $this->dao->deletePainting($paintingId);
    }
}
