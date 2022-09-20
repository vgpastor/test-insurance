<?php

namespace App\Business\Model;

use App\Business\Enum\Genre;
use App\Business\Enum\Location;
use App\Business\Transformer\DateTransformerHelper;

/**
 *   "driver_birthDate": "2002-06-05",
 * "driver_birthPlace": "ESP",
 * "driver_birthPlaceMain": "ESP",
 * "driver_children": "NO",
 * "driver_civilStatus": "SOLTERO",
 * "driver_id": "36714791Y",
 * "driver_idType": "dni",
 * "driver_licenseDate": "2020-12-15",
 * "driver_licensePlace": "ESP",
 * "driver_licensePlaceMain": "ESP",
 * "driver_profession": "Estudiante",
 * "driver_sex": "MUJER",.
 */
class RequestDriver
{
    private \DateTime $birthDate;
    private Location $brithPlace;
    private Location $placeMain;
    private bool $children;
    private Genre $genre;

    public function __construct(
        string $birthDate,
        string $birthPlace,
        string $birthPlaceMain,
        string $children,
        string $genre
    ) {
        $this->birthDate = DateTransformerHelper::transformDateFromString($birthDate);
        $this->brithPlace = Location::tryFromName($birthPlace);
        $this->placeMain = Location::tryFromName($birthPlaceMain);
        $this->children = 'SI' === strtoupper($children);
        $this->genre = Genre::tryFromName($genre);
    }

    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    public function getBrithPlace(): Location
    {
        return $this->brithPlace;
    }

    public function getPlaceMain(): Location
    {
        return $this->placeMain;
    }

    public function isChildren(): bool
    {
        return $this->children;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }
}
