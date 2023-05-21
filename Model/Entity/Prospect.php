<?php

namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="prospect")
 */
class Prospect{



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
    private string $nom;


    /**
     * @ORM\Column(type="string", length="55")
     * @var string
     */
    private string $prenom;


    /**
     * @ORM\Column(type="string", length="100")
     *
     * @var string
     */
    private string $mail;


    /**
     * @ORM\Column(type="string", length="50", name="telephone")
     *
     * @var string
     */
    private string $phone;


    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="prospect")
     *
     */
    private $message;


    /**
     * @ORM\OneToMany(targetEntity="Pdf", mappedBy="prospect")
     *
     */
    private $pdf;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->message = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pdf = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Prospect
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Prospect
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail.
     *
     * @param string $mail
     *
     * @return Prospect
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Prospect
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add message.
     *
     * @param \Model\Entity\Message $message
     *
     * @return Prospect
     */
    public function addMessage(\Model\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message.
     *
     * @param \Model\Entity\Message $message
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMessage(\Model\Entity\Message $message)
    {
        return $this->message->removeElement($message);
    }

    /**
     * Get message.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Add pdf.
     *
     * @param \Model\Entity\Pdf $pdf
     *
     * @return Prospect
     */
    public function addPdf(\Model\Entity\Pdf $pdf)
    {
        $this->pdf[] = $pdf;

        return $this;
    }

    /**
     * Remove pdf.
     *
     * @param \Model\Entity\Pdf $pdf
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePdf(\Model\Entity\Pdf $pdf)
    {
        return $this->pdf->removeElement($pdf);
    }

    /**
     * Get pdf.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPdf()
    {
        return $this->pdf;
    }

}
