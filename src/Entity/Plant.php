<?php

namespace App\Entity;

use App\Entity\Picture;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlantRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlantRepository::class)
 */
class Plant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=255)
     * @Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "The plant name must be at least {{ limit }} characters long",
     *      maxMessage = "The plant name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(
     *      message = "You must name you plant.")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Length(
     *      max = 500,
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(
     *      message = "You must enter a planting date.")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Picture::class, mappedBy="plants")
     */
    private $pictures;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class)
     */
    private $cover;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="plants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;



    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->addPlant($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            $picture->removePlant($this);
        }

        return $this;
    }
    

    public function getCover(): ?Picture
    {
        return $this->cover;
    }

    public function setCover(?Picture $cover): self
    {
        $this->cover = $cover;

        return $this;
    }


    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user= $user;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(): self
    {
        $this->created_at = new \DateTime();;

        return $this;
    }

    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    
    //public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    public function setUpdatedAt(): self
    {
        //$this->updated_at = $updated_at;
        $this->updated_at = new \DateTime();

        return $this;
    }
}
