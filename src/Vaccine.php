<?php
declare(strict_types=1);

class Vaccine
{
    private string $idVaccine;
    private string $idSpecies;
    private string $vaccineName;

    public function __construct($idVaccine, $idSpecies, $vaccineName)
    {
        $this->idVaccine = $idVaccine;
        $this->idSpecies = $idSpecies;
        $this->vaccineName = $vaccineName;
    }

}