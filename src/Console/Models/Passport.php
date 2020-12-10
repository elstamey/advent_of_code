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
     * @param bool   $strict
     */
    public function setBirthYear(string $birthYear, bool $strict) : void
    {
        $birthYearInt = intval($birthYear);
        if (($strict) &&
            (preg_match("/\d\d\d\d/", $birthYear)) &&
            (1920 <= $birthYearInt) && ($birthYearInt <= 2002)) {
            $this->birthYear = $birthYearInt;
        } elseif (!$strict) {
            $this->birthYear = $birthYearInt;
        }
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
     * @param bool   $strict
     */
    public function setIssueYear(string $issueYear, bool $strict) : void
    {
        $issueYearInt = intval($issueYear);
        if (($strict) &&
            (preg_match("/\d\d\d\d/", $issueYear)) &&
            (2010 <= $issueYearInt) && ($issueYearInt <= 2020)) {
            $this->issueYear = $issueYearInt;
        } elseif (!$strict) {
            $this->issueYear = $issueYearInt;
        }

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
     * @param bool   $strict
     */
    public function setExpirationYear(string $expirationYear, bool $strict): void
    {
        $expirationYearInt = intval($expirationYear);
        if (($strict) &&
            (preg_match("/[0-9]{4}/", $expirationYear)) &&
            (2020 <= $expirationYearInt) && ($expirationYearInt <= 2030)) {
            $this->expirationYear = $expirationYearInt;
        } elseif (!$strict) {
            $this->expirationYear = $expirationYearInt;
        }
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
     * @param bool   $strict
     */
    public function setHeight(string $height, bool $strict): void
    {
        if ($strict && preg_match("/[0-9]+\w\w/", $height)) {

            $length = strlen($height);
            $amt = intval(substr($height, 0, $length-2));
            $unit = substr($height, $length-2, 2);

            if (($unit === 'cm') && (150 <= $amt) && ($amt <= 193)) {
                $this->height =  $height;
            } elseif (($unit === 'in') && (59 <= $amt) && ($amt <= 76)) {
                $this->height =  $height;
            }

        } elseif (!$strict && preg_match("/\w\w/", $height)) {
            $this->height =  $height;
        }
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
     * @param bool   $strict
     */
    public function setHairColor(string $hairColor, bool $strict): void
    {
        if ($strict && preg_match("/[\#]{1}[0-9a-f]{6}/", $hairColor)) {
            $this->hairColor = $hairColor;
        } elseif (!$strict) {
            $this->hairColor = $hairColor;
        }
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
     * @param bool   $strict
     *
     * @return void
     */
    public function setEyeColor(string $eyeColor, bool $strict): void
    {
        if ($strict) {
            if (($eyeColor === 'amb') || ($eyeColor === 'blu') || ($eyeColor === 'brn') ||
                ($eyeColor === 'gry') || ($eyeColor === 'grn') || ($eyeColor === 'hzl') ||
                ($eyeColor === 'oth')) {
                $this->eyeColor = $eyeColor;
            }
        } else {
            $this->eyeColor = $eyeColor;
        }
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
     * @param bool   $strict
     *
     * @return void
     */
    public function setPassportId(string $passportId, bool $strict): void
    {
        if ($strict &&
            (preg_match("/[0-9]{9}/", $passportId) && (strlen($passportId) === 9))) {
            $this->passportId = $passportId;
        } elseif (!$strict) {
            $this->passportId = $passportId;
        }
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
        if (!$this->getBirthYear()) {
//            print "No valid birth year\n\n";
            return false;
        }
        if (!$this->getIssueYear()) {
//            print "No valid issue year\n\n";
            return false;
        }
        if (!$this->getExpirationYear()) {
//            print "No valid expiration year\n\n";
            return false;
        }
        if (!$this->getHeight()) {
//            print "No valid height\n\n";
            return false;
        }
        if (!$this->getHairColor()) {
//            print "No valid hair color\n\n";
            return false;
        }
        if (!$this->getEyeColor()) {
//            print "No valid eye color\n\n";
            return false;
        }
        if (!$this->getPassportId()) {
//            print "No valid passport id \n\n";
            return false;
        }

//        print "VALID!!!\n\n";
        return true;
    }
}