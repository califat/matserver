<?php
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";
/**
 * Class AppDefender
 * @package Utils
 *
 * Solution taken from here:
 * http://stackoverflow.com/a/13733588/1056679
 */
class AppDefender
{
	private $date;
    /** @var string */
    protected $alphabet;

    /** @var int */
    protected $alphabetLength;
    /**
     * @param string $alphabet
     */
    public function __construct($alphabet = '')
    {

        $this->date       =(new Dater);


        if ('' !== $alphabet) {
            $this->setAlphabet($alphabet);
        } else {
            $this->setAlphabet(
                  implode(range('a', 'z'))
                . implode(range('A', 'Z'))
                . implode(range(0, 9))
            );
        }
    }

	public function NohtmlNoTags($str){

		return htmlspecialchars(htmlentities($str));
	}

	public function Nohtml($str){

		return htmlspecialchars($str);
	}

	public function Notags($str){
		
		return htmlentities($str);
	}


    function NowDateToHash()#CONVERT NOW() TO TOKEN
    {
        return mb_strtoupper(md5(str_replace("-", "", $this->date->now)));
    }#END METHOD

    public function RandomPseudoByte($lenght)#CREATE A TOKEN
    {
        return mb_strtoupper(strval(bin2hex(openssl_random_pseudo_bytes($lenght))));
    }


    /**
     * @param string $alphabet
     */
    public function setAlphabet($alphabet)
    {
        $this->alphabet = $alphabet;
        $this->alphabetLength = strlen($alphabet);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generate($length)
    {
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $randomKey = $this->getRandomInteger(0, $this->alphabetLength);
            $token .= $this->alphabet[$randomKey];
        }

        return $token;
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    public function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }

    public function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    // public function getToken($length){
    //      $token = "";
    //      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    //      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    //      $codeAlphabet.= "0123456789";
    //      $max = strlen($codeAlphabet); // edited

    //     for ($i=0; $i < $length; $i++) {
    //         $token .= $codeAlphabet[random_int(0, $max-1)];
    //     }

    //     return $token;
    // }

    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }


}#END CLASS
