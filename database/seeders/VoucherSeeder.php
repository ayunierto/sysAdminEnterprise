<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serie = 254632548952;

        Voucher::create([
            'name' => 'Factura Electrónica',
            'description' => 'Es un comprobante de pago emitido por el vendedor o prestador de servicios en las operaciones de venta de bienes y prestación de servicios.
            
            Características:

            - Se utiliza para sustentar costos ó gastos para efectos del Impuesto a la Renta y el crédito fiscal del Impuesto General a las Ventas.
            - Tiene una serie alfanumérica, numeración correlativa y se genera a través de cualquiera de los sistemas de emisión electrónica.
            - No se puede utilizar para sustentar el traslado de bienes.
            - Se emite a favor del adquiriente que cuente con número de RUC, salvo en el caso de no domiciliados  en el caso de las operaciones de exportación.
            - La autenticidad de los documentos electrónicos emitidos se pueden consultar en el portal web de la SUNAT.',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Boleta de Venta Electrónica',
            'description' => 'Es un comprobante de pago que se emite a consumidores finales.
            
            Características:

            - No permite ejercer derecho a crédito fiscal ni podrán sustentar gasto o costo para efectos tributarios.
            - Tiene una serie alfanumérica, numeración correlativa y se genera a través de de cualquiera de los sistemas de emisión electrónica.
            - La autenticidad de los documentos electrónicos emitidos se pueden consultar en el portal web de la SUNAT.',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Nota de Crédito Electrónica',
            'description' => 'Es un documento electrónico que se utiliza para acreditar anulaciones, descuentos, bonificaciones, devoluciones y otros, relacionados con una factura o boleta de venta otorgada con anterioridad al mismo adquiriente o usuario.

            Características:
            
            - Es un documento electrónico que tiene todos los efectos tributarios del tipo de documento Nota de Crédito indicado en el Reglamento de Comprobantes de Pago.
            - Será emitida respecto de una Factura Electrónica que cuente con Constancia de Recepción - CDR “aceptada” o Boleta de Venta otorgada con anterioridad.
            - Tiene una serie alfanumérica, numeración correlativa y se genera a través de cualquiera de los sistemas de emisión electrónica.',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Nota de Débito Electrónica',
            'description' => 'Es un documento electrónico que se utiliza para recuperar gastos o costos incurridos por el vendedor- Es emitido de manera electrónica, con posterioridad a la emisión de una factura electrónica o boleta de venta otorgada al mismo adquiriente o usuario.

            Características:
            
            - Es un documento electrónico que tiene todos los efectos tributarios del tipo de documento Nota de débito indicado en el Reglamento de Comprobantes de Pago.
            - Será emitida respecto de una factura electrónica que cuente con Constancia de Recepción (CDR) “aceptada” o boleta de venta otorgada con anterioridad.
            - Tiene una serie alfanumérica, numeración correlativa y se generada a través de cualquiera de los sistemas de emisión electrónica.',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Recibo de Servicios Públicos Electrónico',
            'description' => 'Es un comprobante de pago que se emite por los servicios de luz, agua o teléfono, en operaciones con usuarios que proporcionen o no un número de RUC.

            En una primera etapa, el Recibo Electrónico de Servicio Público sólo podrá ser emitido por el suministro de agua y energía eléctrica. En el caso de telecomunicaciones, sólo podrá ser emitido por aquellos  que no incluyan servicios de telefonía fija o móvil, o servicios ofrecidos en forma empaquetada que consideren algún servicio telefónico.
            
            Características:
            
            - Los usuarios que se identifiquen con número de RUC, podrán usar este documento electrónico para sustentar costos, gastos o crédito fiscal.
            - La serie es alfanumérica, y su numeración es correlativa y generada por el sistema',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Recibo por Honorarios Electrónico',
            'description' => 'Es un comprobante de pago que emiten las personas naturales por los servicios que prestan en forma independiente, por percibir rentas que la Ley clasifica como rentas de cuarta categoría.

            La SUNAT brinda la facilidad de emitir  Recibos por Honorarios de manera electrónica, desde su portal web y por medio del APP SUNAT. Para ello es necesario que se cuente con Clave SOL.
            
            Características:
            
            - La afiliación al Sistema de Emisión Electrónico se produce con la sola emisión del primer recibo por honorarios electrónico. 
            - Se puede emitir con facilidad y rapidez, con los mismos datos que regularmente se registraba cuando generaba un recibo por honorarios físico.
            - Tiene una codificación propia y única, compuesta de una serie alfanumérica y numeración que se genera automáticamente.
            - No requiere impresión del Recibo por Honorarios. Puede enviarse en forma electrónica e inmediata al adquirente de los servicios.
            - Se puede consultar el recibo por honorario emitido. Se pude enviar o reenviar por correo electrónico cuantas veces sea necesario. Permite hacer registros adicionales como los pagos efectuados al emisor, así como la reversión del recibo y/o emisión de notas de crédito electrónicas vinculadas.
            - La SUNAT custodia y archiva de los recibos por honorarios electrónicos emitidos dentro de este sistema, ahorrándole costos de archivo al emisor y sin riesgo de pérdida.',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Comprobante de Retención Electrónico',
            'description' => 'Es un comprobante de pago emitido por el Agente de Retención, cuando en una operación comprendida en el Régimen de Retenciones del IGV, su Proveedor le retribuye un pago total o parcial.

            Características:
            
            - La serie es alfanumérica de cuatro dígitos, la numeración es correlativa y generada por el sistema',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Comprobante de Percepción Electrónico',
            'description' => 'Es un comprobante de pago emitido por el Agente de Percepción cuando realice el cobro total o parcial a su Clienteo importador, sea por adquisición de combustible o por Ventas Internas comprendidas en el Régimen de Percepciones del IGV.

            Características:
            
            - La serie es alfanumérica de cuatro dígitos, la su numeración es correlativa y generada por el sistema',
            'code' => '',
            'serie' => $serie + 1,
        ]);

        Voucher::create([
            'name' => 'Liquidación de Compra Electrónica',
            'description' => 'La Liquidación de compra electrónica es un comprobante de pago emitido por las personas naturales o jurídicas, sociedades conyugales, sucesiones indivisas, sociedades de hecho u otros entes colectivos por las adquisiciones que efectúen a personas naturales productoras y/o acopiadoras de productos primarios derivados de la actividad agropecuaria, pesca artesanal y extracción de madera, de productos silvestres, minería aurífera artesanal, artesanía, desperdicios y desechos metálicos, desechos de papel y desperdicios de caucho, siempre que estas personas no otorguen comprobantes de pago por carecer de número de RUC.',
            'code' => '',
            'serie' => $serie + 1,
        ]);
    }
}
