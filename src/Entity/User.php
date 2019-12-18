<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email", message="Email address already registered")
 * @UniqueEntity("phone", message="Phone number already registered")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Do note that valid email pattern did not translate to real email address.
     *
     * @Assert\NotBlank(message="Email is required")
     * @Assert\Email(
     *  message = "The email '{{ value }}' is not a valid email."
     * )
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank(message="First name is required")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Name cannot contain a number"
     * )
     * @Assert\Regex(
     *     pattern="/\w{1,}/",
     *     message="Incompatible characters, please use tansliteration."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @Assert\NotBlank(message="Last name is required")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Name cannot contain a number"
     * )
     * @Assert\Regex(
     *     pattern="/\w{2,}/",
     *     message="Incompatible characters, please use tansliteration."
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * Mobile phone use naive validation rules. 08xyyyyyyyzz where:
     * - 08 prefix
     * - x denotes 1 digits operator identifier (no zero)
     * - y denotes 7 digits minimum length for mobile number
     * - z denotes 2 additional digit for "standard" mobile number length.
     *
     * @Assert\NotBlank(message="Mobile number is required")
     * @Assert\Regex(
     *  pattern="/^08[1-9]{1}\d{7,9}$/",
     *  message="Please enter valid Indonesian mobile phone number"
     * )
     * @ORM\Column(type="string", length=14, unique=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
