<?php
namespace SimpleSession;

########### CACHE İSTEMİYORUZ #################
header("Pragma: no-cache");
/*------------------------------------------------------------------------*
[PHP Kod indeksi]
1. session class
	a. tanımlı değişkenler
	b. tanımlı metotlar
		i. __construct metodu (set)
		ii. session işlemini açar
		iii. session name set eder
		vi. session atayan metot
		v. session işlemlerinin sonlandırmak için kullanılan metot
		vi. session id'sini veren metot
		vii. session bilgisini get eder
		viii. session olup olmadığını test eder
--------------------------------------------------------------------------*/
/***** 1. session class */
class Session {
    /***** a. tanımlı değişkenler */
    // class versiyon
    const VERSION = 1.0;
    // session zaman aşım süresi sn cinsinden
    const TIMEOUT = '300';
    // sesion name
    const SESSION_NAME = 'ua_SESSION_id';
    /***** b. tanımlı metotlar */
    /***** i. __construct metodu (set) */
    public static function set () {
        ini_set('session.gc_maxlifetime', self::TIMEOUT);
        self::setSessionName();
        self::startSession();
    }
    /***** ii. session işlemini açar */
    private static function startSession () {
        session_start();
    }
    /***** iii. session name set eder */
    private static function setSessionName() {
        session_name(self::SESSION_NAME);
    }
    /***** vi. session atan metot
     * session için array olarak giden parametredeki tüm değerleri session olarak atar
     * @param array $sessionArr "array('name'=>'Eren')"
     * @return boolean
     */
    public static function createSession ($sessionArr) {
        if (is_array($sessionArr)) {

            foreach ($sessionArr as $key => $value) {
                $_SESSION[$key] = $value;
            }

            return true;
        }
        return false;
    }
    /***** v. session işlemlerinin sonlandırmak için kullanılan metot
     * tek tek session'ları array olarak göndererek de silebildiği gibi, $all parametresinin true yaparak tüm session'ları silebilir
     * @param array $sessionArr  "array('fname','lname')"
     * @param boolean $all
     * @return booolean
     */
    public static function deleteSession ($sessionArr, $all = false) {
        if ($all) {
            session_destroy();
            return true;
        }
        if (is_array($sessionArr)){
            $count = count($sessionArr);
            $i = 0;
            while ($i < $count) {
                unset($_SESSION[$sessionArr[$i]]);
                $i++;
            }
            foreach ($sessionArr as $name) {
                unset($_SESSION[$name]);
            }
            return true;
        }
        return false;
    }
    /***** vi. session id'sini veren metot
     * $reGenerate parametresi true olarak gönderilirse session_id'yi yeniden düzenleyerek response eder
     * @param boolean $reGenerate
     * @return string
     */
    public static function getSessionId ($reGenerate = false) {
        if ($reGenerate)
            session_regenerate_id();
        return session_id();
    }
    /***** vii. session bilgisini get eder
     * @param string $name
     * @return string
     */
    public static function getSession ($name) {
        return $_SESSION[$name];
    }
    /***** viii. session olup olmadığını test eder
     * @param string $sessionName
     * @return boolean
     */
    public static function sessionVariable ($sessionName) {
        if (isset($_SESSION[$sessionName]))
            return true;
        else
            return false;
    }
}