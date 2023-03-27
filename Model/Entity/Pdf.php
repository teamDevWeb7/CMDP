<?php

namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="pdf")
 */
class Pdf{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private int $id;


    /**
     * @ORM\Column(type="string", length="50")
     *
     * @var string
     */
    private string $pdfPath;

    /**
     * @ORM\ManyToOne(targetEntity="Prospect", inversedBy="pdf")
     * @ORM\JoinColumn(name="prospect_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Prospect
     */

     private Prospect $prospect;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pdfPath.
     *
     * @param string $pdfPath
     *
     * @return Pdf
     */
    public function setPdfPath($pdfPath)
    {
        $this->pdfPath = $pdfPath;

        return $this;
    }

    /**
     * Get pdfPath.
     *
     * @return string
     */
    public function getPdfPath()
    {
        return $this->pdfPath;
    }

    /**
     * Set prospect.
     *
     * @param \Model\Entity\Prospect|null $prospect
     *
     * @return Pdf
     */
    public function setProspect(\Model\Entity\Prospect $prospect = null)
    {
        $this->prospect = $prospect;

        return $this;
    }

    /**
     * Get prospect.
     *
     * @return \Model\Entity\Prospect|null
     */
    public function getProspect()
    {
        return $this->prospect;
    }
}
