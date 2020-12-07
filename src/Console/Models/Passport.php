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
     *
     * @param int|null    $birthYear
     * @param int|null    $issueYear
     * @param int|null    $expirationYear
     * @param string|null $height
     * @param string|null $hairColor
     * @param string|null $eyeColor
     * @param string|null $passportId
     * @param int|null    $countryId
     */
    public function __construct(?int $birthYear, ?int $issueYear,
                                ?int $expirationYear, ?string $height,
                                ?string $hairColor, ?string $eyeColor,
                                ?string $passportId, ?int $countryId)
    {
        $this->birthYear = $birthYear;
        $this->issueYear = $issueYear;
        $this->expirationYear = $expirationYear;
        $this->height = $height;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
        $this->passportId = $passportId;
        $this->countryId = $countryId;
    }

    /**
     * @return int
     */
    public function getBirthYear(): int
    {
        return $this->birthYear;
    }

    /**
     * @param int $birthYear
     *
     */
    public function setBirthYear(int $birthYear) : void
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return int
     */
    public function getIssueYear(): int
    {
        return $this->issueYear;
    }

    /**
     * @param int $issueYear
     *
     */
    public function setIssueYear(int $issueYear) : void
    {
        $this->issueYear = $issueYear;
    }

    /**
     * @return int
     */
    public function getExpirationYear(): int
    {
        return $this->expirationYear;
    }

    /**
     * @param int $expirationYear
     *
     */
    public function setExpirationYear(int $expirationYear): void
    {
        $this->expirationYear = $expirationYear;
    }

    /**
     * @return string
     */
    public function getHeight(): string
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
     * @return string
     */
    public function getHairColor(): string
    {
        return $this->hairColor;
    }

    /**
     * @param string $hairColor
     *
     * @return Passport
     */
    public function setHairColor(string $hairColor): Passport
    {
        $this->hairColor = $hairColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getEyeColor(): string
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
     * @return string
     */
    public function getPassportId(): string
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
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     *
     * @return void
     */
    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return (isset($this->birthYear) && isset($this->issueYear) &&
            isset($this->expirationYear) && isset($this->height) &&
            isset($this->hairColor) && isset($this->eyeColor) &&
            isset($this->passportId) && ($this->passportId > 0)
        );
    }
}