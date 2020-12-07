<?php


namespace Acme\Console\Models;


class Passport
{
    /**
     * @var int|null
     */
    private int $birthYear;

    /**
     * @var int|null
     */
    private int $issueYear;

    /**
     * @var int|null
     */
    private int $expirationYear;

    /**
     * @var string
     */
    private string $height;

    /**
     * @var string
     */
    private string $hairColor;

    /**
     * @var string
     */
    private string $eyeColor;

    /**
     * @var int
     */
    private int $passportId;

    /**
     * @var int
     */
    private int $countryId;

    /**
     * Passport constructor.
     *
     * @param int    $birthYear
     * @param int    $issueYear
     * @param int    $expirationYear
     * @param string    $height
     * @param string $hairColor
     * @param string $eyeColor
     * @param int    $passportId
     * @param int    $countryId
     */
    public function __construct(int $birthYear, int $issueYear,
                                int $expirationYear, string $height,
                                string $hairColor, string $eyeColor,
                                int $passportId, int $countryId)
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
     * @return
     */
    public function setIssueYear(int $issueYear)
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
     * @return Passport
     */
    public function setExpirationYear(int $expirationYear): Passport
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
     * @return Passport
     */
    public function setHeight(string $height): Passport
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
     * @return Passport
     */
    public function setEyeColor(string $eyeColor): Passport
    {
        $this->eyeColor = $eyeColor;
        return $this;
    }

    /**
     * @return int
     */
    public function getPassportId(): int
    {
        return $this->passportId;
    }

    /**
     * @param int $passportId
     *
     * @return Passport
     */
    public function setPassportId(int $passportId): Passport
    {
        $this->passportId = $passportId;
        return $this;
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

    public function isValid()
    {
        return (isset($this->birthYear) && isset($this->issueYear) &&
            isset($this->expirationYear) && isset($this->height) &&
            isset($this->hairColor) && isset($this->eyeColor) &&
            isset($this->passportId) && ($this->passportId > 0)
        );
    }
}