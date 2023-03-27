<?php

namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table
 */
class Photo{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private int $id;


    /**
     * @ORM\Column(type="string", name="chemin_img", length="50")
     *
     * @var string
     */
    private string $imgPath;


    /**
     * @ORM\Column(type="string", name="description")
     *
     * @var string
     */
    private string $descImg;


    /**
     * @ORM\ManyToOne(targetEntity="Chantier", inversedBy="photo")
     * @ORM\JoinColumn(name="chantier_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Chantier
     */

     private Chantier $chantier;


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
     * Set imgPath.
     *
     * @param string $imgPath
     *
     * @return Photo
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Get imgPath.
     *
     * @return string
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set descImg.
     *
     * @param string $descImg
     *
     * @return Photo
     */
    public function setDescImg($descImg)
    {
        $this->descImg = $descImg;

        return $this;
    }

    /**
     * Get descImg.
     *
     * @return string
     */
    public function getDescImg()
    {
        return $this->descImg;
    }

    /**
     * Set chantier.
     *
     * @param \Model\Entity\Chantier|null $chantier
     *
     * @return Photo
     */
    public function setChantier(\Model\Entity\Chantier $chantier = null)
    {
        $this->chantier = $chantier;

        return $this;
    }

    /**
     * Get chantier.
     *
     * @return \Model\Entity\Chantier|null
     */
    public function getChantier()
    {
        return $this->chantier;
    }
}
