<?php
declare(strict_types=1);

class Vaccine
{
    private string $idVaccine;
    private string $idSpecies;
    private string $vaccineName;

    /**
     * @return string
     */
    public function getIdVaccine(): string
    {
        return $this->idVaccine;
    }

    /**
     * @param string $idVaccine
     */
    public function setIdVaccine(string $idVaccine): void
    {
        $this->idVaccine = $idVaccine;
    }

    /**
     * @return string
     */
    public function getIdSpecies(): string
    {
        return $this->idSpecies;
    }

    /**
     * @param string $idSpecies
     */
    public function setIdSpecies(string $idSpecies): void
    {
        $this->idSpecies = $idSpecies;
    }

    /**
     * @return string
     */
    public function getVaccineName(): string
    {
        return $this->vaccineName;
    }

    /**
     * @param string $vaccineName
     */
    public function setVaccineName(string $vaccineName): void
    {
        $this->vaccineName = $vaccineName;
    }

}