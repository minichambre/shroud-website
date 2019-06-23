<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $character_main;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $character_alts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $log_link;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $date_created;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $spec;

    /**
     * @ORM\Column(type="boolean")
     */
    private $attendance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $history;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $additional;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $battletag;

    /**
     * @ORM\Column(type="boolean")
     */
    private $voice;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Member", mappedBy="application", cascade={"persist", "remove"})
     */
    private $member;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacterMain(): ?string
    {
        return $this->character_main;
    }

    public function setCharacterMain(string $character_main): self
    {
        $this->character_main = $character_main;

        return $this;
    }

    public function getCharacterAlts(): ?string
    {
        return $this->character_alts;
    }

    public function setCharacterAlts(?string $character_alts): self
    {
        $this->character_alts = $character_alts;

        return $this;
    }

    public function getLogLink(): ?string
    {
        return $this->log_link;
    }

    public function setLogLink(?string $log_link): self
    {
        $this->log_link = $log_link;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateCreated(): ?int
    {
        return $this->date_created;
    }

    public function setDateCreated(int $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getSpec(): ?string
    {
        return $this->spec;
    }

    public function setSpec(string $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function getAttendance(): ?bool
    {
        return $this->attendance;
    }

    public function setAttendance(bool $attendance): self
    {
        $this->attendance = $attendance;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getAdditional(): ?string
    {
        return $this->additional;
    }

    public function setAdditional(?string $additional): self
    {
        $this->additional = $additional;

        return $this;
    }

    public function getBattletag(): ?string
    {
        return $this->battletag;
    }

    public function setBattletag(string $battletag): self
    {
        $this->battletag = $battletag;

        return $this;
    }

    public function getVoice(): ?bool
    {
        return $this->voice;
    }

    public function setVoice(bool $voice): self
    {
        $this->voice = $voice;

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        // set (or unset) the owning side of the relation if necessary
        $newApplication = $member === null ? null : $this;
        if ($newApplication !== $member->getApplication()) {
            $member->setApplication($newApplication);
        }

        return $this;
    }
}
