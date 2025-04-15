<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;

class EscuelaGWDATA extends Model
{
    use HasFactory;


    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'schools';

    const ESCUELA_ACTIVA = 1; //school_state_id

    const TIPO_ENTIDAD_SEDE = 2;

    public function scopeActive($query)
    {
        return $query->where('school_state_id', self::ESCUELA_ACTIVA);
    }


    public static function getActiveSchoolsWithComponentAndArea($codigoPais, $codigoMunicipio)
    {
        //DB::connection('tenant_xyz')->table('some_table')->get();
        $componentId = 31;
        $areaId = 6;

        return DB::connection("gwdata")
            ->table("components as c")
            ->join("school_components as sc", "c.id", "=", "sc.fkIdComponent")
            ->join("schools as scs", "sc.fkIdSchool", "=", "scs.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->select(
                "sc.id as school_component_id",
                "sc.fkIdSchool as school_id",
                "c.id as component_id",
                "c.name as component_name",
                "s.id as area_school_id",
                "a.id as area_id",
                "a.name as area_name",
                "scs.name",
                "scs.code",
                "scs.fkCodeCountry",
                "scs.fkCodeState",
                "scs.fkCodeMunicipality"
            )
            ->where([
                ["sc.school_components_state_id", 1],
                ["scs.school_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["scs.fkCodeMunicipality", $codigoMunicipio],
            ])
            ->get();
    }

    public static function getUniqueStatesWithActiveSchoolsAndComponents($codigoPais)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("states as st", "scs.fkCodeState", "=", "st.codeState")
            ->select("scs.fkCodeState", "st.name")
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE], //CLUBES
                ["a.id", AreaGWDATA::AREA_SALUD], // AREA EDUCACION
                ["scs.fkCodeCountry", $codigoPais],
            ])
            ->get();
    }

    public static function getUniqueMunicipalitiesWithActiveSchoolsAndComponents($codigoPais, $departamentoSelected)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("municipalities as m", "scs.fkCodeMunicipality", "=", "m.codeMunicipality")
            ->select("scs.fkCodeMunicipality", "m.name", 'scs.fkCodeState', 'm.codeMunicipality')
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["m.fkCodeState", $departamentoSelected],
            ])
            ->get();
    }

    public function departamento()
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'fkCodeState', 'codeState');
    }

    public function municipio()
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'fkCodeMunicipality', 'codeMunicipality');
    }

    public static function getActiveSedes($codigoPais, $codigoMunicipio)
    {
        return DB::connection("gwdata")
            ->table("components as c")
            ->join("school_components as sc", "c.id", "=", "sc.fkIdComponent")
            ->join("schools as scs", "sc.fkIdSchool", "=", "scs.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->select(
                "scs.name",
                "scs.id",
            )
            ->where([
                ["sc.school_components_state_id", 1],
                ["scs.school_state_id", 1],
                ["scs.tipoEntidad", self::TIPO_ENTIDAD_SEDE],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["scs.fkCodeMunicipality", $codigoMunicipio],
            ])
            ->get();
    }

    public static function getUniqueStatesWithActiveSedesAndComponents($codigoPais)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("states as st", "scs.fkCodeState", "=", "st.codeState")
            ->select("scs.fkCodeState", "st.name")
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["scs.tipoEntidad", self::TIPO_ENTIDAD_SEDE],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
            ])
            ->get();
    }

    public static function getUniqueMunicipalitiesWithActiveSedesAndComponents($codigoPais, $departamentoSelected)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("municipalities as m", "scs.fkCodeMunicipality", "=", "m.codeMunicipality")
            ->select("scs.fkCodeMunicipality", "m.name", 'scs.fkCodeState', 'm.codeMunicipality')
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["scs.tipoEntidad", self::TIPO_ENTIDAD_SEDE],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["m.fkCodeState", $departamentoSelected],
            ])
            ->get();
    }


    public static function getUniqueStatesWithActiveSedesSchoolAndComponentsBySedeId($codigoPais, $sedeId)
    {
        $query = DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("states as st", "scs.fkCodeState", "=", "st.codeState")
            ->select("scs.fkCodeState", "st.name")
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais]
            ]);

        // Comprueba si el usuario selecciona "Educacion" para no incluir la sede_id en la consulta
        if (in_array(0, $sedeId)) {
            $query->where(function (Builder $builder) use ($sedeId) {
                $builder->whereIn("scs.sede_id", $sedeId)
                    ->orWhereNull("scs.sede_id");
            });
        }
        else {
            $query->whereIn("scs.sede_id", $sedeId);
        }


        return $query->orderBy('st.name')->get();
    }

    public static function  getUniqueMunicipalitiesWithActiveSedesSchoolAndComponentsBySede($codigoPais, $sedeId, $departamentoSelected)
    {
        $query = DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("municipalities as m", "scs.fkCodeMunicipality", "=", "m.codeMunicipality")
            ->select("scs.fkCodeMunicipality", "m.name", 'scs.fkCodeState', 'm.codeMunicipality')
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["m.fkCodeState", $departamentoSelected],
            ]);

        if (in_array(0, $sedeId)) {
            $query->where(function (Builder $builder) use ($sedeId) {
                $builder->whereIn("scs.sede_id", $sedeId)
                    ->orWhereNull("scs.sede_id");
            });
        }
        else {
            $query->whereIn("scs.sede_id", $sedeId);
        }


        return $query->orderBy('m.name')->get();
    }

    public static function getActiveSedeSchoolsWithComponentAndAreaBySede($codigoPais, $sedeId, $codigoMunicipio)
    {
        $query = DB::connection("gwdata")
            ->table("components as c")
            ->join("school_components as sc", "c.id", "=", "sc.fkIdComponent")
            ->join("schools as scs", "sc.fkIdSchool", "=", "scs.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->select(
                "sc.id as school_component_id",
                "sc.fkIdSchool as school_id",
                "c.id as component_id",
                "c.name as component_name",
                "s.id as area_school_id",
                "a.id as area_id",
                "a.name as area_name",
                "scs.name",
                "scs.code",
                "scs.fkCodeCountry",
                "scs.fkCodeState",
                "scs.fkCodeMunicipality"
            )
            ->where([
                ["sc.school_components_state_id", 1],
                ["scs.school_state_id", 1],
                ["c.id", ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["scs.fkCodeMunicipality", $codigoMunicipio],
            ]);

        if (in_array(0, $sedeId)) {
            $query->where(function (Builder $builder) use ($sedeId) {
                $builder->whereIn("scs.sede_id", $sedeId)
                    ->orWhereNull("scs.sede_id");
            });
        }
        else {
            $query->whereIn("scs.sede_id", $sedeId);
        }


        return $query->orderBy('scs.name')->get();
    }

    public static function getActiveSchoolsNNA($codigoPais, $codigoMunicipio)
    {
        return DB::connection("gwdata")
            ->table("components as c")
            ->join("school_components as sc", "c.id", "=", "sc.fkIdComponent")
            ->join("schools as scs", "sc.fkIdSchool", "=", "scs.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->select(
                "sc.id as school_component_id",
                "sc.fkIdSchool as school_id",
                "c.id as component_id",
                "c.name as component_name",
                "s.id as area_school_id",
                "a.id as area_id",
                "a.name as area_name",
                "scs.name",
                "scs.code",
                "scs.fkCodeCountry",
                "scs.fkCodeState",
                "scs.fkCodeMunicipality"
            )
            ->where([
                ["sc.school_components_state_id", 1],
                ["scs.school_state_id", 1],
                ["c.id", ComponenteGWDATA::NNA],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["scs.fkCodeMunicipality", $codigoMunicipio],
            ])
            ->get();
    }

    public static function getUniqueMunicipalitiesWithActiveSchoolsAndComponentNNA($codigoPais, $departamentoSelected)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("municipalities as m", "scs.fkCodeMunicipality", "=", "m.codeMunicipality")
            ->select("scs.fkCodeMunicipality", "m.name", 'scs.fkCodeState', 'm.codeMunicipality')
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::NNA],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
                ["m.fkCodeState", $departamentoSelected],
            ])
            ->get();
    }

    public static function getUniqueStatesWithActiveSedesAndComponentsNNA($codigoPais)
    {
        return DB::connection("gwdata")
            ->table("schools as scs")
            ->join("school_components as sc", "scs.id", "=", "sc.fkIdSchool")
            ->join("components as c", "sc.fkIdComponent", "=", "c.id")
            ->join("area_school as s", "scs.code", "=", "s.fkCode")
            ->join("areas as a", "s.fkIdArea", "=", "a.id")
            ->join("states as st", "scs.fkCodeState", "=", "st.codeState")
            ->select("scs.fkCodeState", "st.name")
            ->distinct()
            ->where([
                ["scs.school_state_id", self::ESCUELA_ACTIVA],
                ///["scs.tipoEntidad", self::TIPO_ENTIDAD_SEDE],
                ["sc.school_components_state_id", 1],
                ["c.id", ComponenteGWDATA::NNA],
                ["a.id", AreaGWDATA::AREA_SALUD],
                ["scs.fkCodeCountry", $codigoPais],
            ])
            ->get();
    }
}
