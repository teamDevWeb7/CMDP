<?php

namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="chantier")
 */
class Chantier{



    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int
     */
    private int $id;


    /**
     * @ORM\Column(type="string", length="55")
     * @var string
     */
    private string $nomChantier;


    /**
     * @ORM\Column(type="string", length="55")
     * @var string
     */
    private string $dateChantier;


    /**
     * @ORM\Column(type="string", length="55")
     *
     * @var string
     */
    private string $lieu;


    /**
     * @ORM\Column(type="string", name="description")
     *
     * @var string
     */
    private string $desc;


    /**
     * @ORM\Column(type="string", name="chemin_img", length="50")
     *
     * @var string
     */
    private string $imgPathChantier;


    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="chantier")
     *
     */
    private $photo;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photo = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nomChantier.
     *
     * @param string $nomChantier
     *
     * @return Chantier
     */
    public function setNomChantier($nomChantier)
    {
        $this->nomChantier = $nomChantier;

        return $this;
    }

    /**
     * Get nomChantier.
     *
     * @return string
     */
    public function getNomChantier()
    {
        return $this->nomChantier;
    }

    /**
     * Set dateChantier.
     *
     * @param string $dateChantier
     *
     * @return Chantier
     */
    public function setDateChantier($dateChantier)
    {
        $this->dateChantier = $dateChantier;

        return $this;
    }

    /**
     * Get dateChantier.
     *
     * @return string
     */
    public function getDateChantier()
    {
        return $this->dateChantier;
    }

    /**
     * Set lieu.
     *
     * @param string $lieu
     *
     * @return Chantier
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu.
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set desc.
     *
     * @param string $desc
     *
     * @return Chantier
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get desc.
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set imgPathChantier.
     *
     * @param string $imgPathChantier
     *
     * @return Chantier
     */
    public function setImgPathChantier($imgPathChantier)
    {
        $this->imgPathChantier = $imgPathChantier;

        return $this;
    }

    /**
     * Get imgPathChantier.
     *
     * @return string
     */
    public function getImgPathChantier()
    {
        return $this->imgPathChantier;
    }

    /**
     * Add photo.
     *
     * @param \Model\Entity\Photo $photo
     *
     * @return Chantier
     */
    public function addPhoto(\Model\Entity\Photo $photo)
    {
        $this->photo[] = $photo;

        return $this;
    }

    /**
     * Remove photo.
     *
     * @param \Model\Entity\Photo $photo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePhoto(\Model\Entity\Photo $photo)
    {
        return $this->photo->removeElement($photo);
    }

    /**
     * Get photo.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
