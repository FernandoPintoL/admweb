<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntParametro extends Model
{
    use HasFactory;
    protected $table = 'intParametro';
    public $timestamps = false;
    protected $fillable = [
        'inpId',
        'inpGrupoArticuloDefault',
        'inpUsuario',
        'inpFechaCambio',
        'monId',
        'inpCostoMinA',
        'inpCostoMinB',
        'inpTxnConServicio',
        'inpCostoPP',
        'inpActualizaExistencia',
        'inpCentroAnalisisAutomatico',
        'inpCalculoExistencia',
        'inpValidaStockMax',
        'inpValidaStockMin',
        'inpVeExistenciaConSalidasEnRevision',
        'inpTxnConRecargo',
        'inpOcultaCostoSal',
        'inpEntradaCostoCero',
        'inpRutaImpExpExcel',
        'inpTxnConActivo',
        'inpTxnAgrupadaPor',
        'inpArticulosPorAlmacen',
        'inpSolicitudVisible',
        'inpBloqueoEstricto',
        'inpContDetalladaPorArticulos',
        'inpContDetalladaPorArticulosEn',
        'inpIdArticuloNumerico',
        'inpValidaSalidasDespuesEntradas',
        'inpModificaDepreciable',
        'inpModificaTipoArticulo',
        'inpModificaHabilitado',
        'inpVerificaSolicitudesPendientes',
        'inpCalculoExistenciaLote',
        'inpDejaModificarCostoSal',
        'inpCargaCapacidadEnTxn',
        'inpModificaPrecioPassword',
        'inpRepetirArticuloEnTxn',
        'inpMostrarAlmacenSucursal',
        'inpHabilitarEspecificacion',
        'inpPonerCostoEnEntradas',
        'inpCtasCAnalisis',
        'inpIdAutomatico',
        'intValidarCostoExistencia',
        'inpCrea1LoteXItem',
        'inpTxnSalidasFifo',
        'inpModificaImporteDetalle',
        'inpLeerOcultarCodBSegunLista',
        'inpExigeEspesifiEnCodificacionPara',
        'inpTxnDirecta',
        'inpUsuarioCreacion',
        'inpFechaCreacion',
        'inpCantDigitosId',
        'inpMetodoCosteoPredeterminado',
        'inpOcultarAnalisiLab',
        'inpBuscarArtPorCodBarra',
        'inpModificaCostoCantidad',
        'inpContadorArticulo',
        'inpGeneraAsientoPor',
    ];
}
