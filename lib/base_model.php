<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {

        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate_string_length($string, $length) {
        if (strlen($string) < $length) {
            return 'Nimen pituuden tulee olla vähintään' + $length + 'merkkiä!';
        }
    }

    public function validate_date() {
        $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
        if (!preg_match($date_regex, $this->raceday)) {
            return 'Kisapäivän tulee olla muodossa vvvv-kk-pp';
        }
        return null;
    }

    public function validate_description() {
        if (strlen($this->description) > 400) {
            return 'Kuvauksen pituus ei saa olla yli 400 merkkiä!';
        }
        return null;
    }

    public function validate_name() {
        if (strlen($this->name) < 3) {
            return 'Nimen pituuden tulee olla vähintään 3 ja maksimissaan 50 merkkiä!';
        }
        if (strlen($this->name) > 50) {
            return 'Nimen pituuden tulee olla vähintään 3 ja maksimissaan 50 merkkiä!';
        }

        return null;
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $error = $this->{$validator}();
            if ($error != null) {
                $errors[] = $error;
            }
        }

        return $errors;
    }

}
