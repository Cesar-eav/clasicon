<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import Tabs from '@/Components/Tabs.vue'
import Input from '@/Components/Input.vue'
import { ref, computed, onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';


//------------------
//Ventas

const cant_factura_electronica = ref(0);
const exento_factura_electronica = ref(0);
const neto_factura_electronica = ref(0);
const iva_factura_electronica = ref(0);
const total_factura_electronica = ref(0);

const cant_factura_electronica_exentas = ref(0);
const exento_factura_electronica_exentas = ref(0);
const neto_factura_electronica_exentas = ref(0);
const iva_factura_electronica_exentas = ref(0);
const total_factura_electronica_exentas = ref(0);

const cant_boletas_electronicas = ref(0);
const exento_boletas_electronicas = ref(0);
const neto_boletas_electronicas = ref(0);
const iva_boletas_electronicas = ref(0);
const total_boletas_electronicas = ref(0);

const cant_comprobante_medios_electricos = ref(0);
const exento_comprobante_medios_electricos = ref(0);
const neto_comprobante_medios_electricos = ref(0);
const iva_comprobante_medios_electricos = ref(0);
const total_comprobante_medios_electricos = ref(0);

const cant_notas_debido_eletronica = ref(0);
const exento_notas_debido_eletronica = ref(0);
const neto_notas_debido_eletronica = ref(0);
const iva_notas_debido_eletronica = ref(0);
const total_notas_debido_eletronica = ref(0);

const cant_notas_credito_eletronica = ref(0);
const exento_notas_credito_eletronica = ref(0);
const neto_notas_credito_eletronica = ref(0);
const iva_notas_credito_eletronica = ref(0);
const total_notas_credito_eletronica = ref(0);

const cant_factura_compras_con_retencion_parcial = ref(0);
const exento_factura_compras_con_retencion_parcial = ref(0);
const neto_factura_compras_con_retencion_parcial = ref(0);
const iva_factura_compras_con_retencion_parcial = ref(0);
const total_factura_compras_con_retencion_parcial = ref(0);

const sumCantVentas = computed(()=>{
    return Number(cant_factura_electronica.value) + 
    Number(cant_factura_electronica_exentas.value) + 
    Number(cant_boletas_electronicas.value) +
    Number(cant_comprobante_medios_electricos.value) + 
    Number(cant_notas_debido_eletronica.value) + 
    Number(cant_notas_credito_eletronica.value) +
    Number(cant_factura_compras_con_retencion_parcial.value)
});

const sumExentoVentas = computed(()=>{
    return Number(exento_factura_electronica.value) +
    Number(exento_factura_electronica_exentas.value) +
    Number(exento_boletas_electronicas.value) +
    Number(exento_comprobante_medios_electricos.value) +
    Number(exento_notas_credito_eletronica.value) +
    Number(exento_factura_compras_con_retencion_parcial.value)
});

const sumNetoVentas = computed(()=>{
    return Number(neto_factura_electronica_calculate.value) +
    Number(neto_boletas_electronicas_calculate.value) +
    Number(neto_factura_electronica_exentas_calculate.value) +
    Number(neto_comprobante_medios_electricos_calculate.value) +
    Number(neto_notas_debito_eletronica_calculate.value) +
    Number(neto_notas_credito_eletronica_calculate.value) +
    Number(neto_factura_compras_con_retencion_parcial_calculate.value)
});

const sumIvaVentas = computed(()=>{
    return Number(iva_factura_electronica.value) +
    Number(iva_factura_electronica_exentas.value) +
    Number(iva_boletas_electronicas.value) +
    Number(iva_comprobante_medios_electricos.value) +
    Number(iva_notas_debido_eletronica.value) +
    Number(iva_notas_credito_eletronica.value) +
    Number(iva_factura_compras_con_retencion_parcial.value)
});

const sumTotalsVentas = computed(()=>{
    return Number(sumTotalFacturaElectronica.value) +
    Number(sumTotalBoletaElectronica.value) +
    Number(sumTotalFacturaElectronicaExenta.value) +
    Number(sumTotalMediosElectronicos.value) +
    Number(sumTotalNotasDebitoElectronicos.value) +
    Number(sumTotalNotasCreditoElectronicos.value)
});

const sumTotalFacturaElectronica = computed(()=>{
    return neto_factura_electronica_calculate.value +
    Number(iva_factura_electronica.value)
});

const sumTotalBoletaElectronica = computed(()=>{
    return neto_boletas_electronicas_calculate.value +
    Number(iva_boletas_electronicas.value)
});

const sumTotalFacturaElectronicaExenta = computed(()=>{
    return neto_factura_electronica_exentas_calculate.value +
    Number(iva_factura_electronica_exentas.value)
});

const sumTotalMediosElectronicos = computed(()=>{
    return neto_comprobante_medios_electricos_calculate.value +
    Number(iva_comprobante_medios_electricos.value)
});

const sumTotalNotasDebitoElectronicos = computed(()=>{
    return neto_notas_debito_eletronica_calculate.value +
    Number(iva_notas_debido_eletronica.value)
});

const sumTotalNotasCreditoElectronicos = computed(()=>{
    return neto_notas_credito_eletronica_calculate.value +
    Number(iva_notas_credito_eletronica.value)
});

const sumTotalFacturasRetencionParcial = computed(()=>{
    return neto_factura_compras_con_retencion_parcial_calculate.value +
    Number(iva_factura_compras_con_retencion_parcial.value)
});


// Valores netos
const neto_factura_electronica_calculate = computed(() => {
    return calculateNeto(iva_factura_electronica.value);
});

const neto_boletas_electronicas_calculate = computed(()=>{
    return calculateNeto(iva_boletas_electronicas.value);
});

const neto_factura_electronica_exentas_calculate = computed(()=>{
    return calculateNeto(iva_factura_electronica_exentas.value);
});

const neto_comprobante_medios_electricos_calculate = computed(()=>{
    return calculateNeto(iva_comprobante_medios_electricos.value);
});

const neto_notas_debito_eletronica_calculate = computed(()=>{
    return calculateNeto(iva_notas_debido_eletronica.value);
});

const neto_notas_credito_eletronica_calculate = computed(()=>{
    return calculateNeto(iva_notas_credito_eletronica.value);
});

const neto_factura_compras_con_retencion_parcial_calculate = computed(()=> {
    return calculateNeto(iva_factura_compras_con_retencion_parcial.value);
})


//--------------------------
//Compras

const cant_facturas_electronicas_compras = ref(0);
const cant_notas_debito_electronica_compras = ref(0);
const cant_notas_credito_electronica_compras = ref(0);
const cant_importaciones_compras = ref(0);
const cant_compras_exentas_compras = ref(0);
const cant_remanente_compras = ref(0);

const exento_facturas_electronicas_compras = ref(0);
const exento_notas_debito_electronica_compras = ref(0);
const exento_notas_credito_electronica_compras = ref(0);
const exento_importaciones_compras = ref(0);
const exento_compras_exentas_compras = ref(0);
const exento_remanente_compras = ref(0);

const iva_facturas_electronicas_compras = ref(0);
const iva_notas_credito_electronica_compras = ref(0);
const iva_notas_debido_electronica_compras = ref(0);
const iva_importaciones_compras = ref(0);
const iva_compras_exentas_compras = ref(0);
const iva_remanente_compras = ref(0);

const sumTotalFacturaElectronicaCompras = computed(()=>{
    return neto_factura_electronica_calculate_compras.value +
    Number(iva_facturas_electronicas_compras.value)
});

const sumTotalNotasDebitoElectronicosCompras = computed(()=>{
    return neto_notas_debito_electronica_calculate_compras.value +
    Number(iva_notas_debido_electronica_compras.value)
});

const sumTotalNotasCreditoElectronicosCompras = computed(()=>{
    return neto_notas_credito_electronica_calculate_compras.value +
    Number(iva_notas_credito_electronica_compras.value)
});

const sumTotalComprasExentaCompras = computed(()=>{
    return neto_compras_exentas_compras_calculate_compras.value +
    Number(iva_compras_exentas_compras.value)
});

const sumTotalImportacionesCompras = computed(()=>{
    return neto_importaciones_compras_calculate_compras.value +
    Number(iva_importaciones_compras.value)
});

const sumTotalRemanenteCompras = computed(()=>{
    return neto_remanentes_compras_calculate_compras.value +
    Number(iva_remanente_compras.value)
});


// Valores netos
const neto_factura_electronica_calculate_compras = computed(() => {
    return calculateNeto(iva_facturas_electronicas_compras.value);
});

const neto_notas_debito_electronica_calculate_compras = computed(()=>{
    return calculateNeto(iva_notas_debido_electronica_compras.value);
});

const neto_notas_credito_electronica_calculate_compras = computed(()=>{
    return calculateNeto(iva_notas_credito_electronica_compras.value);
});

const neto_compras_exentas_compras_calculate_compras = computed(()=> {
    return calculateNeto(iva_compras_exentas_compras.value);
});

const neto_importaciones_compras_calculate_compras = computed(()=> {
    return calculateNeto(iva_importaciones_compras.value);
});

const neto_remanentes_compras_calculate_compras = computed(()=> {
    return calculateNeto(iva_remanente_compras.value);
});

const sumCantCompras = computed(()=>{
    return Number(cant_facturas_electronicas_compras.value) + 
    Number(cant_notas_debito_electronica_compras.value) + 
    Number(cant_notas_credito_electronica_compras.value) +
    Number(cant_importaciones_compras.value) + 
    Number(cant_compras_exentas_compras.value) + 
    Number(cant_remanente_compras.value)
});

const sumExentoCompras = computed(()=>{
    return Number(exento_facturas_electronicas_compras.value) +
    Number(exento_notas_debito_electronica_compras.value) +
    Number(exento_notas_credito_electronica_compras.value) +
    Number(exento_importaciones_compras.value) +
    Number(exento_compras_exentas_compras.value) +
    Number(exento_remanente_compras.value)
});
const sumIvaCompras = computed(()=>{
    return Number(iva_facturas_electronicas_compras.value) +
    Number(iva_notas_credito_electronica_compras.value) +
    Number(iva_notas_debido_electronica_compras.value) +
    Number(iva_importaciones_compras.value) +
    Number(iva_compras_exentas_compras.value) +
    Number(iva_remanente_compras.value)
});

const sumNetoCompras = computed(()=>{
    return Number(neto_factura_electronica_calculate_compras.value) +
    Number(neto_notas_debito_electronica_calculate_compras.value) +
    Number(neto_notas_credito_electronica_calculate_compras.value) +
    Number(neto_compras_exentas_compras_calculate_compras.value) +
    Number(neto_importaciones_compras_calculate_compras.value) +
    Number(neto_remanentes_compras_calculate_compras.value)
});

const sumTotalCompras = computed(()=>{
    return Number(sumTotalFacturaElectronicaCompras.value) +
    Number(sumTotalNotasDebitoElectronicosCompras.value) +
    Number(sumTotalNotasCreditoElectronicosCompras.value) +
    Number(sumTotalComprasExentaCompras.value) +
    Number(sumTotalImportacionesCompras.value) +
    Number(sumTotalRemanenteCompras.value)
});

//-------------------------
// Impuesto/Remanentes 

const sumExentoNeto = computed(()=>{
    return Number(sumExentoVentas.value) + Number(sumNetoVentas.value)
});

const calcTotalPPM = computed(()=>{
    let calculate = (sumExentoNeto.value * percentajePPM.value) / 100;
    return Math.round(calculate);
})
const percentajePPM = ref(0);

const sumTotalToPay = computed(()=>{
    return Number(calcTotalPPM.value) + 
        Number(form.ppm2) +
        Number(form.impuesto_2da_categoria) +
        Number(form.impuesto_unico_trabajadores) +
        Number(form.retencion_42N1) +
        Number(form.retencion_42N2)
});

function calculateNeto(iva){
    const neto =(iva * 100) / 19;
    return Math.round(neto);
}

const companiesList = ref(0);

function listCompanies(){
    axios.get(route('company.list')).then(res => {
        console.log("respuesta list companies",res.data);
        companiesList.value = res.data;
    }).catch(error => {
        console.log("error",error);
    });
}

onMounted(()=>{
    listCompanies();
})

const form = useForm({
    company_id : null,
    date : null,
    ppm : 0,
    ppm2 : 0,
    retencion_42N1: 0,
    retencion_42N2: 0,
    impuesto_unico_trabajadores: 0,
    impuesto_2da_categoria: 0,
    total_amount: 0,

    //Ventas
    factura_electronica_cantidad_doc: null,
    factura_electronica_exento: null,
    factura_electronica_neto: null,
    factura_electronica_iva: null,
    factura_electronica_exenta_cantidad_doc: null,
    factura_electronica_exenta_exento: null,
    factura_electronica_exenta_neto: null,
    factura_electronica_exenta_iva: null,
    boleta_electronica_cantidad_doc: null,
    boleta_electronica_exento: null,
    boleta_electronica_neto: null,
    boleta_electronica_iva: null,
    comprobante_medios_electronicos_cantidad_doc: null,
    comprobante_medios_electronicos_exento: null,
    comprobante_medios_electronicos_neto: null,
    comprobante_medios_electronicos_iva: null,
    nota_debito_cantidad_doc: null,
    nota_debito_exento: null,
    nota_debito_neto: null,
    nota_debito_iva: null,
    nota_credito_cantidad_doc: null,
    nota_credito_exento: null,
    nota_credito_neto: null,
    nota_credito_iva: null,
    facturas_retencion_cantidad_doc: null,
    facturas_retencion_exento: null,
    facturas_retencion_neto: null,
    facturas_retencion_iva : null,

    //Compras
    factura_electronica_cantidad_doc : null,
    factura_electronica_exento : null,
    factura_electronica_neto : null,
    factura_electronica_iva : null,
    nota_debito_cantidad_doc : null,
    nota_debito_exento : null,
    nota_debito_neto : null,
    nota_debito_iva : null,
    nota_credito_cantidad_doc : null,
    nota_credito_exento : null,
    nota_credito_neto : null,
    nota_credito_iva : null,
    importaciones_cantidad_doc : null,
    importaciones_exento : null,
    importaciones_neto : null,
    importaciones_iva : null,
    compra_exenta_cantidad_doc : null,
    compra_exenta_exento : null,
    compra_exenta_neto : null,
    compra_exenta_iva : null,
    remanente_cantidad_doc : null,
    remanente_exento : null,
    remanente_neto : null,
    remanente_iva : null,

    //Importaciones
    dolar_importacion : null,
    iva_dolar_importacion : null,
    rut_importacion : null,
    di_importacion : null,
    fecha_importacion: null,
    codigo_importacion: null,

    //Honorarios
    rows : null,

    //Remunerciones
    total_imponible_remuneracion: null,
    total_no_imponible_remuneracion: null,
    total_descuentos_legales_remuneracion: null,
    total_descuentos_no_legales_remuneracion: null,
    impuesto_unico_trabajadores_remuneracion: null,
    retencion_42_n1_remuneracion: null
});

function generateF29(){
    form.ppm = calcTotalPPM.value;
    form.factura_electronica_cantidad_doc = cant_factura_electronica;
    form.factura_electronica_exento= exento_factura_electronica
    form.factura_electronica_neto= neto_factura_electronica_calculate.value,
    form.factura_electronica_iva= iva_factura_electronica,
    form.factura_electronica_exenta_cantidad_doc= cant_factura_electronica_exentas,
    form.factura_electronica_exenta_exento= exento_factura_electronica_exentas,
    form.factura_electronica_exenta_neto= neto_factura_electronica_exentas_calculate.value,
    form.factura_electronica_exenta_iva= iva_factura_electronica_exentas,
    form.boleta_electronica_cantidad_doc= cant_boletas_electronicas,
    form.boleta_electronica_exento= exento_boletas_electronicas,
    form.boleta_electronica_neto= neto_boletas_electronicas_calculate.value,
    form.boleta_electronica_iva= iva_boletas_electronicas,
    form.comprobante_medios_electronicos_cantidad_doc= cant_comprobante_medios_electricos,
    form.comprobante_medios_electronicos_exento= exento_comprobante_medios_electricos,
    form.comprobante_medios_electronicos_neto= neto_comprobante_medios_electricos_calculate.value,
    form.comprobante_medios_electronicos_iva= iva_comprobante_medios_electricos,
    form.nota_debito_cantidad_doc= cant_notas_debido_eletronica,
    form.nota_debito_exento= exento_notas_debido_eletronica,
    form.nota_debito_neto= neto_notas_debito_eletronica_calculate.value,
    form.nota_debito_iva= iva_notas_debido_eletronica,
    form.nota_credito_cantidad_doc= cant_notas_credito_eletronica,
    form.nota_credito_exento= exento_notas_credito_eletronica,
    form.nota_credito_neto= neto_notas_credito_eletronica_calculate.value,
    form.nota_credito_iva= iva_notas_credito_eletronica,
    form.facturas_retencion_cantidad_doc= cant_factura_compras_con_retencion_parcial,
    form.facturas_retencion_exento= exento_factura_compras_con_retencion_parcial,
    form.facturas_retencion_neto= neto_factura_compras_con_retencion_parcial_calculate.value,
    form.facturas_retencion_iva = iva_factura_compras_con_retencion_parcial,

    form.factura_electronica_cantidad_doc = cant_facturas_electronicas_compras,
    form.factura_electronica_exento = exento_facturas_electronicas_compras,
    form.factura_electronica_neto = neto_factura_electronica_calculate_compras.value,
    form.factura_electronica_iva = iva_facturas_electronicas_compras,
    form.nota_debito_cantidad_doc = cant_notas_debito_electronica_compras,
    form.nota_debito_exento = exento_notas_debito_electronica_compras,
    form.nota_debito_neto = neto_notas_debito_electronica_calculate_compras.value,
    form.nota_debito_iva = iva_notas_debido_electronica_compras,
    form.nota_credito_cantidad_doc = cant_notas_credito_electronica_compras,
    form.nota_credito_exento = exento_notas_credito_electronica_compras,
    form.nota_credito_neto = neto_notas_credito_electronica_calculate_compras.value,
    form.nota_credito_iva = iva_notas_credito_electronica_compras,
    form.importaciones_cantidad_doc = cant_importaciones_compras,
    form.importaciones_exento = exento_importaciones_compras,
    form.importaciones_neto = neto_importaciones_compras_calculate_compras.value,
    form.importaciones_iva = iva_importaciones_compras,
    form.compra_exenta_cantidad_doc = cant_compras_exentas_compras,
    form.compra_exenta_exento = exento_compras_exentas_compras,
    form.compra_exenta_neto = neto_compras_exentas_compras_calculate_compras.value,
    form.compra_exenta_iva = iva_compras_exentas_compras,
    form.remanente_cantidad_doc = cant_remanente_compras,
    form.remanente_exento = exento_remanente_compras,
    form.remanente_neto = neto_remanentes_compras_calculate_compras.value,
    form.remanente_iva = iva_remanente_compras,

    form.total_amount = Math.round(sumTotalToPay.value),

    form.rows = rows,

    form.dolar_importacion = dolar_importacion,
    form.iva_dolar_importacion = iva_dolar_importacion,
    form.rut_importacion = rut_importacion,
    form.di_importacion = di_importacion,
    form.fecha_importacion= fecha_importacion,
    form.codigo_importacion= codigo_importacion,

    form.total_imponible_remuneracion = total_imponible_remuneracion,
    form.total_no_imponible_remuneracion = total_no_imponible_remuneracion,
    form.total_descuentos_legales_remuneracion = total_descuentos_legales_remuneracion,
    form.total_descuentos_no_legales_remuneracion = total_descuentos_no_legales_remuneracion,
    form.impuesto_unico_trabajadores_remuneracion = impuesto_unico_trabajadores_remuneracion,
    form.retencion_42_n1_remuneracion = retencion_42_n1_remuneracion
    
    console.log(form);
    form.post(route('form29.store'), {
      onSuccess: (res) => {
        console.log("store form29",res);
      }
    });
}

// Importaciones
    const dolar_importacion = ref(0);
    const iva_dolar_importacion = ref(0);
    const rut_importacion = ref('');
    const di_importacion = ref('');
    const fecha_importacion = ref(null);
    const codigo_importacion = ref(0);
    
    const neto_importaciones_calculate = computed(()=> {
        return calculateNeto(iva_importaciones_calculate.value);
    });

    const iva_importaciones_calculate = computed(()=> {
        return Number(dolar_importacion.value) * Number(iva_dolar_importacion.value);
    });

    const sumTotalIvaNetoImportacion = computed(()=>{
        return Number(neto_importaciones_calculate.value) + 
        Number(iva_importaciones_calculate.value)
    });

    const totalNetoImportacion = computed (()=> {
        return Number(neto_importaciones_calculate.value);
    });

    const totalIvaImportacion = computed (()=> {
        return Number(iva_importaciones_calculate.value);
    });

    const totalIvaNetoImportacion = computed(()=>{
        return Number(sumTotalIvaNetoImportacion.value);
    });
    
    const updateImportacionesIva = () => {
        iva_importaciones_compras.value = iva_importaciones_calculate.value;
        console.log('Updated iva_importaciones_compras:', iva_importaciones_compras.value);
    }

    watch(iva_importaciones_calculate,updateImportacionesIva);

// Honorarios

    const numero_honorario = ref(0);
    const fecha_honorario = ref(null);
    const rut_honorario = ref('');
    const nombre_razon_social_honorario = ref('');
    const brutos_honorario = ref(0);
    const ret_emision_honorario = ref(0);
    const ret_receptor_honorario = ref(0);
    const rows = ref([
      {
        numero_honorario: 0,
        fecha_honorario: '',
        rut_honorario: '',
        nombre_razon_social_honorario: '',
        brutos_honorario: 0,
        isRetReceptor: false
      }
    ]);

    const tresPorcientoCalculate = computed(()=> {
        return (rows.value.brutos_honorario * 3) / 100;
    });

    const pagadoCalculate = computed(() => {
        return rows.value.brutos_honorario - 
        calculateRetencion(rows.value.brutos_honorario) - calculateRetencion(rows.value.brutos_honorario) - 
        (rows.value.brutos_honorario * 3) / 100;
    });

    const ret_emision_calculate = computed(()=>{
        return calculateRetencion(rows.value.brutos_honorario);
    });

    const ret_receptor_calculate = computed(()=>{
        return calculateRetencion(rows.value.brutos_honorario);
    });

    const totalRetEmisor = computed(() => {
      return rows.value.reduce((acc, row) => acc + (row.isRetReceptor ? 0 : calculateRetencion(row.brutos_honorario)), 0);
    });

    const totalRetReceptor = computed(() => {
      return rows.value.reduce((acc, row) => acc + (row.isRetReceptor ? calculateRetencion(row.brutos_honorario) : 0), 0);
    });

    const totalTresPorciento = computed(() => {
      return rows.value.reduce((acc, row) => acc + calculateTresPorciento(row.brutos_honorario), 0);
    });

    const totalPagado = computed(() => {
      return rows.value.reduce((acc, row) => acc + calculatePagado(row.brutos_honorario, row.isRetReceptor ? 0 : calculateRetencion(row.brutos_honorario), row.isRetReceptor ? calculateRetencion(row.brutos_honorario) : 0, calculateTresPorciento(row.brutos_honorario)), 0);
    });


    const sumTotalRetEmision = computed(()=>{
    return Number(calcTotalPPM.value) + 
        Number(form.retencion_42N2) + 
        Number(form.retencion_42N1) +
        Number(form.impuesto_unico_trabajadores) +
        Number(form.impuesto_2da_categoria) +
        Number(form.ppm2)
    });

    const sumTotalRetReceptor = computed(()=>{
    return Number(calcTotalPPM.value) + 
        Number(form.retencion_42N2) + 
        Number(form.retencion_42N1) +
        Number(form.impuesto_unico_trabajadores) +
        Number(form.impuesto_2da_categoria) +
        Number(form.ppm2)
    });

    function calculateRetencion(brutos) {
      const retencion = (brutos * 13.75) / 100;
      return Math.round(retencion);
    }

    function calculateTresPorciento(brutos) {
      return (brutos * 3) / 100;
    }

    function calculatePagado(brutos, retEmisor, retReceptor, tresPorciento) {
      return brutos - retEmisor - retReceptor - tresPorciento;
    }

    function toggleRetReceptor(index){
      rows.value[index].isRetReceptor = !rows.value[index].isRetReceptor;
    };

    function removeRow(index){
      if (rows.value.length > 1) {
        rows.value.splice(index, 1);
      }
    }

    function addRow() {
      rows.value.push({
        numero_honorario: 0,
        fecha_honorario: '',
        rut_honorario: '',
        nombre_razon_social_honorario: '',
        brutos_honorario: 0,
        isRetReceptor: false
      });
    }

    //remuneraciones

    const total_imponible_remuneracion = ref(0);
    const total_no_imponible_remuneracion = ref(0);
    const total_descuentos_legales_remuneracion = ref(0);
    const total_descuentos_no_legales_remuneracion = ref(0);
    const impuesto_unico_trabajadores_remuneracion = ref(0);
    const retencion_42_n1_remuneracion = ref(0);

    const sumTotalRemuneracion = computed(()=>{
    return Number(total_imponible_remuneracion.value) + 
        Number(total_no_imponible_remuneracion.value) + 
        Number(total_descuentos_legales_remuneracion.value) +
        Number(total_descuentos_no_legales_remuneracion.value) +
        Number(impuesto_unico_trabajadores_remuneracion.value) +
        Number(retencion_42_n1_remuneracion.value)
    });

    const updateImpuestoUnicoTrabajadores = () => {
       form.impuesto_unico_trabajadores = impuesto_unico_trabajadores_remuneracion.value;
    };

    const updatePpm2 = () => {
        form.ppm2 = totalRetEmisor.value;
    };

    const updateImpuestoSegundaCategoria = () => {
        form.impuesto_2da_categoria = totalRetReceptor.value;
    };

    watch(totalRetEmisor, updatePpm2);
    watch(totalRetReceptor, updateImpuestoSegundaCategoria);

</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Formulario F-29
                </h2>
            </div>
        </template>
        <div class="p-6 bg-white dark:bg-rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 px-4">
                    <div class="mt-7 overflow-x-auto">
                        <Tabs>
                            <template #f29>
                                <div class="p-6 overflow-hidden bg-white dark:bg-rounded-md shadow-md dark:bg-dark-eval-1 mb-4">
                                    <div class="w-full">
                                        <div class="bg-white dark:bg-gray-800 px-4">
                                            <div class="flex md:flex-row flex-col justify-center items-center mb-4 ">
                                                <div class="md:w-1/2 w-full">
                                                    <label>Ingrese Empresa:</label>
                                                </div>
                                                <select class="md:w-1/2 w-full rounded-md border-gray-400" v-model="form.company_id">
                                                    <option v-for="(companies,name) in companiesList" :key="companies" :value="companies">{{ name }}</option>
                                                </select>
                                            </div>
                                            <div class="flex md:flex-row flex-col justify-center items-center">
                                                <div class="md:w-1/2 w-full">
                                                    <label>Ingrese Fecha:</label>
                                                </div>
                                                <Input type="date" class="md:w-1/2 w-full rounded-md border-gray-400" v-model="form.date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="w-full whitespace-nowrap dark:bg-gray-800">
                                    <thead class="dark:bg-black">
                                        <tr class="focus:outline-none dark:text-white dark:bg-black h-8 border border-gray-100 rounded">
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Cant.Doc
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Exento
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Neto
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Iva
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr> 
                                    <tbody>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Facturas Electronicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_factura_electronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_factura_electronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_factura_electronica_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_factura_electronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalFacturaElectronica"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none  h-8 border border-gray-100 rounded">
                                            <td  class="focus:text-indigo-600 ">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">F. Electronicas Exentas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_factura_electronica_exentas"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_factura_electronica_exentas"
                                                        id="email"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_factura_electronica_exentas_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_factura_electronica_exentas"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalFacturaElectronicaExenta"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none focus:text-indigo-600 h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Boletas Electronicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_boletas_electronicas"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_boletas_electronicas"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_boletas_electronicas_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_boletas_electronicas"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalBoletaElectronica"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Comprobantes o Recibos</p><br>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_comprobante_medios_electricos"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_comprobante_medios_electricos"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_comprobante_medios_electricos_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_comprobante_medios_electricos"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalMediosElectronicos"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Notas de Debito Electrónicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_notas_debido_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_notas_debido_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_notas_debito_eletronica_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_notas_debido_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalNotasDebitoElectronicos"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Notas de crédito Electrónicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_notas_credito_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_notas_credito_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_notas_credito_eletronica_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_notas_credito_eletronica"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalNotasCreditoElectronicos"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">F. de Compras con Retención Parcial</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_factura_compras_con_retencion_parcial"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_factura_compras_con_retencion_parcial"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_factura_compras_con_retencion_parcial_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_factura_compras_con_retencion_parcial"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalFacturasRetencionParcial"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                    </tbody>
                                    <tfoot class="bg-gray-600">
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">Total Débito</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumCantVentas }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumExentoVentas }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumNetoVentas }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumIvaVentas }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumTotalsVentas }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <table class="w-full whitespace-nowrap dark:bg-gray-800 sm:mt-4 mt-4">
                                    <thead>
                                        <tr class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Cant.Doc
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Exento
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Neto
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Iva
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr>
                                    <tbody>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Facturas Electronicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_facturas_electronicas_compras"
                                                        type="number"
                                                        class="block w-full"
                                                        required
                                                        :stretch-input="true"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_facturas_electronicas_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        required
                                                        :stretch-input="true"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_factura_electronica_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        required
                                                        :stretch-input="true"
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_facturas_electronicas_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        required
                                                        :stretch-input="true"
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalFacturaElectronicaCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        required
                                                        :stretch-input="true"
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td  class="focus:text-indigo-600 ">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Notas de Débito Electronicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_notas_debito_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_notas_debito_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_notas_debito_electronica_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_notas_debido_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalNotasDebitoElectronicosCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none focus:text-indigo-600 h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Notas de Crédito Electronicas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_notas_credito_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_notas_credito_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_notas_credito_electronica_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_notas_credito_electronica_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalNotasCreditoElectronicosCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Importaciones</p><br>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_importaciones_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_importaciones_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_importaciones_compras_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_importaciones_compras"
                                                        :value="iva_importaciones_calculate"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalImportacionesCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Compras Exentas</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_compras_exentas_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_compras_exentas_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_compras_exentas_compras_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_compras_exentas_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalComprasExentaCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Remanente</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="cant_remanente_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="exento_remanente_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_remanentes_compras_calculate_compras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_remanente_compras"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalRemanenteCompras"
                                                        type="number"
                                                        class="mt-1 block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                    </tbody>
                                    <tfoot class="bg-gray-600">
                                        <tr tabindex="0" class="focus:outline-none border h-8 border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">Total Crédito</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumCantCompras }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumExentoCompras }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumNetoCompras }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumIvaCompras }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ sumTotalCompras }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="mt-4 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                                    <div class="w-full">
                                        <div class="bg-white dark:bg-gray-800">
                                            <div class="mt-7 overflow-x-auto">
                                                <table class="w-full whitespace-nowrap border border-gray-100">
                                                    <thead>
                                                        <tr class="focus:outline-none border border-gray-100 rounded">
                                                            <th
                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                
                                                            </th>
                                                            <th
                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                                            </th>
                                                            <th
                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                                            </th>
                                                            <th
                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                                            </th>
                                                        </tr>
                                                        <tr class="h-3"></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr tabindex="0" class="focus:outline-none rounded">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">PPM</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="percentajePPM"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <span>{{ sumExentoNeto }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <span>{{ calcTotalPPM }}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr tabindex="0" class="focus:outline-none rounded">
                                                            <td  class="focus:text-indigo-600 ">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">PPM (2da categoría)</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="form.ppm2"
                                                                        :value="totalRetEmisor"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr tabindex="0" class="focus:outline-none focus:text-indigo-600 rounded">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Impuesto 2da categoría</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="form.impuesto_2da_categoria"
                                                                        :value="totalRetReceptor"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr tabindex="0" class="focus:outline-none rounded">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Impuesto ùnico a los trabajadores</p><br>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="form.impuesto_unico_trabajadores"
                                                                        :value="impuesto_unico_trabajadores_remuneracion"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr tabindex="0" class="focus:outline-none rounded">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Retención 42 N1 (3%)</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="form.retencion_42N1"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr tabindex="0" class="focus:outline-none rounded">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Retención 42 N2 (3%)</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        v-model="form.retencion_42N2"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto"
                                                                        :stretch-input="true"
                                                                        required
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot class="bg-gray-600">
                                                        <tr tabindex="0" class="focus:outline-none rounded h-8">
                                                            <td class="">
                                                                <div class="flex items-center pl-5">
                                                                    <p class="text-base font-medium leading-none mr-2 text-white dark:text-white">Total a pagar</p>
                                                                </div>
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                            </td>
                                                            <td class="pl-2">
                                                                <div class="flex items-center justify-center">
                                                                    <Input
                                                                        :value="sumTotalToPay"
                                                                        type="number"
                                                                        class="mt-1 block max-w-32 mx-auto bg-slate-200"
                                                                        :stretch-input="true"
                                                                        required
                                                                        disabled
                                                                    />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="flex flex-row w-full mt-8">
                                                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 bg-black transition duration-150 text-white ease-in-out hover:border-gray-400 hover:bg-gray-500 border rounded px-8 py-2 text-sm w-full" @click="generateF29()">Generar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template #honorario>
                                <table class="w-full whitespace-nowrap dark:bg-gray-800">
                                    <thead class="dark:bg-black">
                                        <tr class="focus:outline-none dark:text-white dark:bg-black h-8 border border-gray-100 rounded">
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Nº
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Fecha
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Rut
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Nombre/R.S
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Brutos
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Ret. emisor
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Ret. receptor
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                               3% ret.
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Pagado
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr> 
                                    <tbody>
                                        <tr v-for="(row, rowIndex) in rows" :key="rowIndex" tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <div class="flex items-center">
                                                        <Input v-model="row.numero_honorario" type="number" :stretch-input="true" class="block w-full min-w-[130px]" required />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input v-model="row.fecha_honorario" type="date" :stretch-input="true" class="block w-full min-w-[130px]" required />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input v-model="row.rut_honorario" type="text" :stretch-input="true" class="block w-full min-w-[130px]" required />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input v-model="row.nombre_razon_social_honorario" type="text" :stretch-input="true" class="block w-full min-w-[130px]" required autocomplete="email" />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input v-model="row.brutos_honorario" type="number" :stretch-input="true" class="block w-full min-w-[130px]" required autocomplete="email" />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input :value="row.isRetReceptor ? 0 : calculateRetencion(row.brutos_honorario)" type="number" :stretch-input="true" class="block w-full bg-slate-200 min-w-[130px]" required autocomplete="email" disabled />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input :value="row.isRetReceptor ? calculateRetencion(row.brutos_honorario) : 0" type="number" :stretch-input="true" class="block w-full bg-slate-200 min-w-[130px]" required autocomplete="email" disabled />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input :value="calculateTresPorciento(row.brutos_honorario)" type="number" :stretch-input="true" class="block w-full bg-slate-200 min-w-[130px]" required autocomplete="email" disabled />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input :value="calculatePagado(row.brutos_honorario, calculateRetencion(row.brutos_honorario), calculateRetencion(row.brutos_honorario), calculateTresPorciento(row.brutos_honorario))" type="number" :stretch-input="true" class="block w-full bg-slate-200 min-w-[130px]" required autocomplete="email" disabled />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <button @click="addRow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                            <path d="M15 12h-6" />
                                                            <path d="M12 9v6" />
                                                        </svg>
                                                    </button>
                                                    <button @click="removeRow(rowIndex)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                    <button @click="toggleRetReceptor(rowIndex)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M3 3m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                            <path d="M15 15m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                            <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                                                            <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                    </tbody>
                                    <tfoot class="bg-gray-600">
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">Total</p>
                                                </div>
                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalRetEmisor }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalRetReceptor }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalTresPorciento }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalPagado }}</p>
                                                </div>
                                            </td>
                                            <td class="">

                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </template>
                            <template #importacion>
                                <table class="w-full whitespace-nowrap dark:bg-gray-800">
                                    <thead class="dark:bg-black">
                                        <tr class="focus:outline-none dark:text-white dark:bg-black h-8 border border-gray-100 rounded">
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Fecha
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Cod
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Di
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Rut
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Dolar
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Iva ($)
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Neto
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Iva
                                            </th>
                                            <th
                                                class="px-5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr> 
                                    <tbody>
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <div class="flex items-center">
                                                        <Input
                                                            v-model="fecha_importacion"
                                                            type="date"
                                                            class="block w-full"
                                                            :stretch-input="true"
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="codigo_importacion"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="di_importacion"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="rut_importacion"
                                                        type="text"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="dolar_importacion"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        v-model="iva_dolar_importacion"
                                                        type="number"
                                                        class="block w-full"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="neto_importaciones_calculate"
                                                        type="number"
                                                        step="any"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="iva_importaciones_calculate"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center">
                                                    <Input
                                                        :value="sumTotalIvaNetoImportacion"
                                                        type="number"
                                                        class="block w-full bg-slate-200"
                                                        :stretch-input="true"
                                                        required
                                                        autocomplete="email"
                                                        disabled
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="h-3"></tr>
                                    </tbody>
                                    <tfoot class="bg-gray-600">
                                        <tr tabindex="0" class="focus:outline-none h-8 border border-gray-100 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">Total</p>
                                                </div>
                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="">

                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalNetoImportacion }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalIvaImportacion }}</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2 text-white">{{ totalIvaNetoImportacion }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </template>
                            <template #remuneracion>
                                <table class="w-full whitespace-nowrap border border-gray-100">
                                    <thead>
                                        <tr class="focus:outline-none border border-gray-100 rounded">
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-black text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                            </th>
                                        </tr>
                                        <tr class="h-3"></tr>
                                    </thead>
                                    <tbody>
                                        <tr tabindex="0" class="focus:outline-none rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Total imponibles</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">

                                            </td>
                                            <td class="pl-2">

                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="total_imponible_remuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr tabindex="0" class="focus:outline-none rounded">
                                            <td  class="focus:text-indigo-600 ">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Total no imponible</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="total_no_imponible_remuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr tabindex="0" class="focus:outline-none focus:text-indigo-600 rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Total descuentos legales</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="total_descuentos_legales_remuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr tabindex="0" class="focus:outline-none rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Total descuentos no legales</p><br>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="total_descuentos_no_legales_remuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr tabindex="0" class="focus:outline-none rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Impto. unico a trabajadores</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="impuesto_unico_trabajadores_remuneracion"
                                                        @change="updateImpuestoUnicoTrabajadores"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr tabindex="0" class="focus:outline-none rounded">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">Retención 42 N1 (3%)</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        v-model="retencion_42_n1_remuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-gray-600">
                                        <tr tabindex="0" class="focus:outline-none rounded h-8">
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none mr-2 text-white dark:text-white">Alcance líquido</p>
                                                </div>
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                            </td>
                                            <td class="pl-2">
                                                <div class="flex items-center justify-center">
                                                    <Input
                                                        :value="sumTotalRemuneracion"
                                                        type="number"
                                                        class="mt-1 block max-w-32 mx-auto"
                                                        :stretch-input="true"
                                                        required
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </template>
                        </Tabs>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
<style>.checkbox:checked + .check-icon {
    display: flex;
    }
    </style>
