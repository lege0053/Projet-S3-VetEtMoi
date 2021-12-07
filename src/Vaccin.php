<?php
declare(strict_types=1);

class Vaccin
{
    private string $idVaccin;
    private string $idSpecies;
    private string $vaccinName;

    public function __construct($idVaccin, $idSpecies, $vaccinName)
    {
        $this->idVaccin = $idVaccin;
        $this->idSpecies = $idSpecies;
        $this->vaccinName = $vaccinName;
    }

}