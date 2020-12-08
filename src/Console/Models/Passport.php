<?php


namespace Acme\Console\Models;


class Passport
{
    /**
     * @var int|null
     */
    private ?int $birthYear;

    /**
     * @var int|null
     */
    private ?int $issueYear;

    /**
     * @var int|null
     */
    private ?int $expirationYear;

    /**
     * @var string|null
     */
    private ?string $height;

    /**
     * @var string|null
     */
    private ?string $hairColor;

    /**
     * @var string|null
     */
    private ?string $eyeColor;

    /**
     * @var string|null
     */
    private ?string $passportId;

    /**
     * @var int|null
     */
    private ?int $countryId;

    /**
     * Passport constructor.
     */
    public function __construct()
    {
        $this->birthYear = null;
        $this->issueYear = null;
        $this->expirationYear = null;
        $this->height = null;
        $this->hairColor = null;
        $this->eyeColor = null;
        $this->passportId = null;
        $this->countryId = null;
    }

    /**
     *
     * @param int|null    $birthYear
     * @param int|null    $issueYear
     * @param int|null    $expirationYear
     * @param string|null $height
     * @param string|null $hairColor
     * @param string|null $eyeColor
     * @param string|null $passportId
     * @param int|null    $countryId
     *
     * @return Passport
     */
    public function createFromInputs(?int $birthYear, ?int $issueYear,
                                ?int $expirationYear, ?string $height,
                                ?string $hairColor, ?string $eyeColor,
                                ?string $passportId, ?int $countryId) : Passport
    {
        $this->birthYear = $birthYear;
        $this->issueYear = $issueYear;
        $this->expirationYear = $expirationYear;
        $this->height = $height;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
        $this->passportId = $passportId;
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBirthYear(): ?int
    {
        return (isset($this->birthYear) ? $this->birthYear : null);
    }

    /**
     * @param string $birthYear
     */
    public function setBirthYear(string $birthYear) : void
    {
        $this->birthYear = intval($birthYear);
    }

    /**
     * @return int
     */
    public function getIssueYear(): ?int
    {
        return $this->issueYear;
    }

    /**
     * @param string $issueYear
     */
    public function setIssueYear(string $issueYear) : void
    {
        $this->issueYear = intval($issueYear);
    }

    /**
     * @return int|null
     */
    public function getExpirationYear(): ?int
    {
        return $this->expirationYear;
    }

    /**
     * @param string $expirationYear
     */
    public function setExpirationYear(string $expirationYear): void
    {
        $this->expirationYear = intval($expirationYear);
    }

    /**
     * @return string|null
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param string $height
     *
     */
    public function setHeight(string $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string|null
     */
    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    /**
     * @param string $hairColor
     *
     */
    public function setHairColor(string $hairColor): void
    {
        $this->hairColor = $hairColor;
    }

    /**
     * @return string| null
     */
    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    /**
     * @param string $eyeColor
     *
     * @return void
     */
    public function setEyeColor(string $eyeColor): void
    {
        $this->eyeColor = $eyeColor;
    }

    /**
     * @return string|null
     */
    public function getPassportId(): ?string
    {
        return $this->passportId;
    }

    /**
     * @param string $passportId
     *
     * @return void
     */
    public function setPassportId(string $passportId): void
    {
        $this->passportId = $passportId;
    }

    /**
     * @return int
     */
    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     *
     * @return void
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = intval($countryId);
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return ($this->getBirthYear() && $this->getIssueYear() &&
            $this->getExpirationYear() && $this->getHeight() &&
            $this->getHairColor() && $this->getEyeColor() &&
            $this->getPassportId()
        );
    }
}