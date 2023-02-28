<?php

namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="message")
 */
class Message{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private int $id;


    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private string $message;

    /**
     * @ORM\ManyToOne(targetEntity="Prospect", inversedBy="message")
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
     * Set message.
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set prospect.
     *
     * @param \Model\Entity\Prospect|null $prospect
     *
     * @return Message
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
